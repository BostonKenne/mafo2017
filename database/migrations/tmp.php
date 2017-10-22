<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboratoireTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('laboratoires', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('ville');
            $table->double('lng');
            $table->double('lat');
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
        //
        Schema::drop('laboratoires');
    }

    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    <?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEchantillonParametrePivotTable2 extends Migration
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