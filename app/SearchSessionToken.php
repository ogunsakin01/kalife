<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchSessionToken extends Model
{

    public static function store($data){
        $session_info = new static();
        $session_info->message_id = $data['message_id'];
        $session_info->token = $data['token'];
        $session_info->conv_id = $data['conv_id'];
        $save = $session_info->save();
        return $save;
    }

}
