<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function emailSubscribers(){
        $emails = Email::orderBy('id','desc')->get();
        return view('backend.subscribers.emails',compact('emails'));
    }

    public function activate(Request $r){
        $subscriber = Email::find($r->id);
        if($subscriber->status == 1){
            return 2;
        }
        $subscriber->status = 1;
        $subscriber->update();
        return 1;
    }

    public function deActivate(Request $r){
        $subscriber = Email::find($r->id);
        if($subscriber->status == 0){
            return 2;
        }
        $subscriber->status = 0;
        $subscriber->update();
        return 1;
    }

}
