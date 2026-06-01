<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('nickname');
            $table->string('name');
            $table->string('email');
            $table->string('country_phone_code')->nullable();
            $table->string('phone');
            $table->string('nationality');
            $table->text('hotel_choice');
            $table->unsignedInteger('adults');
            $table->unsignedInteger('children');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->unsignedInteger('days')->nullable();
            $table->text('age_range');
            $table->text('hear_about_us');
            $table->text('notes');
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
        Schema::dropIfExists('appointments');
    }
};
