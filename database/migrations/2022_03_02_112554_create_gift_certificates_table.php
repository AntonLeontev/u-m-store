<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('id пользователя который может использовать сертификат');
            $table->unsignedBigInteger('store_id')->nullable()->comment('id города в котором можно использовать сертификат');
            $table->unsignedBigInteger('partner_id')->nullable()->comment('id партнера у которого можно использовать сертификат');
            $table->unsignedBigInteger('product_id')->nullable()->comment('id товара для которого можно использовать сертификат');
            $table->unsignedBigInteger('direction_id')->nullable()->comment('id направления где можно использовать сертификат');
            $table->string('name',40)->nullable()->comment('Название сертификата');
            $table->string('slug',60)->nullable()->comment('Url сертификата');
            $table->string('full_url')->nullable()->comment('Полный Url сертификата');
            $table->string('type',40)->nullable()->comment('Тип сертификата');
            $table->unsignedBigInteger('nominal')->nullable()->comment('Номинал сертификата в руб.');
            $table->unsignedBigInteger('count')->nullable()->comment('Ограничение по количеству использования');
            $table->unsignedBigInteger('user_id_used')->nullable()->comment('id направления где можно использовать сертификат');
            $table->timestamp('used_at')->nullable()->comment('Дата когда был использован сертификат');
            $table->timestamp('start_action_at')->useCurrent()->comment('Начало срока действия сертификата');
            $table->timestamp('end_action_at')->nullable()->comment('Конец срока действия сертификата');
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
        Schema::dropIfExists('gift_certificates');
    }
}
