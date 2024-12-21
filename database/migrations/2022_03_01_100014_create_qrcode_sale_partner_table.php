<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrcodeSalePartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qrcode_sale_partner', function (Blueprint $table) {
            $table->id();
            $table->string('qr_slug',40)->nullable()->unique()->comment('Slug для QR кода');
            $table->string('full_url',)->nullable()->unique()->comment('Полный url для QR кода');
            $table->unsignedInteger('user_id')->nullable()->comment('id Пользователя');
            $table->unsignedInteger('partner_id')->nullable()->comment('id Партнера');
            $table->unsignedInteger('store_id')->nullable()->comment('id Города');
            $table->unsignedInteger('sale_count')->nullable()->comment('Количество продаж');
            $table->unsignedInteger('total_sales')->nullable()->comment('Общая сумма');
            $table->string('Organisation_name')->nullable()->comment('Название организации');
            $table->string('full_address')->nullable()->comment('Полный адрес');
            $table->string('where_to_transfer')->nullable()->comment('Куда выводить средства');
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
        Schema::dropIfExists('qrcode_sale_partner');
    }
}
