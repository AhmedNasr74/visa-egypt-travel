<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = ['home', 'about'];

        foreach ($pages as $page) {
            if (!Page::where('key', $page)->exists()) {
                Page::create(['key' => $page]);
            }
        }
    }
}
