<?php

namespace Database\Seeders;

use App\Enums\SliderKey;
use App\Models\Slider;
use Illuminate\Database\Seeder;
use Str;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $key =  Str::slug(SliderKey::MAIN_HOME_SLIDER->value);
        Slider::firstOrCreate([
            'key' => $key
        ],[
            'title' => Str::headline(SliderKey::MAIN_HOME_SLIDER->value),
            'key' => $key
        ]);

        $key =  Str::slug(SliderKey::INSTAGRAM_GALLERY->value);
        Slider::firstOrCreate([
            'key' => $key
        ],[
            'title' => Str::headline(SliderKey::INSTAGRAM_GALLERY->value),
            'key' => $key
        ]);
    }
}
