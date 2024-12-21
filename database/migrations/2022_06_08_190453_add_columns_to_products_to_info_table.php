<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductsToInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_to_info', function (Blueprint $table) {
            $table->string('color_hex')->after('color')->nullable()->comment('Еще один цвет указанный в hex');
            $table->string('vendor_code')->after('color_hex')->nullable()->comment('Артикул товара');
            $table->string('brand')->after('color_hex')->nullable()->comment('Бренд товара');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_to_info', function (Blueprint $table) {
            $table->dropColumn('color_hex');
            $table->dropColumn('vendor_code');
            $table->dropColumn('brand');
        });
    }
}
