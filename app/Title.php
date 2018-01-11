<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
  public function fetchTitles()
  {
    return static::pluck('name', 'id')->all();
  }

  public function getTitleById($title_id)
  {
    return static::where('id', $title_id)->first()->name;
  }
}
