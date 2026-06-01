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
        Schema::create('faq_category_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('locale')->index()->default(config('app.locale'));
            $table->foreignId('category_id')->constrained('faq_categories')->cascadeOnDelete();
            $table->unique(['category_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_categories_translations');
    }
};
