<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formapago extends Model
{
    protected $guarded = [];

    public static function Buscar($nombre,$estado)
    {
        return Formapago::nombre($nombre)->estado($estado)->orderBy('id')->paginate(10);
    }

    public function scopeEstado($query,$estado)
    {
        return $query->where('estado',$estado);
    }
    public function scopeNombre($query,$nombre)
    {
    	if(trim($nombre != "")){
            return $query->where('nombre','iLIKE', '%'.$nombre.'%');
    	}
    	
    }

    public function solicitudcotizacion()
    {
        return $this->hasOne('App\Solicitudcotizacion');
    }
}
