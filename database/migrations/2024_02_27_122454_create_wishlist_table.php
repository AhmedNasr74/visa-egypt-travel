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
        Schema::create('client_wishlist', function (Blueprint $table) {
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('tour_id')->constrained('tours')->cascadeOnDelete();
            $table->primary([
                'client_id',
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
        Schema::dropIfExists('client_wishlist');
    }
};
