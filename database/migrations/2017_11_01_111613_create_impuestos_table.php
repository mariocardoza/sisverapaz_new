<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impuestos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tiposervicio_id')->unsigned();
            $table->double('impuesto',2,2);
            $table->integer('estado')->default(1);
            $table->string('motivo')->nullable();
            $table->date('fechabaja')->nullable();
            $table->string('acuerdo')->nullable();
            $table->foreign('tiposervicio_id')->references('id')->on('tiposervicios');
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
        Schema::dropIfExists('impuestos');
    }
}
