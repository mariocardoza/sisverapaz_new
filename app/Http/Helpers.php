<?php

use Illuminate\Support\Facades\Log;
use App\Status;
use App\Country;

class Helpers{
  public static function getStatusesByUser(){
    $statuses = Status::orderBy('id', 'asc')->get();
    return $statuses;
  }

  public static function getCountryByCode($code){
    if(!is_null($code)){
      $country = Country::where('code',$code)->first();
      if(!is_null($country)){
        return $country->name;
      }else{
        return 'No disponible';
      }
    }else{
      return '';
    }
  }
}