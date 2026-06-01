<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            DB::statement('ALTER TABLE `tours` CHANGE `banner` `banner` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL; ');
            DB::statement('ALTER TABLE `tours` CHANGE `type` `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;');
            $table->string('slug')->after('id')->nullable();
        });

        if (Schema::hasColumn('tour_translations', 'slug')) {
            Schema::table('tour_translations', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }

    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            //
        });
    }
};
