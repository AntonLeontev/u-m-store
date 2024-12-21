<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomnImageDesctiptionToPartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->bigInteger('direction_id')->nullable()->comment('Вид деятельности')->after('store_id');
            $table->text('description')->nullable()->comment('Описание организации')->after('cpr');
            $table->string('image')->nullable()->comment('Фото партнера')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partners', function (Blueprint $table) {
            //
        });
    }
}
