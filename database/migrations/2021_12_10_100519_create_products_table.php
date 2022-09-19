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
          $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('image')->nullable();
            $table->text('description')->nullable();
            $table->date('exp_date')->nullable();
            $table->text('contact_info')->nullable();
            $table->boolean('check')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('like_count')->nullable();
            $table->integer('price')->nullable();
            $table->integer('pe1')->nullable();
            $table->integer('pe2')->nullable();
            $table->integer('pe3')->nullable();
            $table->integer('discount_pe1')->nullable();
            $table->integer('discount_pe2')->nullable();
            $table->integer('discount_pe3')->nullable();
            $table->integer('view_count')->nullable(); 
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
