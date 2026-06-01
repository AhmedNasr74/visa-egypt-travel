<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(DestinationSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(PermissionsSeeder::class);
    }
}
