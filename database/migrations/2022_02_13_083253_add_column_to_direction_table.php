<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToDirectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('directions', function (Blueprint $table) {
            $table->string('abbreviation',10)->nullable()->comment('аббревиатура для договора');
            $table->unsignedBigInteger('last_contract_number')->default(0)->comment('Последний номер договора для данной категории');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('direction', function (Blueprint $table) {
            //
        });
    }
}
