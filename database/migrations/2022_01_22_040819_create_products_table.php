<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('enname')->nullable();
            $table->string('cnname')->nullable();
            $table->string('mmname')->nullable();
            $table->text('description')->nullable();
            $table->text('endescription')->nullable();
            $table->text('cndescription')->nullable();
            $table->text('mydescription')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->double('price');
            $table->bigInteger('user_id');
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
