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
        Schema::create('raise_tours', function (Blueprint $table) {
            $table->foreignId('raise_id')->constrained('raises')->cascadeOnDelete();
            $table->foreignId('tour_id')->constrained('tours')->cascadeOnDelete();
            $table->primary([
                'raise_id',
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
        Schema::dropIfExists('raise_tours');
    }
};
