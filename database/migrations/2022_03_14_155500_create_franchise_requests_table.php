<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchise_requests', function (Blueprint $table) {
            $table->id();
            $table->string('status',40)->nullable()->comment('Статус');
            $table->string('fio',90)->nullable()->comment('ФИО');
            $table->string('inn',15)->nullable()->comment('ИНН');
            $table->string('ogrn',20)->nullable()->comment('ОГРН');
            $table->string('kpp',12)->nullable()->comment('КПП');
            $table->string('bik',20)->nullable()->comment('БИК');
            $table->string('kor_account',25)->nullable()->comment('Кор.сч');
            $table->string('bank_account',25)->nullable()->comment('счет');

            $table->string('legal_address',200)->nullable()->comment('Юридический адрес');
            $table->string('actual_address',200)->nullable()->comment('Фактический адрес');

            $table->string('phone',20)->nullable()->comment('Email');
            $table->string('email',70)->nullable()->comment('Телефон');

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
        Schema::dropIfExists('franchise_requests');
    }
}
