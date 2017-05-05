<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopTireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_tire', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id')->unsigned();
            $table->integer('tire_id')->unsigned();
            $table->string('tires_count',20)->nullable();
//            $table->integer('tires_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_tire');
    }
}
