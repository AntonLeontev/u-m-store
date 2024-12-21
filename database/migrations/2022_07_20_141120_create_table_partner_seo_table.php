<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePartnerSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_seo', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('partner_id');
            $table->text('home_tags')->nullable();
            $table->text('category_tags')->nullable();
            $table->text('product_tags')->nullable();
            $table->text('metrika')->nullable();
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
        Schema::dropIfExists('partner_seo');
    }
}
