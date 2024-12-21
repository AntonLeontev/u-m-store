<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockChainTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_chain_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('method',20)->nullable()->comment('Метод запроса');
            $table->string('function_api',30)->nullable()->comment('Функция запроса');
            $table->json('response_json',20)->nullable()->comment('ответ на запрос');
            $table->string('status_code',10)->nullable()->comment('Код статуса ответа');
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
        Schema::dropIfExists('block_chain_transactions');
    }
}
