<?php

namespace App\Enums;

enum Period: string
{
    case Day = 'day';
    case Week = 'week';
    case Month = 'month';
    case All = 'all';

    public function toInterval(): ?string
    {
        return match ($this) {
            self::Day => '1 day',
            self::Week => '1 week',
            self::Month => '1 month',
            self::All => null,
        };
    }
}
