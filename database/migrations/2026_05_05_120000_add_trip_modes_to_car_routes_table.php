<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('car_routes', function (Blueprint $table) {
            if (! Schema::hasColumn('car_routes', 'supports_one_way')) {
                $table->boolean('supports_one_way')->default(true);
            }
            if (! Schema::hasColumn('car_routes', 'supports_round_trip')) {
                $table->boolean('supports_round_trip')->default(true);
            }
        });
    }

    public function down(): void
    {
        Schema::table('car_routes', function (Blueprint $table) {
            if (Schema::hasColumn('car_routes', 'supports_one_way')) {
                $table->dropColumn('supports_one_way');
            }
            if (Schema::hasColumn('car_routes', 'supports_round_trip')) {
                $table->dropColumn('supports_round_trip');
            }
        });
    }
};
