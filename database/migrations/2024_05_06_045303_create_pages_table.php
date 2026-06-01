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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->json('data')->nullable();
            $table->timestamps();
        });
        Schema::create('page_translations', function (Blueprint $table) {
            $table->id();
            $table->json('content')->nullable();
            $table->string('locale')->index()->default(config('app.locale'));
            $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
            $table->unique(['page_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('page_translations');
    }
};
