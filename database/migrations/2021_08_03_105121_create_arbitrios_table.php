<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArbitriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arbitrios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('base_imponible',10,2);
            $table->double('tarifa_imponible',10,2);
            $table->double('excedente',10,2);
            $table->double('tarifa_excedente',10,2);
            $table->double('valor_fijo',10,2);
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
        Schema::dropIfExists('arbitrios');
    }
}
