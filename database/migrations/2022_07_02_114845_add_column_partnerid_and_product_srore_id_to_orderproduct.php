<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPartneridAndProductSroreIdToOrderproduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->unsignedBigInteger('product_store_id')->after('product_id')->nullable()->comment('id товара в таблице product_to_store');
            $table->unsignedBigInteger('partner_id')->after('product_id')->nullable()->comment('id партнера которому принадлежит товар.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->dropColumn('product_store_id','partner_id');

        });
    }
}
