<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case COD = 'cash_on_delivery';

    public static function all(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
