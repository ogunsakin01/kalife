<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Markdown extends Model
{
    public static function getAirlineMarkdown($airline_code){
        $a = static::where('airline_code', $airline_code)->first();
        if(empty($a) || is_null($a)){
            return 0;
        }else{
            return $a;
        }
    }
}
