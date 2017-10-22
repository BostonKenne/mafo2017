<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lien');
            $table->integer('idsite')->unsigned()->nullable();
            $table->integer('idechantillon')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('idsite')->references('id')->on('sites');
            $table->foreign('idechantillon')->references('id')->on('echantillons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images');
    }
}
