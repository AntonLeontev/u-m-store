<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCloneBottomSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clone_bottom_sliders', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('partner_id')->comment('Id Партнера');
            $table->unsignedBigInteger('cs_info_id')->comment('Id записи clone_site_info');
            $table->string('sort',20)->nullable()->comment('позиция в слайдере');
            $table->string('url')->nullable()->comment('ссылка на баннере');
            $table->string('text_button',70)->nullable()->comment('Текст на кнопке');
            $table->string('color_text_button',10)->nullable()->comment('Цвет текста на кнопке');
            $table->string('color_button',10)->nullable()->comment('Цвет кнопки');
            $table->string('text_slider')->nullable()->comment('Текст на баннере');
            $table->string('color_text_slider')->nullable()->comment('Цвет текста на баннере');
            $table->string('image')->nullable();
            $table->string('dest_page',50)->nullable()->comment('Страница назначения');
            $table->string('size_device',50)->nullable()->comment('Размер для какого устройства Desktop, m');
            $table->string('status',20)->nullable()->comment('Статус на сайте');
            $table->string('moderation',20)->nullable()->comment('Статус модерации');
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
        Schema::dropIfExists('clone_bottom_sliders');
    }
}
