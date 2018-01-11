<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
  /*use SendsPasswordResetEmails, ResetsPasswords;*/

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

  public function changePassword(Request $r)
  {
    $user = new User();

    $this->validate($r, [
       'old_password' => 'required',
       'new_password' => 'required|same:confirm_password',
       'confirm_password' => 'required'
    ]);


    if ($user->checkPassword($r->all()))
    {
      if ($user->changePassword($r->all()))
      {
        /*
         * Password changed
         * */
        $response = 1;

        return response()->json($response);
      }
      else
      {
        /*
         * Could not change password
         * */
        $response = 0;

        return response()->json($response);
      }
    }
    else
    {
      /*
       * Password Incorrect
       * */

      $response = 2;

      return response()->json($response);
    }
    return $r;
  }
}
