<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;
use Str;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = ['Cairo', 'Alexandria', 'Aswan', 'Luxor'];
        foreach ($destinations as $destination) {
            if (!Destination::whereTranslation('title', $destination)->exists()) {
                Destination::create([
                    'en' => [
                        'title' => $destination,
                        'description' => $destination,
                        'slug' => Str::slug($destination),
                    ],
                ]);
            }
        }
    }
}
