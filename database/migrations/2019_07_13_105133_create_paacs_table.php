<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paacs', function (Blueprint $table) {
            $table->string('id');
            $table->integer('anio');
            $table->double('total',12,2);
            $table->integer('estado')->default(1);
            $table->date('fecha_baja')->nullable();
            $table->string('motivo_baja')->nullable();
            $table->bigInteger('paaccategoria_id')->nullable()->unsigned();
            $table->foreign('paaccategoria_id')->references('id')->on('paac_categorias');
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
        Schema::dropIfExists('paacs');
    }
}
