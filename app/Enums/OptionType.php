<?php

namespace App\Enums;

enum OptionType: string
{
    case PRICE_PER_PAX = 'price per pax';
    case PRICE_PER_TOUR = 'price per tour';

    public static function all(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
