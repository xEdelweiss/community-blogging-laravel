<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
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

    public function scopeNewest(Builder $builder): void
    {
        $builder->orderByDesc('published_at');
    }
}
