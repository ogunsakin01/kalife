<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIataCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iata_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iata');
            $table->string('iso');
            $table->string('name');
            $table->string('continent');
            $table->string('type');
            $table->char('latitude',200);
            $table->char('longitude',200);
            $table->string('size');
            $table->integer('status');
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
        Schema::dropIfExists('iata_cities');
    }
}
