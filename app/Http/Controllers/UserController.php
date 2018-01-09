<?php

namespace App\Http\Controllers;
use App\Title;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {
    $title = new Title();

    $titles = $title->fetchTitles();

    return view('backend.users.new', compact('titles'));
  }
}
