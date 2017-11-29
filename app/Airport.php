<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    public static function getCity($iata_code)
    {
        $a = static::where('airport_code', $iata_code)->first();
        if(empty($a) || is_null($a)){
            return "";
        }else{
            return $a->airport_name;
        }
    }
}
