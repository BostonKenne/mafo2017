<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyOnEchantillonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tech_echan', function (Blueprint $table) {
              $table->increments('id');
              $table->string('libelle')->nullable()->change();
              $table->text('description')->nullable()->change();

        });


        Schema::table('echantillons', function (Blueprint $table) {
            $table->integer('id_tech')->unsigned()->index()->nullable();
            $table->integer('id_user')->unsigned()->index()->nullable();

             $table->foreign('id_tech')->references('id')->on('tech_echan');
             $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('echantillons', function (Blueprint $table) {
            $table->dropcolumn('id_tech');
            $table->dropcolumn('is_user');

        });
    }
}
