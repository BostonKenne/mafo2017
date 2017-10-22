<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEchantillonParametrePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('echantillon_parametre', function (Blueprint $table) {
            $table->integer('echantillon_id')->unsigned()->index();
            $table->foreign('echantillon_id')->references('id')->on('echantillons')->onDelete('cascade');
            $table->integer('parametre_id')->unsigned()->index();
            $table->foreign('parametre_id')->references('id')->on('parametres')->onDelete('cascade');
            $table->integer('laboratoire_id')->unsigned()->index();
            $table->foreign('laboratoire_id')->references('id')->on('laboratoires')->onDelete('cascade');
            $table->integer('image_id')->unsigned()->nullable();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->primary(['echantillon_id', 'parametre_id', 'laboratoire_id']);
            $table->double('valeur')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('echantillon_parametre');
    }
}
