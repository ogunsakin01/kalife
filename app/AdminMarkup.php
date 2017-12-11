<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMarkup extends Model
{
    public static function getAdminUserMarkup(){
        return static::where('role_id', 3)->first();
    }
}
