<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('tours', 'seasons')) {
            Schema::table('tours', function (Blueprint $table) {
                $table->json('seasons')->nullable()->after('pricing_groups');
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
