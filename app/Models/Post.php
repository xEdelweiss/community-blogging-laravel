<?php

namespace App\Models;

use App\Enums\MinLikesScore;
use App\Models\Interfaces\Bookmarkable;
use App\Models\Traits\HasBookmarks;
use App\Models\Traits\HasLikes;
use App\Models\Traits\HasTags;
use App\Models\Traits\HasViews;
use App\Observers\PostObserver;
use App\Services\PostService\PostCriteria;
use App\Services\ViewService\Viewable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[ObservedBy(PostObserver::class)]
class Post extends Model implements Viewable, Bookmarkable
{
    use HasFactory;
    use HasTags;
    use HasLikes;
    use HasViews;
    use HasBookmarks;

    protected $with = ['author', 'topic', 'userBookmark'];
    protected $withCount = ['comments', 'bookmarks'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

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

    public function scopeByCriteria(Builder $builder, PostCriteria $criteria): void
    {
        $builder
            ->when($criteria->tag, fn(Builder $query) => $query->whereHas('tags', fn(Builder $query) => $query->where('slug', $criteria->tag->slug)))
            ->when($criteria->topic, fn(Builder $query) => $query->whereBelongsTo($criteria->topic));
    }

    public function scopePublished(Builder $builder): void
    {
        $builder->whereNotNull('published_at');
    }

    public function scopeLatestPublications(Builder $builder, MinLikesScore $filter = MinLikesScore::None): void
    {
        $builder
            ->minLikesScore($filter)
            ->latest('published_at');
    }

    public function scopeMostCommented(Builder $builder, string $period = '3 days'): void
    {
        $dateFrom = now()->sub($period);

        $builder
            ->withCount([
                'comments as last_comments_count' => fn(Builder $query) => $query->where('created_at', '>=', $dateFrom),
            ])
            ->orderByDesc('last_comments_count');
    }

    public function scopeRelevant(Builder $builder, User $user): void
    {
        $builder->inRandomOrder(); // @todo replace with real logic
    }
}
