<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
  public function fetchRoles()
  {
    return static::pluck('name', 'id')->all();
  }

  public function fetchRolesExceptAdmin()
  {
    return static::where('id', '!=', '3')->pluck('name', 'id');
  }
}
