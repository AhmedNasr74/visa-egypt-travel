<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Subscribe; // Make sure to import the Subscribe model

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate and insert 50 emails
        for ($i = 0; $i < 50; $i++) {
            Subscribe::create([
                'email' => 'email' . $i . '@example.com',
                // Add other columns if necessary
            ]);
        }
    }
}
