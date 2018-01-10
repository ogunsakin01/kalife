<?php

namespace App\Http\Controllers;

use App\Vat;
use Illuminate\Http\Request;
use App\MarkupType;
use App\MarkupValueType;

class VatController extends Controller
{
  public function vatView()
  {
    $markups = new MarkupType();

    $valueTypes = new MarkupValueType();

    $vat_types = $markups->fetchTypes();

    $vat_value_types = $valueTypes->fetchTypes();

    return view('backend.additions.vat', compact('vat_types', 'vat_value_types'));
  }

  public function saveVat(Request $r)
  {
    $vat = new Vat();

    $this->validate($r, [
        'vat_type' => 'required',
        'vat_value_type' => 'required',
        'vat_value' =>'required|numeric'
    ]);

    if ($vat->updateOrCreateVat($r->all()))
    {
      $response = 1;
      return response()->json($response);
    }

    $response = 0;
    return response()->json($response);
  }
}
