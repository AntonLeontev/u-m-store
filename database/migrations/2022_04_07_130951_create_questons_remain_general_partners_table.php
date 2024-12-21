<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestonsRemainGeneralPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_remain_general_partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('Id пользователя');
            $table->string('status',20)->nullable()->comment('Статус');
            $table->string('notes',250)->nullable()->comment('Примечания оператора');
            $table->string('questions_name',60)->nullable()->comment('Имя пользователя');
            $table->string('questions_phone',20)->nullable()->comment('Телефон');
            $table->string('questions_email',60)->nullable()->comment('Email ');
            $table->string('questions_message',250)->nullable()->comment('Текст сообщения');
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
        Schema::dropIfExists('questons_remain_general_partners');
    }
}
