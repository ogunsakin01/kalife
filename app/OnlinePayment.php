<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    public static function store($data){
        $new_payment = new static();
        $new_payment->user_id = $data['user_id'];
        $new_payment->txn_reference = $data['txn_reference'];
        $new_payment->amount = $data['amount'];
        $new_payment->gateway_id = $data['gateway_id'];
        $new_payment->save();
    }

    public static function updateTable($data){
        $transaction = static::where('txn_reference', $data['txn_reference'])->first();
        $transaction->response_code = $data['response_code'];
        $transaction->response_description = $data['response_description'];
        $transaction->payment_status = $data['payment_status'];
        $transaction->response_full = $data['response_full'];
        $transaction->update();
    }
}
