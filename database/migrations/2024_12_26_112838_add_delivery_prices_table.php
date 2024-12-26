<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('delivery_prices', function (Blueprint $table) {
			$table->id();
			$table->foreignId('partner_id')->constrained('partners')->onDelete('cascade');
			$table->string('region');
			$table->unsignedInteger('price');	
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_prices');
    }
}
