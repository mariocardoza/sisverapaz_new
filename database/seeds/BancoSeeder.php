<?php

use Illuminate\Database\Seeder;
use App\Banco;
use App\afp as Afp;
use App\CatCargo;
use App\Formapago;

class BancoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Banco::all()->count() < 1){
            $por= new Banco();
            $por->nombre='Banco Agrícola';
            $por->save();

            $por= new Banco();
            $por->nombre='Banco de Fomento Agropecuario';
            $por->save();

            $por= new Banco();
            $por->nombre='Banco Hipotecario';
            $por->save();
        }

        if (Afp::all()->count() < 1){
            $por= new Afp();
            $por->codigo = date("Yhsimi");
            $por->nombre='Confía';
            $por->save();

            $por= new Afp();
            $por->codigo = date("Yidisus");
            $por->nombre='Crecer';
            $por->save();
        }

        if (CatCargo::all()->count() < 1){
            $por= new CatCargo();
            $por->id = date("Yidisus");
            $por->nombre='Administrativos';
            $por->save();

            $por= new CatCargo();
            $por->id = date("Yhsimi");
            $por->nombre='Parque y Cementerios';
            $por->save();

            $por= new CatCargo();
            $por->id = date("Yhsismi");
            $por->nombre='Casa de Encuentro';
            $por->save();

            $por= new CatCargo();
            $por->id = date("Ysimi");
            $por->nombre='Compostaje';
            $por->save();
        }

        if (Formapago::all()->count() < 1){
            $por= new Formapago();
            $por->nombre='Contado';
            $por->save();

            $por= new Formapago();
            $por->nombre='Crédito';
            $por->save();

            $por= new Formapago();
            $por->nombre='Cheque';
            $por->save();
        }
    }
}
