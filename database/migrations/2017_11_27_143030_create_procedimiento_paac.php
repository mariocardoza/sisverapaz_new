<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedimientoPaac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*$sql = <<<FinSP
      CREATE OR REPLACE FUNCTION public.paac(
        anioo integer,
        totall real,
        obra character varying)
      RETURNS boolean AS
    $$
    DECLARE idpaac INTEGER :=0;
    BEGIN
    	SELECT "id" INTO idpaac FROM paacs where anio=anioo;
    	IF(idpaac > 0) THEN
    	UPDATE paacs SET total=total+totall WHERE "id"=idpaac;
    	ELSE
    	INSERT INTO paacs (anio,descripcion,total) VALUES (anioo,obra,total);
    	END IF;

    	RETURN true;

    END
    $$
      LANGUAGE plpgsql VOLATILE
      COST 100;
    ALTER FUNCTION public.paac(integer, real, character varying)
      OWNER TO postgres;
FinSP;
DB::connection()->getPdo()->exec($sql);*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      /*$sql = "DROP FUNCTION public.paac(integer, real, character varying);";
          DB::connection()->getPdo()->exec($sql);*/
    }
}
