<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPartnerFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_form_registrations', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id')->nullable()->comment('id from user table');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner_form_registrations', function (Blueprint $table) {
            //
        });
    }
}
