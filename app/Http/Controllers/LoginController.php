<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

class LoginController extends Controller
{
  public function index()
  {
    $user = new User();

    return $user->checkLogin();
  }

  public function authenticate(Request $r)
  {
    $user = new User();

    $this->validate($r, [
       'email' => 'required',
       'password' => 'required'
    ]);


    return $user->authenticateUser($r->all());
  }
}
