<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoTitleForPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_title_for_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_name')->comment('Название страницы');
            $table->string('page_slug_contains')->comment('url страницы')->nullable();
            $table->foreignId('direction_id')->comment('id Направления')->nullable();
            $table->foreign('direction_id')->references('id')->on('directions')->onDelete('cascade');
            $table->string('title')->comment('title для страницы');
            $table->string('meta_description')->comment('meta_description страницы');
            $table->string('meta_keywords')->comment('meta_keywords для страницы');
            $table->string('seo_description')->nullable()->comment('Фраза в описании на странице');
            $table->enum('status',['on','off'])->comment('Статус');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_title_for_pages');
    }
}
