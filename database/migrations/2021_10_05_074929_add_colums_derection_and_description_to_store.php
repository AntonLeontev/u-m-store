<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsDerectionAndDescriptionToStore extends Migration
{
    /**
     * Run the migrations.
     *Добавили колонки Вид деятельности и описание организации.
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->bigInteger('direction_id')->nullable()->comment('Вид деятельности');
            $table->text('description')->nullable()->comment('Описание организации');
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
        Schema::table('store', function (Blueprint $table) {
            //
        });
    }
}
