<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightDeal extends Model
{

    public static function store($data){
        $table = new static();
        $table->package_id = '';
        $table->origin = '';
        $table->destination = '';
        $table->date = '';
        $table->airline = '';
        $table->cabin = '';
        $table->information = '';
        $table->save();

    }

}
