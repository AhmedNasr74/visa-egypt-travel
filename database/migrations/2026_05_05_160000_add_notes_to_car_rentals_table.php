<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('car_rentals', 'notes')) {
            Schema::table('car_rentals', function (Blueprint $table) {
                $table->text('notes')->nullable()->after('phone');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('car_rentals', 'notes')) {
            Schema::table('car_rentals', function (Blueprint $table) {
                $table->dropColumn('notes');
            });
        }
    }
};
