<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    public static function getCity($iata_code)
    {
        return static::where('airport_code', $iata_code)->first()->airport_name;
    }
}
