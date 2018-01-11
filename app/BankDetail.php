<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
  public function fetchBankDetails()
  {
    return static::pluck('account_number', 'id')->all();
  }

  public function bank()
  {
    return $this->belongsTo(Bank::class, 'bank_id');
  }

  public function getBankDetails($id)
  {
    $detail = static::where('id', $id)->first();

      $data = [
          'account_name' => $detail->account_name,
          'bank_name' => $detail->bank->bank_name
      ];

    return $data;
  }
}
