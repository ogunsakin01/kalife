<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{

  public function authenticatedUserWalletBalance()
  {
    $wallet = static::where('user_id', auth()->id())->first();
//     dd($wallet);
    if (empty($wallet))
    {
      $this->createWallet(auth()->id());
    }
    return $wallet->balance;
  }

  public function createWallet($user_id)
  {
    $wallet = static::where('user_id', $user_id)->first();

    if(empty($wallet))
    {
      $wallet = new static();

      $wallet->user_id = $user_id;

      $wallet->balance = 0;

      return $wallet->save();
    }

    $wallet->user_id = $user_id;

    return $wallet->update();



  }

  public static function updateWalletBalance($user_id, $amount, $creditORdebit){

      $getWalletBalance = static::where('user_id',$user_id)->first();

      $balance = $getWalletBalance->balance;

      if($creditORdebit == 'credit'){
          $newBalance = $balance + $amount;
          WalletLog::createLog($user_id,$amount,1);
      }elseif($creditORdebit == 'debit'){
          $newBalance = $balance - $amount;
          WalletLog::createLog($user_id,$amount,0);
      }

      $getWalletBalance->balance = $newBalance;
      $getWalletBalance->update();


  }


}
