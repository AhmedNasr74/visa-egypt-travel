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
        Schema::create('destination_for_trip', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destinations')->cascadeOnDelete();
            $table->foreignId('customized_trip_id')->constrained('customized_trips')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('destination_for_trip');
    }
};
