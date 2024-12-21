<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoLinksColumnToProductsToInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_to_info', function (Blueprint $table) {
            $table->string('video_links')->after('color')->nullable()->comment('Ccылки на видео продукта');
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
            $table->dropColumn('video_links');
        });
    }
}
