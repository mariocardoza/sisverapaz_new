<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipopago extends Model
{
    protected $guarded = [];

    public function pago()
    {
        return $this->hasMany('App\Pago');
    }
}
