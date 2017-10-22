<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesBibliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('references_biblios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referencable_id')->unsigned()->nullable();
            $table->string('auteur')->nullable();
            $table->string('titre')->nullable();
            $table->string('editeur')->nullable();
            $table->string('lien')->nullable();
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
        Schema::dropIfExists('references_biblios');
    }
}
