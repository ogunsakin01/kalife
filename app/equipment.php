<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class equipment extends Model
{
    public static function getEquipment($iata_code)
    {
        return static::where('code', $iata_code)->first()->name;
    }
}
