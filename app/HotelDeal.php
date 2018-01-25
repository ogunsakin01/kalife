<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelDeal extends Model
{

    public static function store($data){
        $table = new static();
        $table->package_id      = $data->package_id;
        $table->name            = $data->hotel_name;
        $table->city            = $data->hotel_city;
        $table->address         = $data->hotel_address;
        $table->star_rating     = $data->hotel_rating;
        $table->stay_start_date = $data->start_date;
        $table->stay_duration   = $data->duration;
        $table->stay_end_date   = $data->end_date;
        $table->information     = $data->information;
        $table->save();
        return $table;
    }

    public static function getByPackageId($id){

        return static::where('package_id', $id)->first();

    }

}
