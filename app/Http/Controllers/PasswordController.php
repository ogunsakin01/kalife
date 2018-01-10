<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
  use SendsPasswordResetEmails, ResetsPasswords;

  public function showLinkRequestForm()
  {
    return view('backend.auth.passwords.email');
  }

  public function sendPasswordResetLink(Request $r)
  {
    $user = new User();

    $this->validate($r, [
       'email' => 'required|email'
    ]);

    return $user->checkPasswordResetEmail($r->all());
  }
}
