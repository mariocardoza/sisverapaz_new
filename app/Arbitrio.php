<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Arbitrio extends Model
{
    protected $guarded = [];

    public static function calculo_impuesto($activo_imponible)
    {
        $arbitio = Arbitrio::find(1);
        $excedente = $activo_imponible-$arbitio->base_imponible;
        $tarifa_excedente = round(($excedente/$arbitio->excedente)*$arbitio->tarifa_excedente,2);
        $total_pagar = round($tarifa_excedente+$arbitio->tarifa_imponible,2);
        $total = $total_pagar+$arbitio->valor_fijo;
        return $total;
    }

    public static function calculo_impuesto_fiestas($activo_imponible)
    {
        $arbitio = Arbitrio::find(1);
        $excedente = $activo_imponible-$arbitio->base_imponible;
        $tarifa_excedente = round(($excedente/$arbitio->excedente)*$arbitio->tarifa_excedente,2);
        $total_pagar = round($tarifa_excedente+$arbitio->tarifa_imponible,2);
        $total = $total_pagar*(DB::table('porcentajes')->where('nombre_simple','fiestas')->get()->first()->porcentaje/100);
        return round($total,2);
    }
}
