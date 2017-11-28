<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    public static function getAirline($iata_code)
    {
        return static::where('IATA', $iata_code)->first()->Airline;
    }
}
