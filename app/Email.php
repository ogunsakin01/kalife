<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';

    public static function getEmail($email)
    {
        $a = static::where('email', $email)->first();
        if(is_null($a) || empty($a)){
            return false;
        }
        else{
            return true;
        }
    }

    public static function store($emailToStore){
   $email = new static();
   $email->email = $emailToStore;
   $email->visitor = $_SERVER['REMOTE_ADDR'];
   $email->status = 1;
   $email->save();
    }

}
