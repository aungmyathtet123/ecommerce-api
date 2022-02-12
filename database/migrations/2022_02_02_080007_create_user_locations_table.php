<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('enname')->nullable();
            $table->string('cnname')->nullable();
            $table->string('mmname')->nullable();
            $table->string('slug')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('location_id')->nullable();
            $table->integer('order')->nullable();
            $table->integer('active')->nullable();
            $table->longText('address')->nullable();
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
        Schema::dropIfExists('user_locations');
    }
}
