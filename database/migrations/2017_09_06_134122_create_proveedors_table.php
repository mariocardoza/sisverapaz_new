<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email')->nullable();
            $table->string('nit');
            $table->string('numero_registro')->nullable();
            $table->string('nombrer')->nullable();
            $table->string('telfijor')->nullable();
            $table->char('celular_r', 9)->nullable();
            $table->string('emailr')->nullable();
            $table->integer('estado')->unsigned()->default(1);
            $table->string('motivo')->nullable();
            $table->date('fechabaja')->nullable();
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
        Schema::dropIfExists('proveedors');
    }
}
