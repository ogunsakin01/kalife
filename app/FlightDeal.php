<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightDeal extends Model
{

    public static function store($data){
        $table = new static();
        $table->package_id = $data->package_id;
        $table->origin = $data->origin;
        $table->destination = $data->destination;
        $table->date = $data->date;
        $table->airline = $data->airline;
        $table->cabin = $data->cabin;
        $table->information = $data->information;
        $table->save();
         return $table;
    }

}
