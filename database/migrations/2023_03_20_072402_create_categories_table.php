<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('enabled')->default(true);
            $table->boolean('featured')->default(false);
            $table->string('banner')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('category_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->text('slug')->nullable();
            $table->string('locale')->index()->default(config('app.locale'));
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->unique(['category_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_translations');
        Schema::dropIfExists('categories');
    }
};
