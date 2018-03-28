<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankPayment extends Model
{
    protected $fillable = [
        'reference',
        'user_id',
        'amount',
        'bank_detail_id',
        'slip_photo',
        'status'
    ];
    public static function storeOrUpdate($data){
          $bankPayment = static::updateOrCreate(
          [
          'reference' => $data->reference
          ],
          [
             'user_id'        => $data->user_id,
             'amount'         => $data->amount,
             'bank_detail_id' => $data->bank_detail_id,
             'slip_photo'     => $data->slip_photo,
             'status'         => $data->status
          ]);
          return $bankPayment;
    }

    public static function getAllBankPayment(){
        return static::orderBy('id','desc')->get();
    }

    public static function updateBankPayment($reference,$type){
        $bankPayment = static::where('reference',$reference)->first();
        $bankPayment->status = $type;
        $bankPayment->update();
        return $bankPayment;
    }

    public static function getAllAuthenticatedUserBankPayments(){
        return static::where('user_id',auth()->user()->id)
            ->orderBy('id','desc')
            ->get();
    }

}
