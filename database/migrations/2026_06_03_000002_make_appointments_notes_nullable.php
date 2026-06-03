<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('appointments') || !Schema::hasColumn('appointments', 'notes')) {
            return;
        }

        DB::statement('ALTER TABLE `appointments` MODIFY `notes` TEXT NULL');
    }

    public function down(): void
    {
        if (!Schema::hasTable('appointments') || !Schema::hasColumn('appointments', 'notes')) {
            return;
        }

        DB::statement("UPDATE `appointments` SET `notes` = '' WHERE `notes` IS NULL");
        DB::statement('ALTER TABLE `appointments` MODIFY `notes` TEXT NOT NULL');
    }
};
