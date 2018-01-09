<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
  public function fetchTitles()
  {
    return static::pluck('name', 'id')->all();
  }
}
