<?php

namespace App\Http\Controllers;
use App\AccountStatus;
use App\Gender;
use App\Title;
use App\Role;

use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {

    $title = new Title();

    $titles = $title->fetchTitles();

    $roles = new Role();

    $roles = $roles->fetchRolesExceptAdmin();

    $gender = new Gender();

    $gender = $gender->fetchTypes();

    $status = new AccountStatus();

    $status = $status->fetchStatus();

    return view('backend.users.new', compact('titles', 'roles', 'status', 'gender'));
  }

  public function saveUser(Request $r)
  {
    return $r;
  }
}
