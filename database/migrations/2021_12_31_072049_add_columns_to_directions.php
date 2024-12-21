<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDirections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('directions', function (Blueprint $table) {
            $table->smallInteger('in_menu')->default(0)->after('slug')->comment('Add in main menu');
            $table->smallInteger('sort')->default(0)->after('in_menu')->comment('sort in main menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('directions', function (Blueprint $table) {
            $table->dropColumn('in_menu');
            $table->dropColumn('sort');
        });
    }
}
