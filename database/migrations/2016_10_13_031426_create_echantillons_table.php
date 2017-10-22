<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEchantillonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('echantillons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('pfd_debut');
            $table->integer('pfd_fin');
            $table->date('date');
            $table->string('autre_info');
            $table->string('couleur');
            $table->string('structure');
            $table->string('texture');
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
        Schema::drop('echantillons');
    }
}
