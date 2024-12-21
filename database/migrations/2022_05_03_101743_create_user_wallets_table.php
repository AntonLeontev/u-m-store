<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('Id пользователя');
            $table->string('wallet_type',20)->nullable()->comment('Тип кошелька ');
            $table->string('wallet_address',50)->nullable()->comment('Адрес кошелька');
            $table->string('wallet_file_name',100)->nullable()->comment('Имя кошелька');
            $table->string('wallet_pass_hash')->nullable()->comment('Хешированый пароль кошелька');
            $table->string('wallet_pass_type',15)->nullable()->comment('Тип пароля (отдельный или такой же как от учетной записи');
            $table->string('save_to_session',10)->nullable()->comment('Сохранение пароля в сессию.');
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
        Schema::dropIfExists('user_wallets');
    }
}
