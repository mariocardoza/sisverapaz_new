<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesembolsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desembolsos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('monto',8,2);
            $table->string('detalle');
            $table->bigInteger('payment_table_id');
            $table->string('table');
            $table->bigInteger('cuenta_id')->unsigned()->nullable();
            $table->integer('estado')->default(1); // 1: pendiente 2: anulado  3:realizado
            $table->string('motivo')->nullable();
            $table->date('fecha_pago')->nullable();
            $table->foreign('cuenta_id')->references('id')->on('cuentas');
            $table->float('renta',8,2)->nullable();
            $table->date('fecha_desembolso')->nullable();
            $table->string('numero_cheque')->nullable();
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
        Schema::dropIfExists('desembolsos');
    }
}
