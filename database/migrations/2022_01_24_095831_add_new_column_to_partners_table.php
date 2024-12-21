<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partners', function (Blueprint $table) {
            //14 столбцов.
            $table->enum('partner_type',['ООО','ИП','Самозанятый', 'No_type'])->nullable()->after('id')->comment('Тип партнера');
            $table->string('org_full_name',150)->nullable()->after('organisation_name')->comment('Полное название организации');
            $table->string('post_address',150)->nullable()->after('actual_address')->comment('Почтовый  адрес');
            $table->string('mobile_tel_owner',150)->nullable()->after('telephone')->comment('Телефон владельца');
            $table->string('director_name',150)->nullable()->after('partner_name')->comment('Генеральный директор');
            $table->string('bohalter_name',150)->nullable()->after('director_name')->comment('Главный бухгалтер');
            $table->string('kpp',12)->nullable()->after('socials')->comment('КПП');
            $table->string('ogrn_ip',20)->nullable()->after('ogrn')->comment('ОГРНИП');
            $table->string('bank_name',50)->nullable()->after('socials')->comment('Название банка');
            $table->string('fio',150)->nullable()->comment('ФИО');
            $table->string('passport_data',70)->nullable()->comment('Серия номер паспорта');
            $table->string('reg_address',200)->nullable()->comment('Адрес регистрации');
            $table->string('who_gave',200)->nullable()->comment('Кем выдан');
            $table->string('delivery_address',150)->nullable()->comment('Адрес точки самовывоза');


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
