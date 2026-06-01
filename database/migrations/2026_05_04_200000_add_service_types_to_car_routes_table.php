<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('car_routes', function (Blueprint $table) {
            if (! Schema::hasColumn('car_routes', 'airport_limo')) {
                $table->boolean('airport_limo')->default(false)->after('destination_id');
            }
            if (! Schema::hasColumn('car_routes', 'travel_limo')) {
                $table->boolean('travel_limo')->default(false)->after('airport_limo');
            }
            if (! Schema::hasColumn('car_routes', 'city_ride_limo')) {
                $table->boolean('city_ride_limo')->default(false)->after('travel_limo');
            }
        });

        if (Schema::hasColumn('car_routes', 'airport_limo')) {
            DB::table('car_routes')->update([
                'airport_limo' => true,
                'travel_limo' => false,
                'city_ride_limo' => false,
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('car_routes', function (Blueprint $table) {
            $table->dropColumn(['airport_limo', 'travel_limo', 'city_ride_limo']);
        });
    }
};
