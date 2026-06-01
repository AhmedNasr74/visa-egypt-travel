<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        Currency::updateOrCreate(['name' => 'EURO'], [
            'name' => 'EURO',
            'symbol' => '€',
            'exchange_rate' => 1,
            'default' => true
        ]);
        Currency::updateOrCreate(['name' => 'USD'], [
            'name' => 'USD',
            'symbol' => '$',
            'exchange_rate' => 1,
            'default' => true
        ]);
    }
}
