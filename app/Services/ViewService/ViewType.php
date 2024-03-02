<?php

namespace App\Services\ViewService;

enum ViewType: string
{
    case View = 'view';
    case Read = 'read';
    case Listing = 'listing';

    public function getModelKey(): string
    {
        return match ($this) {
            self::View => 'views',
            self::Read => 'reads',
            self::Listing => 'listings',
        };
    }

    public static function values(): array
    {
        return [
            self::View->value,
            self::Read->value,
            self::Listing->value,
        ];
    }
}
