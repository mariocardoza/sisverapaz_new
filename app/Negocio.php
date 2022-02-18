<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model {
	protected $guarded = [];
	public function contribuyente() {
		return $this->belongsTo('App\Contribuyente');
	}

	public function rubro () {
		return $this->belongsTo('App\Rubro');
	}

	public function factura()
	{
		return $this->hasMany('App\FacturaNegocio','negocio_id');
	}

	public function factura_group()
	{
		return $this->hasMany('App\FacturaNegocio','negocio_id')->groupBy('negocio_id','tipo_cobro');
	}

	public function mora()
    {
        return $this->hasOne('App\MoraNegocio');
	}
}