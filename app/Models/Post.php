<?php

namespace App\Models;

use App\Services\PostService\Formatters\ConvertToText;
use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Support\Str;
use JeroenG\Explorer\Application\BePrepared;
use JeroenG\Explorer\Application\Explored;
use Laravel\Scout\Searchable;

class Post extends Model implements Explored, BePrepared
{
    use HasFactory;
    use Searchable;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // protected $with = ['tags'];

    protected $fillable = [
        'title',
        'url',
        'intro',
        'content',
        'author_id',
        'topic_id',
        'published_at',
    ];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function syncTags(array $tagNames): self
    {
        $ids = Tag::findOrCreateAll($tagNames)->pluck('id');

        $this->tags()->sync($ids);

        return $this;
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)
            ->orderBy('created_at');
    }

    public function slug(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->title
                ? Str::slug($this->title)
                : null,
        );
    }

    public function scopePublished(Builder $builder): void
    {
        $builder->whereNotNull('published_at');
    }

    public function scopeLatest(Builder $builder): void
    {
        $builder->orderByDesc('published_at');
    }

    public function scopeWithTopic(Builder $builder, string|null $topic = null): void
    {
        if (empty($topic)) {
            return;
        }

        $builder->whereHas('topic', fn($query) => $query->where('slug', $topic));
    }

    public function scopeMostLiked(Builder $builder, string $period = '3 days'): void
    {
        $this->inRandomOrder(); // @todo replace with real logic
    }

    public function scopeMostCommented(Builder $builder, string $period = '3 days'): void
    {
        $dateFrom = now()->sub($period);

        // @todo try not rewriting the real comments count
        $builder
            ->withCount(['comments' => fn($query) => $query->where('created_at', '>=', $dateFrom)]);
    }

    public function scopeRelevant(Builder $builder, User $user): void
    {
        $this->inRandomOrder(); // @todo replace with real logic
    }

    public function scopeWithTags(Builder $builder, array|string|null $tags): void
    {
        if (empty($tags)) {
            return;
        }

        $tags = is_array($tags) ? $tags : [$tags];

        $builder->whereHas('tags', fn($query) => $query->whereIn('slug', $tags));
    }

    public function mappableAs(): array
    {
        return [
            'id' => 'keyword',
            'title' => 'text',
            'textContent' => 'text',
            'intro' => 'text',
            // 'tags' => 'tags.*.slug',
            'tags' => [
                'name' => 'text',
            ],
            'published' => 'boolean',
            'published_at' => 'date',
            'created_at' => 'date',
        ];
    }

    public function prepare(array $searchable): array
    {
        $searchable['published'] = (new Carbon($searchable['published_at']))->isPast();

        $searchable['textContent'] = Pipeline::send($searchable['content'])
            ->through([
                function (string|null $content, Closure $next) {
                    if (is_null($content)) {
                        return '';
                    }

                    try {
                        $nodes = json_decode($content, true, 128, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $e) {
                        // @fixme remove legacy content before release
                        return $content;
                    }

                    return $next($nodes);
                },
                ConvertToText::class,
            ])
            ->thenReturn();

        return $searchable;
    }
}
