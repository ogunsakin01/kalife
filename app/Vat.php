<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vat extends Model
{
    public static function getVat(){
        return static::where('id', 1)->first();
    }
}
