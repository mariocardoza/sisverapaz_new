<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogTarifa extends Model
{
    protected $dates = ['available_to','available_from'];
}
