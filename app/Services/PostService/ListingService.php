<?php

namespace App\Services\PostService;

use App\Enums\Post\ListingOrder;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ListingService
{
    private const PER_PAGE = 10;

    public function getListing(PostCriteria $criteria, ListingOrder $order, ?User $user = null): Builder
    {
        if ($order->isRelevant() && $user === null) {
            throw new \InvalidArgumentException('User must be provided for relevant posts');
        }

        return Post::published()
            ->byCriteria($criteria) // @todo byCriteria not using period/minScore - think about it
            ->when($order->isLatest(), fn(Builder $query) => $query->latestPublications($criteria->minScore))
            ->when($order->isRelevant(), fn(Builder $query) => $query->relevant($user))
            ->when($order->isMostLiked(), fn(Builder $query) => $query->mostLiked($criteria->period->toInterval(), $criteria->minScore));
    }
}
