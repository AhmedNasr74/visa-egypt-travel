<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->morphs('seo');
            $table->text('og_image')->nullable();
            $table->timestamps();
        });
        Schema::create('seo_translations', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->longText('og_description')->nullable();
            $table->string('locale')->index()->default(config('app.locale'));
            $table->foreignId('seo_id')->constrained('seos')->cascadeOnDelete();
            $table->unique(['seo_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('seo_translations');
        Schema::dropIfExists('seos');
    }
};
