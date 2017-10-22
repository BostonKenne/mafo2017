<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAttrCollumnDateToIntOnEchantillonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('echantillons', function (Blueprint $table) {
             $table->dropColumn('date');
             $table->string('date_prelevement')->after('pfd_fin')->default('2000-20-12');
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
            $table->dropColumn('date');
        });
    }
}
