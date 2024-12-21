<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPartnerTypeToPartnerFormRegistration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_form_registrations', function (Blueprint $table) {

            DB::statement("ALTER TABLE partner_form_registrations MODIFY partner_type ENUM('ООО','ИП','Самозанятый','Ген. Партнер','No_type')");
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
