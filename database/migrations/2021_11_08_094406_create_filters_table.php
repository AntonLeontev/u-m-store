<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('direction_id' )->unsigned()->nullable()->default(1)->comment('id направления');
            $table->bigInteger('parent_id' )->unsigned()->default(0)->comment('Описание фильтра');
            $table->string('name', 80)->comment('Название фильтра');
            $table->string('desctiption' )->nullable()->comment('Описание фильтра');
            $table->string('slug',80 )->comment('url для фильтра');
            $table->tinyInteger('status' )->unsigned()->default(1)->comment('Статус на сайте');
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
        Schema::dropIfExists('filters');
    }
}
