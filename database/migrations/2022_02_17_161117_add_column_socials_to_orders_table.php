<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSocialsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_type')->after('id')->nullable()->comment('Тип заказа');
            $table->string('url_sender')->after('transaction_id')->nullable()->comment('Url отправителя');
            $table->string('url_recipient')->after('transaction_id')->nullable()->comment('Url отправителя');
            $table->unsignedInteger('delivery_price_for_recipient')->after('total')->nullable()->comment('Цена доставки для получателя');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
