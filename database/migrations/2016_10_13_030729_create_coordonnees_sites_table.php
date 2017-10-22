<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordonneesSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordonnees_sites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lat');
            $table->integer('lng');
            $table->integer('alt');
            $table->integer('idsite')->unsigned();
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
        Schema::drop('coordonnees_sites');
    }
}
