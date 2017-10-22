<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lat');
            $table->integer('lng');
            $table->integer('alt');
            $table->integer('idsite');
            $table->timestamps();
            $table->foreign('idsite')->references('id')->on('sites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('puits');
    }
}
