<?php

namespace App\Enums;

enum SliderKey: string
{
    case MAIN_HOME_SLIDER = 'main-home-slider';
    case INSTAGRAM_GALLERY = 'instagram-gallery';
    public static function all(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
