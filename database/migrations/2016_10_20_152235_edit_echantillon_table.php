<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditEchantillonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('echantillons', function ($table) {
            $table->dropForeign('echantillons_idsite_foreign');
            $table->renameColumn('idsite', 'idpuit');
            $table->foreign('idpuit')->references('id')->on('puits');
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
        Schema::table('echantillons', function ($table) {
            $table->dropForeign('echantillons_idpuit_foreign');
            $table->renameColumn('idpuit', 'idsite');
            $table->foreign('idsite')->references('id')->on('sites');
        });
    }
}
