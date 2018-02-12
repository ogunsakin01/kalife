<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    protected $fillable = [
        'gateway_id',
        'amount',
        'payment_status',
        'txn_reference',
        'user_id'
    ];

    public static function store($data){
     return static::updateOrCreate(
            [
                'txn_reference' => $data['txn_reference'],
                'user_id' => $data['user_id']
            ],

            ['amount' => $data['amount'],
             'gateway_id' => $data['gateway_id'],
             'payment_status' => 0
            ]
        );

    }

    public static function updateTransaction($data){
        $transaction = static::where('txn_reference', $data['reference'])->first();
        $transaction->response_code = $data['responseCode'];
        $transaction->response_description = $data['responseDescription'];
        $transaction->payment_status = $data['status'];
        $transaction->response_full = $data['responseFull'];
        $transaction->update();
    }

    public static function getTransaction($reference){
        return static::where('txn_reference', $reference)->first();
    }

    public static function getAllInterswitchTransactions(){
        return static::where('gateway_id', 1)
            ->orderBy('id','desc')
            ->get();
    }



    public static function getAllInterswitchTransactionsById($id){
        return static::where('gateway_id', 1)
            ->where('user_id', $id)
            ->orderBy('id','desc')
            ->get();
    }

    public static function getAllPayStackTransactions(){
        return static::where('gateway_id', 2)
            ->orderBy('id','desc')
            ->get();
    }



    public static function getAllPayStackTransactionsById($id){
        return static::where('gateway_id', 2)
            ->where('user_id',$id)
            ->orderBy('id','desc')
            ->get();
    }

    public static function getAllTransactionByUserId($id){
        return static::where('user_id',$id)
            ->orderBy('id','desc')
            ->get();
    }
}
