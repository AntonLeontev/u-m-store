<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDiscountToProductToStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_to_stores', function (Blueprint $table) {
            $table->integer('discount')->after('store_price')->default(0)->comment('Скидка на товар для старой цены');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_to_stores', function (Blueprint $table) {
            $table->dropColumn('discount');
        });
    }
}
