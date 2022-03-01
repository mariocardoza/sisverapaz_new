<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarFuenteFinanciamientoRequisiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requisiciones', function (Blueprint $table) {
            //$table->dropForeign('requisiciones_fondocat_id_foreign');
            $table->bigInteger('cuenta_id')->nullable()->unsigned();
            $table->foreign('cuenta_id')->references('id')->on('cuentas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requisiciones', function (Blueprint $table) {
            $table->dropForeign('requisiciones_cuenta_id_foreign');
            $table->dropColumn('cuenta_id');
        });
    }
}
