<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityWeatherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_weather', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id')->unsigned();
            $table->timestamp('timestamp');
            $table->decimal('temp', 4, 2);
            $table->decimal('pressure', 4, 2);
            $table->integer('humidity');
            $table->foreign('city_id')
                    ->references('id')
                    ->on('cities')
                    ->onCascade('delete');
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
        Schema::dropIfExists('city_weather');
    }
}
