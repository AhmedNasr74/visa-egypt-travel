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
        Schema::create('blog_category_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->foreignId('blog_category_id')->constrained('blog_categories')->cascadeOnDelete();
            $table->string('locale')->index()->default(config('app.locale'));
            $table->unique(['blog_category_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_category_translations');
    }
};
