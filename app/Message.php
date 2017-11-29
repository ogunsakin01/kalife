<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public static function getMessage($r){
        $a = static::where('message', $r->message)->first();
        if(is_null($a) || empty($a)){
            return false;
        }
        else{
            return true;
        }
    }
    public static function store($r){
        $message = new static();
        $message->email = $r->email;
        $message->name = $r->name;
        $message->message = $r->message;
        $message->visitor = $_SERVER['REMOTE_ADDR'];
        $message->status = 1;
        $message->save();
    }
}
