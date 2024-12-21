<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsToInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_to_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->string('weight')->nullable();
            $table->string('type')->nullable();
            $table->string('depth')->nullable();
            $table->string('height')->nullable();
            $table->string('diameter')->nullable();
            $table->string('peculiarities')->nullable();
            $table->string('age_limit')->nullable();
            $table->string('number_elements')->nullable();
            $table->string('appointment')->nullable();
            $table->string('taste')->nullable();
            $table->string('shelf_life')->nullable();
            $table->string('package')->nullable();
            $table->string('producing_country')->nullable();
            $table->string('equipment')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_to_info');
    }
}
