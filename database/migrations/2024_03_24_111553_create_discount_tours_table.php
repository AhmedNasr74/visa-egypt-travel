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
        Schema::create('discount_tours', function (Blueprint $table) {
            $table->foreignId('discount_id')->constrained('discounts')->cascadeOnDelete();
            $table->foreignId('tour_id')->constrained('tours')->cascadeOnDelete();
            $table->primary([
                'discount_id',
                'tour_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_tours');
    }
};
