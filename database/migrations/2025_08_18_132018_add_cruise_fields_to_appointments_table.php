<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Add cruise-specific fields
            $table->string('cruise_type')->nullable()->after('hear_about_us');
            $table->string('cruise_pick_drop_off')->nullable()->after('cruise_type');
            $table->string('cruise_duration')->nullable()->after('cruise_pick_drop_off');
            $table->string('budget_range')->nullable()->after('cruise_duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Remove cruise-specific fields
            $table->dropColumn(['cruise_type', 'cruise_pick_drop_off', 'cruise_duration', 'budget_range']);
        });
    }
};
