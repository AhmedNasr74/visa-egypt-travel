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
        Schema::create('raise_destinations', function (Blueprint $table) {
            $table->foreignId('raise_id')->constrained('raises')->cascadeOnDelete();
            $table->foreignId('destination_id')->constrained('destinations')->cascadeOnDelete();
            $table->primary([
                'raise_id',
                'destination_id',
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
        Schema::dropIfExists('raise_destinations');
    }
};
