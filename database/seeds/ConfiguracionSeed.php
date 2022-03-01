<?php

use Illuminate\Database\Seeder;
use App\Configuracion;
use App\Porcentaje;
use App\CategoriaRubro;
use App\Arbitrio;

class ConfiguracionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* $this->truncateTables([
            'configuracions',
            'porcentajes',
        ]);*/
        if (CategoriaRubro::all()->count() < 1){
            $por= new CategoriaRubro();
            $por->nombre='Servicios';
            $por->save();

            $por= new CategoriaRubro();
            $por->nombre='Comercios';
            $por->save();

            $por= new CategoriaRubro();
            $por->nombre='Licencias';
            $por->save();
        }
        if (Configuracion::all()->count() < 1){
            $con=new Configuracion();
            $con->direccion_alcaldia='Calle Norberto Marroquín, Barrio Mercedes';
            $con->nit_alcaldia='1013-011290-001-2';
            $con->licitacion=50000;
            $con->telefono_alcaldia='2345-6789';
            $con->escudo_alcaldia='logo_alcaldia_2020-02-23-09-30-42-pm.png';
            $con->nacimiento_alcalde='1950-01-01';
            $con->save();
        }

        if (Porcentaje::all()->count() < 1){
            $por= new Porcentaje();
            $por->tipo='%';
            $por->nombre='Renta';
            $por->nombre_simple='renta';
            $por->porcentaje=15;
            $por->save();

            $por= new Porcentaje();
            $por->tipo='%';
            $por->nombre='IVA';
            $por->nombre_simple='iva';
            $por->porcentaje=13;
            $por->save();

            $por= new Porcentaje();
            $por->tipo='%';
            $por->nombre='Fiestas Patronales';
            $por->nombre_simple='fiestas';
            $por->porcentaje=5;
            $por->save();

            $por= new Porcentaje();
            $por->tipo='$';
            $por->nombre='Mora contribuyentes';
            $por->nombre_simple='mora';
            $por->porcentaje=3.5;
            $por->save();

            $por= new Porcentaje();
            $por->tipo='%';
            $por->nombre='Construcciones';
            $por->nombre_simple='construccion';
            $por->porcentaje=6;
            $por->save();

            $por= new Porcentaje();
            $por->tipo='%';
            $por->nombre='Renta Servicio';
            $por->nombre_simple='renta_servicio';
            $por->porcentaje=10;
            $por->es_servicio=1;
            $por->save();
        }

        if (Arbitrio::all()->count() < 1){
            $ar = new Arbitrio();
            $ar->base_imponible=228.27;
            $ar->tarifa_imponible=0.46;
            $ar->excedente=114.28;
            $ar->tarifa_excedente=0.11;
            $ar->valor_fijo=9.57;
            $ar->save();
        }
    }

    public function truncateTables(array $tables)
    {
       /* DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');*/
    }
}