<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('customized_trips', function (Blueprint $table) {
            if (!Schema::hasColumn('customized_trips', 'destination')) {
                $table->string('destination')->nullable()->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('customized_trips', function (Blueprint $table) {
            //
        });
    }
};
