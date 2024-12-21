<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOptionValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_option_values', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('store_id')->unsigned();
            $table->bigInteger('product_option_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('option_id')->unsigned();
            $table->bigInteger('option_value_id')->unsigned();
            $table->smallInteger('quantity');
            $table->smallInteger('subtract');
            $table->decimal('price');
            $table->string('points_prefix');
            $table->decimal('weight', 15, 8);
            $table->string('weight_prefix');
            $table->timestamps();
            $table->foreign('product_option_id')->references('id')->on('product_options')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('option_value_id')->references('id')->on('option_values')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_option_values');
    }
}
