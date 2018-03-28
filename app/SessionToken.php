<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionToken extends Model
{
    public static function store($data){
        $session_info = new static();
        $session_info->message_id = $data['message_id'];
        $session_info->token = $data['token'];
        $session_info->conv_id = $data['conv_id'];
        $session_info->save();
    }

    public static function getToken(){
        $a = static::where('available_status', 1)
            ->first();
        if(empty($a) || is_null($a)){
            return '';
        }else{
            return $a;
        }
    }

    public static function getTokenWithId($message_id){
        $a = static::where('message_id', $message_id)->first();
        return $a->token;
    }

    public static function tokenUsed($message_id){
     $token_row = static::where('message_id', $message_id)->first();
     $token_row->available_status = 0;
     $token_row->update();
    }

    public static function tokenClosed($message_id){
        $token_row = static::where('message_id', $message_id)->first();
        $token_row->closed_status = 1;
        $token_row->update();
    }
}
