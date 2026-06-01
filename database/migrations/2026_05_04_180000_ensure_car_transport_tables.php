<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Locations, car routes (with prices & stops), and car rentals (with stops).
 * Safe if 2023_05_14_* migrations already ran: each step checks Schema::hasTable.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('locations')) {
            Schema::create('locations', function (Blueprint $table) {
                $table->id();
                $table->boolean('active')->default(true);
                $table->dateTime('translated_at')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('location_translations')) {
            Schema::create('location_translations', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('locale')->index()->default(config('app.locale'));
                $table->foreignId('location_id')->constrained('locations')->cascadeOnDelete();
                $table->unique(['location_id', 'locale']);
            });
        }

        if (! Schema::hasTable('car_routes')) {
            Schema::create('car_routes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pickup_location_id')->constrained('locations');
                $table->foreignId('destination_id')->constrained('locations');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('car_route_prices')) {
            Schema::create('car_route_prices', function (Blueprint $table) {
                $table->id();
                $table->foreignId('car_route_id')->constrained('car_routes')->cascadeOnDelete();
                $table->string('car_type')->nullable();
                $table->unsignedInteger('from');
                $table->unsignedInteger('to');
                $table->float('oneway_price');
                $table->float('rounded_price');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('car_route_stops')) {
            Schema::create('car_route_stops', function (Blueprint $table) {
                $table->id();
                $table->foreignId('car_route_id')->constrained('car_routes')->cascadeOnDelete();
                $table->foreignId('stop_location_id')->constrained('locations')->cascadeOnDelete();
                $table->float('price');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('car_rentals')) {
            Schema::create('car_rentals', function (Blueprint $table) {
                $table->id();
                $table->foreignId('booking_id')
                    ->nullable()
                    ->constrained('bookings')
                    ->nullOnDelete();
                $table->foreignId('pickup_location_id')->constrained('locations');
                $table->foreignId('destination_id')->constrained('locations');
                $table->float('car_route_price');
                $table->string('car_type')->nullable();
                $table->integer('adults');
                $table->integer('children')->default(0);
                $table->boolean('oneway')->default(true);
                $table->date('pickup_date');
                $table->time('pickup_time');
                $table->date('return_date')->nullable();
                $table->time('return_time')->nullable();
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('nationality')->nullable();
                $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
                $table->float('currency_exchange_rate')->default(1);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('car_rental_stops')) {
            Schema::create('car_rental_stops', function (Blueprint $table) {
                $table->id();
                $table->foreignId('car_rental_id')->constrained('car_rentals')->cascadeOnDelete();
                $table->foreignId('stop_location_id')->constrained('locations')->cascadeOnDelete();
                $table->float('price');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // No-op: tables may already exist from 2023_05_14_* migrations; dropping would risk data loss.
    }
};
