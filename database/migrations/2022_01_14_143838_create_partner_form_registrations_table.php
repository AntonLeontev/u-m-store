<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerFormRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_form_registrations', function (Blueprint $table) {
            $table->id();
            $table->enum('partner_type',['ООО','ИП','Самозанятый', 'Ген. Партнер', 'No_type'])->nullable()->comment('Тип партнера');
            $table->string('direction',150)->nullable()->comment('Сфера услуг/товаров');
            $table->string('city_name',170)->nullable()->comment('Город');
            $table->string('org_full_name',150)->nullable()->comment('Полное название организации');
            $table->string('org_short_name',150)->nullable()->comment('Короткое название организации');
            $table->string('shop_name',100)->nullable()->comment('Название отображаемое на сайте');
            $table->string('legal_address',150)->nullable()->comment('Юридический адрес');
            $table->string('actual_address',150)->nullable()->comment('Фактический адрес');
            $table->string('post_address',150)->nullable()->comment('Почтовый  адрес');
            $table->string('director_name',150)->nullable()->comment('Генеральный директор');
            $table->string('bohalter_name',150)->nullable()->comment('Главный бухгалтер');


            $table->string('inn',15)->nullable()->comment('ИНН');
            $table->string('kpp',12)->nullable()->comment('КПП');
            $table->string('ogrn',20)->nullable()->comment('ОГРН');
            $table->string('ogrn_ip',20)->nullable()->comment('ОГРНИП');
            $table->string('bank_name',50)->nullable()->comment('Название банка');
            $table->string('bank_account',25)->nullable()->comment('счет');
            $table->string('kor_account',25)->nullable()->comment('Кор.сч');
            $table->string('bik',10)->nullable()->comment('БИК');
            $table->string('email',150)->nullable()->comment('Email');
            $table->string('org_tel',150)->nullable()->comment('Телефон организации/предприятия');
            $table->string('mobile_tel_owner',150)->nullable()->comment('Телефон владельца');
            $table->string('socials')->nullable()->comment('Соц.сети');



            $table->string('fio',150)->nullable()->comment('ФИО');
            $table->string('passport_data',70)->nullable()->comment('Серия номер паспорта');
            $table->string('reg_address',200)->nullable()->comment('Адрес регистрации');
            $table->string('who_gave',200)->nullable()->comment('Кем выдан');

            $table->string('delivery_address',150)->nullable()->comment('Адрес точки самовывоза');
            $table->string('delivery_price',30)->nullable()->comment('Цена доставки');

            $table->string('status',20)->default('CREATED')->comment('Статус проверки данных менеджером');
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
        Schema::dropIfExists('partner_form_registrations');
    }
}
