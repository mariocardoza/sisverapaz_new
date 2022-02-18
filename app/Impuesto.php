<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    protected $guarded = [];
    protected $dates = ['fechabaja'];

    public function tiposervicio()
    {
        return $this->belongsTo('App\Tiposervicio');
    }

    public function construccion()
    {
    	return $this->hasMany('App\Construccion');
    }
}
