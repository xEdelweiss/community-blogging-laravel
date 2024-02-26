<?php

namespace App\Services;

use App\Models\Like;
use App\Models\User;
use ArrayAccess;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LikeService
{
    /** @returns Collection<int, int> */
    public function getLikesScore(string $likeableType, int|array|ArrayAccess $likeableIds): Collection
    {
        if (is_scalar($likeableIds)) {
            $likeableIds = [$likeableIds];
        }

        return Like::select('likeable_id', DB::raw('SUM(liked) as score'))
            ->whereLikeableType($likeableType)
            ->whereIn('likeable_id', $likeableIds)
            ->groupBy('likeable_id')
            ->get()
            ->pluck('score', 'likeable_id');
    }

    /** @return Collection<int, Like> */
    public function getUserLikes(?User $user, string $likeableType, int|array|ArrayAccess $likeableIds): Collection
    {
        if ($user === null) {
            return collect();
        }

        if (is_scalar($likeableIds)) {
            $likeableIds = [$likeableIds];
        }

        return Like::whereLikeableType($likeableType)
            ->whereIn('likeable_id', $likeableIds)
            ->whereUserId(auth()->id())
            ->get()
            ->keyBy('likeable_id');
    }
}
