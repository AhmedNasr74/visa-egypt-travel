<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case HOLD = 'hold';
    case IN_PROGRESS = 'in_progress';
    case SHIPPING = 'shipping';
    case DELIVERED = 'delivered';
    case COMPLETED = 'completed';
    case REFUNDED = 'refunded';

    public static function all(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
