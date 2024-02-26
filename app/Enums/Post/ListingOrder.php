<?php

namespace App\Enums\Post;

enum ListingOrder: string
{
    case Latest = 'latest';
    case MostLiked = 'top';
    case Relevant = 'relevant';

    public function isLatest(): bool
    {
        return $this === self::Latest;
    }

    public function isMostLiked(): bool
    {
        return $this === self::MostLiked;
    }

    public function isRelevant(): bool
    {
        return $this === self::Relevant;
    }
}
