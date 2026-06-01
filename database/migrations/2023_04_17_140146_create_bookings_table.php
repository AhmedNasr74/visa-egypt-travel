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
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('nationality')->nullable();
            $table->foreignId('tour_id')->nullable()->constrained('tours')->nullOnDelete();
            $table->foreignId('tour_operator_id')->nullable()->constrained('users')->nullOnDelete();
            $table->float('adult_price')->default(0);
            $table->float('child_price')->default(0);
            $table->unsignedInteger('adults_count')->default(0);
            $table->unsignedInteger('children_count')->default(0);
            $table->float('total_price')->default(0);
            $table->date('date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
