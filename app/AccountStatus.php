<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountStatus extends Model
{
  public function fetchStatus()
  {
    return static::pluck('name', 'id')->all();
  }
}
