<?php

namespace App\Models\Traits;

use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasBookmarks
{
    public function isBookmarkedBy(User $user): bool
    {
        return (bool) $this->userBookmark;
    }

    public function addBookmark(User $user): void
    {
        $bookmark = $this->userBookmark()->create([
            'user_id' => $user->id,
        ]);

        $this->setRelation('userBookmark', $bookmark);
    }

    public function removeBookmark(User $user): void
    {
        $this->userBookmark?->delete();
        $this->unsetRelation('userBookmark');
    }

    public function refreshBookmarksCount(): void
    {
        $this->loadCount('bookmarks');
    }

    public function bookmarks(): MorphMany
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function userBookmark(): MorphOne
    {
        if (!auth()->user()) {
            return $this->morphOne(Bookmark::class, 'bookmarkable');
        }
        
        return $this->morphOne(Bookmark::class, 'bookmarkable')
            ->where('user_id', auth()->user()->id);
    }

    public function scopeBookmarkedBy(Builder $builder, ?User $user = null): void
    {
        $user ??= auth()->user();

        if (!$user) {
            throw new \Exception('User is not authenticated');
        }

        $builder->whereHas('bookmarks', fn($query) => $query->where('user_id', $user->id));
    }
}
