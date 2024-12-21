<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name_promotion')->comment('Название акции');
            $table->string('image')->comment('Image для акции');
            $table->string('description')->comment('Описание условий проведения акции');
            $table->string('city_slug')->nullable()->comment('Slug города в котором действует акция');
            $table->dateTime('date_beginning')->comment('Дата и время начала акции');
            $table->dateTime('date_end')->comment('Дата и время окончания акции');
            $table->foreignId('direction_id')->comment('id Направления')->nullable();
            $table->foreign('direction_id')->references('id')->on('directions')->onDelete('cascade');
            $table->foreignId('coupons_id')->comment('id купона или промокода для акции')->nullable();
            $table->foreign('coupons_id')->references('id')->on('coupons')->onDelete('cascade');
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
        Schema::dropIfExists('promotions');
    }
}
