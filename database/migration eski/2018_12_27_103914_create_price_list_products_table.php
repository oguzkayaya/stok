<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceListProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_list_products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('price');
            $table->integer('product_id')->unsigned();
            $table->integer('price_list_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('price_list_id')->references('id')->on('price_lists');
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
        Schema::dropIfExists('price_list_products');
    }
}
