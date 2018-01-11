<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
  public function fetchBanks()
  {
    return static::pluck('bank_name', 'id')->all();
  }


}
