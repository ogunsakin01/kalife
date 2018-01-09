<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
  public function fetchTypes()
  {
    return static::pluck('type', 'id')->all();
  }
}
