<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     * Миграция для таблицы партнеров
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('id from user table')->default(0);
            $table->unsignedBigInteger('store_id')->comment('id from store table')->default(0);
            $table->string('cpr',25)->nullable()->comment('id категория_партнер_регион');
            $table->string('organisation_name',150)->nullable()->comment('Название организации');
            $table->string('partner_name',100)->nullable()->comment('ФИО');
            $table->string('telephone',150)->nullable()->comment('Телефон');
            $table->string('email',150)->nullable()->comment('Email');
            $table->string('socials')->nullable()->comment('Соц.сети');
            $table->string('inn',15)->nullable()->comment('ИНН');
            $table->string('ogrn',20)->nullable()->comment('ОГРН');
            $table->string('bik',10)->nullable()->comment('БИК');
            $table->string('kor_account',25)->nullable()->comment('Кор.сч');
            $table->string('bank_account',25)->nullable()->comment('счет');
            $table->string('legal_address',150)->nullable()->comment('юр.адр');
            $table->string('actual_address',150)->nullable()->comment('факт. адр');
            $table->decimal('markup',10,2)->default(27.9)->comment('наценка');;
            $table->tinyInteger('status')->default(1)->comment('Статус партнерства');
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
        Schema::dropIfExists('partners');
    }
}
