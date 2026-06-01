<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('car_route_prices', function (Blueprint $table) {
            $table->unsignedInteger('price_group_index')->default(0)->after('car_route_id');
            $table->string('limo_city_hours', 8)->nullable()->after('rounded_price');
        });

        $tierHours = config('car_transport.car_ride_tier_hours', []);
        $tierCarTypes = array_keys($tierHours);

        $routeIds = DB::table('car_route_prices')->distinct()->pluck('car_route_id');
        foreach ($routeIds as $routeId) {
            $rows = DB::table('car_route_prices')->where('car_route_id', $routeId)->orderBy('id')->get();
            $bandIndex = 0;
            foreach ($rows as $row) {
                if (in_array($row->car_type, $tierCarTypes, true)) {
                    DB::table('car_route_prices')->where('id', $row->id)->update([
                        'limo_city_hours' => $tierHours[$row->car_type],
                        'price_group_index' => 0,
                    ]);
                } else {
                    DB::table('car_route_prices')->where('id', $row->id)->update([
                        'price_group_index' => $bandIndex++,
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        Schema::table('car_route_prices', function (Blueprint $table) {
            $table->dropColumn(['price_group_index', 'limo_city_hours']);
        });
    }
};
