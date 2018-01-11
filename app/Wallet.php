<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
  public function authenticatedUserWalletBalance()
  {
    $wallet = static::where('user_id', auth()->id())->first();

    if (empty($wallet))
    {
      $this->createWallet(auth()->id());
    }

    return number_format($wallet->balance);
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
}
