<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('proveedor_id')->unsigned();
            $table->string('descripcion');
            $table->integer('estado')->default(1);
            $table->foreign('proveedor_id')->references('id')->on('proveedors');
            $table->boolean('seleccionado')->default(false);
            $table->bigInteger('solicitudcotizacion_id')->unsigned();
            $table->foreign('solicitudcotizacion_id')->references('id')->on('solicitudcotizacions');
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
        Schema::dropIfExists('cotizacions');
    }
}
