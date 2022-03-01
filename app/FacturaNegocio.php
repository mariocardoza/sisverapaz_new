<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaNegocio extends Model
{
    protected $guarded = [];
    protected $dates=['fechaVencimiento'];
    
    public function negocio()
    {
        return $this->belongsTo('App\Negocio','negocio_id');
    }

    public function items()
    {
        return $this->hasMany('App\FacturaNegocioItem','facturanegocio_id');
    }

    public static function tiene_facturas($id)
    {
        $negocio = Negocio::find($id);
        $tiene=0;
        if(!is_null($negocio)){
            if($negocio->tipo_cobro!=1){
                $tiene = FacturaNegocio::where('negocio_id',$negocio->id)->whereYear('created_at',date("Y"))->count();
            }
        }
        return $tiene;
    }
}
