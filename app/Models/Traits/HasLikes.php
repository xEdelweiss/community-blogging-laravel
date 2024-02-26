<?php

namespace App\Models\Traits;

use App\Enums\Rate;
use App\Enums\MinLikesScore;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\DB;

trait HasLikes
{
    public function likedBy(User $user): bool
    {
        return $this->likes()
            ->where('user_id', $user->id)
            ->where('liked', 1)
            ->exists();
    }

    public function dislikedBy(User $user): bool
    {
        return $this->likes()
            ->where('user_id', $user->id)
            ->where('liked', -1)
            ->exists();
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like(User $user): Like
    {
        return $this->setLike($user, true);
    }

    public function dislike(User $user): Like
    {
        return $this->setLike($user, false);
    }

    public function unlike(User $user): Like
    {
        $this->likes()
            ->where('user_id', $user->id)
            ->delete();

        return new Like([
            'liked' => Rate::Neutral,
        ]);
    }

    private function setLike(User $user, bool $liked): Like
    {
        return $this->likes()->updateOrCreate([
            'user_id' => $user->id,
        ], [
            'liked' => $liked ? 1 : -1,
        ]);
    }

    public function scopeMinLikesScore(Builder $builder, MinLikesScore $minScore, string|null $period = null): void
    {
        $dateFrom = $period ? now()->sub($period) : null;

        $scoreCondition = match ($minScore) {
            MinLikesScore::Positive => static fn(Builder $query) => $query->having(DB::raw('COALESCE(SUM(liked), 0)'), '>', 0),
            MinLikesScore::NonNegative => static fn(Builder $query) => $query->having(DB::raw('COALESCE(SUM(liked), 0)'), '>=', 0),
            default => null,
        };

        $builder
            ->leftJoin('likes', fn ($join) => $join
                ->on($this->getQualifiedKeyName(), '=', 'likes.likeable_id')
                ->where('likes.likeable_type', $this->getMorphClass())
                ->when($dateFrom, fn ($query) => $query->where('likes.created_at', '>=', $dateFrom))
            )
            ->groupBy($this->getQualifiedKeyName())
            ->when($scoreCondition, $scoreCondition);
    }

    public function scopeMostLiked(Builder $builder, string|null $period = null, MinLikesScore $filter = MinLikesScore::None): void
    {
        $builder
            ->minLikesScore($filter, $period)
            ->orderByDesc(DB::raw('COALESCE(SUM(liked), 0)'));
    }
}
