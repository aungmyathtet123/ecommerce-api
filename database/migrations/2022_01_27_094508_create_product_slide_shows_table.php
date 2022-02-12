<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSlideShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_slide_shows', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('enname')->nullable();
            $table->string('cnname')->nullable();
            $table->string('mmname')->nullable();
            $table->string('caption');
            $table->string('encaption')->nullable();
            $table->string('cncaption')->nullable();
            $table->string('mmcaption')->nullable();
            $table->text('description')->nullable();
            $table->text('endescription')->nullable();
            $table->text('cndescription')->nullable();
            $table->text('mydescription')->nullable();
            $table->bigInteger('product_id');
            $table->string('image');
            $table->integer('type')->default(1);
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
        Schema::dropIfExists('product_slide_shows');
    }
}
