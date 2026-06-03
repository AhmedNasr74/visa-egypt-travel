<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customized_trips', function (Blueprint $table) {
            if (!Schema::hasColumn('customized_trips', 'request')) {
                $table->string('request')->nullable()->after('note');
            }
            if (!Schema::hasColumn('customized_trips', 'age_range')) {
                $table->string('age_range')->nullable()->after('request');
            }
            if (!Schema::hasColumn('customized_trips', 'travel_to')) {
                $table->string('travel_to')->nullable()->after('destination');
            }
            if (!Schema::hasColumn('customized_trips', 'accommodation_choices')) {
                $table->string('accommodation_choices')->nullable()->after('travel_to');
            }
            if (!Schema::hasColumn('customized_trips', 'how_did_you_hear_about_us')) {
                $table->string('how_did_you_hear_about_us')->nullable()->after('accommodation_choices');
            }
            if (!Schema::hasColumn('customized_trips', 'children_ages')) {
                $table->json('children_ages')->nullable()->after('child');
            }
        });
    }

    public function down(): void
    {
        Schema::table('customized_trips', function (Blueprint $table) {
            $columns = [
                'request',
                'age_range',
                'travel_to',
                'accommodation_choices',
                'how_did_you_hear_about_us',
                'children_ages',
            ];
            foreach ($columns as $column) {
                if (Schema::hasColumn('customized_trips', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
