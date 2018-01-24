<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelPackage extends Model
{
    public static function store($data){
        $table = new static();
        $table->category_id  = $data['default']->category;
        $table->name         = $data['default']->name;
        $table->flight       = $data['flight'];
        $table->hotel        = $data['hotel'];
        $table->attraction   = $data['attraction'];
        $table->phone_number = $data['default']->contact_number;
        $table->information  = $data['default']->information;
        $table->adult_price  = $data['default']->adult_price;
        $table->child_price  = $data['default']->child_price;
        $table->infant_price = $data['default']->infant_price;
        $table->status = 0;
        $table->save();
    }

}
