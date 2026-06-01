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
        Schema::create('season_tours', function (Blueprint $table) {
            $table->id();
            $table->string("season_Start_day")->nullable();
            $table->string("season_Start_month")->nullable();
            $table->string("season_End_month")->nullable();
            $table->string("season_End_day")->nullable();
            $table->string("season_adult_price")->nullable();
            $table->string("season_child_price")->nullable();
            $table->string("season_type")->nullable();
            $table->json('pricing_groups')->nullable();
            $table->float('start_from_price')->default(0);
            $table->foreignId('tour_id')->constrained('tours')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_tours');
    }
};
