<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    public static function store($data){
        $table = new static();
        $table->package_id  = $data->package_id;
        $table->name        = $data->name;
        $table->city        = $data->city;
        $table->address     = $data->address;
        $table->date        = $data->date;
        $table->information = $data->information;
        $table->save();
        return $table;
    }

    public static function getByPackageId($id){

        return static::where('package_id', $id)->first();

    }

}
