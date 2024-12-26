<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClonePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clone_promotions', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('partner_id')->comment('Id Партнера');
            $table->unsignedBigInteger('cs_info_id')->comment('Id записи clone_site_info');
            $table->string('sort',20)->nullable()->comment('позиция в слайдере');
            $table->string('url')->nullable()->comment('ссылка на баннере');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('clone_promotions');
    }
}
