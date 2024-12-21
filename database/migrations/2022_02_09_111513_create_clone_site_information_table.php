<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCloneSiteInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clone_site_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->comment('id Партнера');
            $table->foreignId('store_id')->nullable()->comment('id Города');
            $table->foreignId('direction_id')->default(1)->comment('id Города');
            $table->foreignId('seo_partner_id')->nullable()->comment('id Города');
            $table->string('domain', 100)->unique()->comment('Домен сайта');
            $table->string('city_name', 100)->nullable()->comment('Логотип');
            $table->string('logo')->nullable()->comment('Логотип');
            $table->string('company_name',100)->nullable()->comment('Логотип');
            $table->string('phone',30)->nullable()->comment('Телефон компании');
            $table->string('email',100)->nullable()->comment('E-mail компании');
            $table->string('address')->nullable()->comment('Адрес');
            $table->string('inst_link')->nullable()->comment('Инстаграм ссылка');
            $table->string('vk_link')->nullable()->comment('ВКонтакте ссылка');
            $table->string('fb_link')->nullable()->comment('FaceBook ссылка');
            $table->string('youtube_link')->nullable()->comment('YouTube ссылка');
            $table->string('telegram_link')->nullable()->comment('Телеграм ссылка');
            $table->decimal('margin',10,2)->nullable()->comment("Наценка на сайте в процентах");
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
        Schema::dropIfExists('clone_site_information');
    }
}
