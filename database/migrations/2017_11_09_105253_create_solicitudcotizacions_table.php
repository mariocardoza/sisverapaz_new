<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudcotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudcotizacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('formapago_id')->unsigned();
            $table->string('unidad')->nullable();
            $table->string('encargado')->nullable();
            $table->string('cargo_encargado')->nullable();
            $table->string('lugar_entrega');
            $table->string('numero_solicitud')->nullable();
            $table->date('fecha_limite')->nullable();
            $table->string('tiempo_entrega')->nullable();
            $table->foreign('formapago_id')->references('id')->on('formapagos');
            $table->integer('estado')->default(1);
            $table->string('motivobaja')->nullable();
            $table->date('fechabaja')->nullable();
            $table->integer('tipo')->nullable();
            $table->string('requisicion_id')->nullable();
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
        Schema::dropIfExists('solicitudcotizacions');
    }
}
