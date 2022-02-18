<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraProyecto extends Model
{
    protected  $guarded = [];

    public static function bitacora($accion,$proyecto_id)
    {
        $bitacora = new BitacoraProyecto;
        $bitacora->fecha = date('Y-m-d');
        $bitacora->hora = date('H:i:s');
        $bitacora->accion = $accion;
        $bitacora->proyecto_id = $proyecto_id;
        $bitacora->save();
    }
}
