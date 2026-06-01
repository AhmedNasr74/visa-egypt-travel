<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('categories', 'parent_id')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->foreignId('parent_id')->after('gallery')
                    ->nullable()->constrained('categories')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
};
