<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakeReviewsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fake_reviews_data', function (Blueprint $table) {
            $table->id();
            $table->string('data', 40)->comment('Дата размещения коментария');
            $table->string('user_name',60)->comment('Имя пользователя');
            $table->text('reviews')->comment('Текст отзыва');
            $table->bigInteger('user_id')->nullable()->comment('id созданного пользователя');
            $table->tinyInteger('status')->nullable()->comment('Статус размещения отзыва');
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
        Schema::dropIfExists('fake_reviews_data');
    }
}
