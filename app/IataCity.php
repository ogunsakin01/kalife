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
        return static::select(static::raw('CONCAT(iata, " - ", name) AS name'))
            ->where("iata","LIKE","%{$request->input('query')}%")
            ->orWhere("name","LIKE","%{$request->input('query')}%")
            ->get();
    }
}
