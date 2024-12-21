<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChainStatusTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chain_status_transactions', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('Id пользователя');
            $table->string('status',10)->nullable()->comment('Код статуса ответа');
            $table->string('wallet_address',60)->comment('Адрес кошелька');
            $table->string('txId',80)->comment('id операции');
            $table->string('method_api',50)->nullable()->comment('Функция запроса');
            $table->json('response_json')->nullable()->comment('ответ на запрос метода');
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
        Schema::dropIfExists('chain_status_transactions');
    }
}
