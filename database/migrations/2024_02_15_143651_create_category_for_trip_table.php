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
        Schema::create('category_for_trip', function (Blueprint $table) { // removed extra parenthesis
            $table->id();
            $table->foreignId('customized_category_id')->constrained('customized_categories')->cascadeOnDelete();
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
        Schema::dropIfExists('category_for_trip');
    }
};
