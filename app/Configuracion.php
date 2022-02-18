<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $guarded = [];

    protected $dates = ['nacimiento_alcalde'];

    public function getUrlPathAttribute(){
    	return \Storage::url('logos/'.$this->escudo_alcaldia);
    }

    public function getUrlGobAttribute(){
    	return \Storage::url('logos/'.$this->escudo_gobierno);
    }
}
