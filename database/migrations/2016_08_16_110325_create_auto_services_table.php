<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('title');
            $table->boolean('active');
            $table->integer('city_id');
//            $table->integer('auto_services_status_id');
            $table->integer('auto_services_category_id');
            $table->string('address');
            $table->string('phone');
            $table->string('web_site');
            $table->longText('description');
            $table->longText('map');
            $table->integer('user_id');

            //СТО
//            $table->integer('auto_services_repair_works_id');
//            $table->integer('vehicle_brand_id');

            //Автомойки
//            $table->integer('auto_services_mode_operation_id');
//            $table->integer('auto_services_washing_type_id');

            //Автострахование
//            $table->integer('auto_services_insurance_type_id');
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
        Schema::drop('auto_services');
    }
}
