<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_resumes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('partner_id');
            $table->string('city');
            $table->string('population');
            $table->string('entity');
            $table->string('store_name');
            $table->string('store_address');
            $table->string('store_description');
            $table->string('phone');
            $table->string('start_working');
            $table->string('store_site')->nullable();
            $table->string('store_turnover')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('vk_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('telegram_link')->nullable();
            $table->string('odnoklassniki_link')->nullable();
            $table->string('month_turnover_in_socials')->nullable();
            $table->string('month_turnover')->nullable();
            $table->string('store_expenses')->nullable();
            $table->string('staff_count');
            $table->string('leased_area');
            $table->string('rental_price_per_month')->nullable();
            $table->string('taxation_system')->nullable();
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
        Schema::dropIfExists('partner_resumes');
    }
}
