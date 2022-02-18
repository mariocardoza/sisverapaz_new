<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisicionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisiciones', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('codigo_requisicion');
            $table->string('actividad');
            $table->bigInteger('user_id')->unsigned();
            $table->text('observaciones')->nullable();
            $table->text('justificacion');
            $table->date('fecha_acta')->nullable();
            $table->boolean('es_consolidado')->default(false);
            $table->integer('estado')->unsigned()->default(1);
            $table->string('combinado_id')->nullable();
            $table->string('nombre_archivo')->nullable();
            $table->date('fecha_solicitud')->nullable();
            $table->integer('anio')->nullable();
            $table->boolean('enviada')->default(false);
            $table->boolean('conpresupuesto')->default(false);
            $table->date('fecha_baja')->nullable();
            $table->string('motivo_baja')->nullable();
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
        Schema::dropIfExists('requisiciones');
    }
}
