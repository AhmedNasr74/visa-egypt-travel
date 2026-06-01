<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            Schema::table('car_routes', function (Blueprint $table) {
                $table->dropForeign(['destination_id']);
            });
            DB::statement('ALTER TABLE car_routes MODIFY destination_id BIGINT UNSIGNED NULL');
            Schema::table('car_routes', function (Blueprint $table) {
                $table->foreign('destination_id')->references('id')->on('locations')->nullOnDelete();
            });

            return;
        }

        if ($driver === 'pgsql') {
            Schema::table('car_routes', function (Blueprint $table) {
                $table->dropForeign(['destination_id']);
            });
            DB::statement('ALTER TABLE car_routes ALTER COLUMN destination_id DROP NOT NULL');
            Schema::table('car_routes', function (Blueprint $table) {
                $table->foreign('destination_id')->references('id')->on('locations')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::table('car_routes')->whereNull('destination_id')->update([
                'destination_id' => DB::table('locations')->orderBy('id')->value('id') ?? 1,
            ]);
            Schema::table('car_routes', function (Blueprint $table) {
                $table->dropForeign(['destination_id']);
            });
            DB::statement('ALTER TABLE car_routes MODIFY destination_id BIGINT UNSIGNED NOT NULL');
            Schema::table('car_routes', function (Blueprint $table) {
                $table->foreign('destination_id')->references('id')->on('locations');
            });

            return;
        }

        if ($driver === 'pgsql') {
            DB::table('car_routes')->whereNull('destination_id')->update([
                'destination_id' => DB::table('locations')->orderBy('id')->value('id') ?? 1,
            ]);
            Schema::table('car_routes', function (Blueprint $table) {
                $table->dropForeign(['destination_id']);
            });
            DB::statement('ALTER TABLE car_routes ALTER COLUMN destination_id SET NOT NULL');
            Schema::table('car_routes', function (Blueprint $table) {
                $table->foreign('destination_id')->references('id')->on('locations');
            });
        }
    }
};
