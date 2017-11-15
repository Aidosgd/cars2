<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('tires', function (Blueprint $table) {
//            $table->increments('id');
//            $table->boolean('active');
//            $table->string('brand_id');
//            $table->string('model_title');
//            $table->string('width_id');
//            $table->string('height_id');
//            $table->string('diameter_id');
//            $table->string('season_id');
//            $table->string('city_id');
//            $table->string('availability_id');
//            $table->string('price');
//            $table->string('user_id');
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tires');
    }
}
