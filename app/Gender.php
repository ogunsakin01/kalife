<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
  public function fetchTypes()
  {
    return static::pluck('type', 'id')->all();
  }

  public function getGenderById($gender_id)
  {
    return static::where('id', $gender_id)->first()->type;
  }
}
