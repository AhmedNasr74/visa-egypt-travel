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
        Schema::create('customized_trips', function (Blueprint $table) {
            $table->id();
            $table->string('date_type');
            $table->string('date_from')->nullable();
            $table->string('date_to')->nullable();
            $table->string('month')->nullable();
            $table->string('days')->nullable();
            $table->string('first_name');
            $table->string('nationality');
            $table->string('phone');
            $table->string('codePhone');
            $table->string('email');
            $table->string('adults');
            $table->string('child')->nullable();
            $table->string('infant')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('customized_trips');
    }
};
