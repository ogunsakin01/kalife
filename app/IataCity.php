<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IataCity extends Model
{
    public static function getCity($iata_code)
    {
        $a = static::where('iata', $iata_code)->first();
        if(empty($a) || is_null($a)){
            return "";
        }else{
            return $a->name;
        }
    }

    public static function typeAhead($request){
        return static::select(static::raw('CONCAT(name, " - ", iata) AS name'))
            ->where("name","LIKE","%{$request->input('query')}%")
            ->orWhere("iata","LIKE","%{$request->input('query')}%")
            ->get();
    }
}
