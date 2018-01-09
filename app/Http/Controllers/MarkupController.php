<?php

namespace App\Http\Controllers;

use App\MarkupType;
use Illuminate\Http\Request;

class MarkupController extends Controller
{
  public function markupView()
  {
    $markups = new MarkupType();

    $markup_types = $markups->fetchTypes();

    return view('backend.additions.markup', compact('markup_types'));
  }
}
