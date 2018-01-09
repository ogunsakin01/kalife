<?php

namespace App\Http\Controllers;

use App\MarkupType;
use App\MarkupValueType;
use App\Role;
use Illuminate\Http\Request;

class MarkupController extends Controller
{
  public function markupView()
  {
    $markups = new MarkupType();

    $valueTypes = new MarkupValueType();

    $roles = new Role();

    $markup_types = $markups->fetchTypes();

    $markup_value_types = $valueTypes->fetchTypes();

    $roles = $roles->fetchRolesExceptAdmin();

    return view('backend.additions.markup', compact('markup_types', 'markup_value_types', 'roles'));
  }

  public function saveAdminMarkup(Request $r)
  {
    $this->validate($r, [
      'role' => 'required',
      ''
    ]);
  }
}
