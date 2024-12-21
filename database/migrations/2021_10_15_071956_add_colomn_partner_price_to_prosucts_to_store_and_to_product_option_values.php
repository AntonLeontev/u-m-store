<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomnPartnerPriceToProsuctsToStoreAndToProductOptionValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_to_stores', function (Blueprint $table) {
            $table->integer('partner_price')->default('0')->comment('Цена партнера без наценки')
                ->after('store_id');
        });
        Schema::table('product_option_values', function (Blueprint $table) {
            $table->integer('partner_price')->default('0')->comment('Цена партнера без наценки')
                ->after('subtract');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prosuct_to_store', function (Blueprint $table) {
            //
        });
    }
}
