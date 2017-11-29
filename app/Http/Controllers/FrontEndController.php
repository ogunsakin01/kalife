<?php

namespace App\Http\Controllers;

use App\Email;
//use App\Message;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;

class FrontEndController extends Controller
{
    public function __construct(){

    }
    public function subscribe(Request $r){
        $this->validate($r, [
            'email' => 'required|string'
        ]);
        $email = $r->email;
       if(Email::getEmail($email)){
           return 2;
       }else{
           $store = Email::store($email);
               return 1;
       }
    }

    public function message(Request $r){
        $this->validate($r, [
            'email' => 'required|string',
            'name'  =>  'required|string',
            'message' => 'required|string'
        ]);
        if(\App\Message::getMessage($r)){
           return 2;
        }else{
            \App\Message::store($r);
            return 1;
        }

    }
}
