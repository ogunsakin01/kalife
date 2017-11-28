<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    public static function getAirline($iata_code)
    {
        $airline = static::where('IATA', $iata_code)->first();

        if(is_null($airline) || empty($airline))
        {
            return "";
        }
        else
        {
            return $airline->Airline;
        }

    }
}
