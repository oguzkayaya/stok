<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('status');
            $table->integer('offer_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_customers');
    }
}
