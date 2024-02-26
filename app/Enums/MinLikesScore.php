<?php

namespace App\Enums;

enum MinLikesScore: string
{
    case Positive = 'positive';
    case NonNegative = 'non-negative';
    case None = 'none';

    public function isPositive(): bool
    {
        return $this === self::Positive;
    }

    public function isNonNegative(): bool
    {
        return $this === self::NonNegative;
    }

    public function isNone(): bool
    {
        return $this === self::None;
    }
}
