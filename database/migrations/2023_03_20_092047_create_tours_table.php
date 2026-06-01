<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->float('adult_price')->nullable();
            $table->float('child_price')->nullable();
            $table->json('pricing_groups')->nullable();
            $table->float('start_from_price')->default(0);
            $table->boolean('enabled')->default(true);
            $table->boolean('featured')->default(false);
            $table->string('featured_image')->nullable();
            $table->text('location')->nullable();
            $table->json('gallery')->nullable();
            $table->float('duration')->nullable();
            $table->float('guests')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('tour_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained('tours')->cascadeOnDelete();
            $table->string('locale')->index()->default(config('app.locale'));
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('type')->nullable();
            $table->string('run')->nullable();
            $table->string('pickup_time')->nullable();
            $table->longText('overview')->nullable();
            $table->longText('highlights')->nullable();
            $table->longText('included')->nullable();
            $table->longText('excluded')->nullable();
            $table->longText('prices')->nullable();
            $table->longText('pricing_policy')->nullable();
            $table->longText('children_policy')->nullable();
            $table->longText('cancellation_policy')->nullable();
            $table->longText('deposit_payment')->nullable();
            $table->unique(['tour_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tour_translations');
        Schema::dropIfExists('tours');
    }
};
