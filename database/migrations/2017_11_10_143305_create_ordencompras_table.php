<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdencomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordencompras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cotizacion_id')->unsigned()->nullable();
            $table->string('numero_orden');
            $table->string('observaciones');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->string('direccion_entrega');
            $table->string('adminorden');
            $table->foreign('cotizacion_id')->references('id')->on('cotizacions');
            $table->integer('estado')->default(1);
            $table->integer('tipo')->default(1);
            $table->bigInteger('contratacion_id')->unsigned()->nullable();
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
        Schema::dropIfExists('ordencompras');
    }
}
