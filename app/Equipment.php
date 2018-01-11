<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
  public static function getEquipment($iata_code)
  {
    $a = static::where('code', $iata_code)->first();
    if(is_null($a) || empty($a)){
      return "";
    }
    else{
      return $a->name;
    }
  }
}
