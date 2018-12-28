<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->string('barcode');
            $table->string('image');
            $table->integer('sell_price');
            $table->integer('buy_price');
            $table->integer('tax');
            $table->integer('brand_id')->unsigned();
            $table->integer('product_category_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('product_category_id')->references('id')->on('product_categories');
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
        Schema::dropIfExists('products');
    }
}
