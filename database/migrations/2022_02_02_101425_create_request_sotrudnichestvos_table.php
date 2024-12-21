<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestSotrudnichestvosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_sotrudnichestvos', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable()->comment('Заголовок');
            $table->string('source',100)->nullable()->comment('Тема');
            $table->string('subject',100)->nullable()->comment('Тема');
            $table->string('name',100)->nullable()->comment('Тема');
            $table->string('city',100)->nullable()->comment('город');
            $table->string('direction',100)->nullable()->comment('Сфера услуг или товар');
            $table->string('phone_number',50)->nullable()->comment('номер телефона');
            $table->string('email',100)->nullable()->comment('email в заявке');
            $table->string('operator_name',100)->nullable()->comment('Имя оператора');
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
        Schema::dropIfExists('request_sotrudnichestvos');
    }
}
