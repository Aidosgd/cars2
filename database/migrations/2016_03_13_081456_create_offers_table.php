<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            //default
            $table->boolean('active');
            $table->string('category_id');
            $table->string('manufacturer');
            $table->string('partnumber');
            $table->string('title');
            $table->longText('description');
            $table->string('price');
            $table->string('phone');
            $table->string('address');
            $table->string('condition_id');
            $table->string('city_id');
            $table->string('delivery_id');
            $table->string('vehicle_brand_id');
            $table->string('user_id');
            //$table->string('availability_id');
            //tire and wheels
            $table->string('diameter_id');
            $table->string('count_id');
            //tire
            $table->string('tire_width_id');
            $table->string('tire_height_id');
            $table->string('tire_season_id');
            $table->string('tire_brand_id');
            //wheels
            $table->string('rim_type_id');
            $table->string('rim_width_id');
            $table->string('rim_pcd_id');
            $table->string('rim_et_id');
            $table->string('rim_dia_id');
            //time
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
        Schema::drop('offers');
    }
}
