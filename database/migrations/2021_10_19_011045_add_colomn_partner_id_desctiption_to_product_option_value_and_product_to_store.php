<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomnPartnerIdDesctiptionToProductOptionValueAndProductToStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_option_values', function (Blueprint $table) {
            $table->bigInteger('partner_id')->nullable()->default(0)->comment('id партнера')->after('store_id');
        });
        Schema::table('product_to_stores', function (Blueprint $table) {
            $table->bigInteger('partner_id')->nullable()->default(0)->comment('id партнера')->after('store_id');
        });
        Schema::table('product_options', function (Blueprint $table) {
            $table->bigInteger('partner_id')->nullable()->default(0)->comment('id партнера')->after('store_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_option_value_and_product_to_store', function (Blueprint $table) {
            //
        });
    }
}
