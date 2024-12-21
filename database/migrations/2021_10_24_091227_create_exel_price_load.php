<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExelPriceLoad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exel_price_load', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('store_id')->comment('id в таблице store');
            $table->bigInteger('partner_id')->comment('partner_id из таблицы partners');
            $table->string('store_real_name')->comment('название выбранного real_name в таблице store');
            $table->string('file_name')->comment('название загруженного файла в базу');
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
        Schema::dropIfExists('exel_price_load');
    }
}
