<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTarifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_tarifas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo');//% o $
            $table->double('valor',8,4);
            $table->date('available_from')->nullable();
            $table->date('available_to')->nullable();
            $table->string('tabla');
            $table->bigInteger('tabla_id');
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
        Schema::dropIfExists('log_tarifas');
    }
}
