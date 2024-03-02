<?php

namespace App\Models\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasTags
{
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

    public function scopeWithTags(Builder $builder, array|string|null $tags): void
    {
        if (empty($tags)) {
            return;
        }

        $tags = is_array($tags) ? $tags : [$tags];

        $builder->whereHas('tags', fn($query) => $query->whereIn('slug', $tags));
    }
}
