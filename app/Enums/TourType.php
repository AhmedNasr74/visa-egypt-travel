<?php

namespace App\Enums;

enum TourType: string
{
    case EGYPT = 'egypt';
    case Other = 'other';

    public static function all(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
