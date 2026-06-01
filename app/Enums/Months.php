<?php

namespace App\Enums;

enum Months: string
{
    case JANUARY = 'january';
    case FEBRUARY = 'february';
    case MARCH = 'march';
    case APRIL = 'april';
    case MAY = 'may';
    case JUNE = 'june';
    case JULY = 'july';
    case AUGUST = 'august';
    case SEPTEMBER = 'september';
    case OCTOBER = 'october';
    case NOVEMBER = 'november';
    case DECEMBER = 'december';

    public static function all(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
