<?php

namespace App\Enums;

enum TourPricingType: string
{
    case PACKAGE_GROUP = 'package-tour';
    case PRICING_GROUP = 'pricing-tour';

    public static function all(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
