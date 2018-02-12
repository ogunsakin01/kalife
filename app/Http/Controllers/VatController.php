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

    $vat = Vat::find(1);

    return view('backend.additions.vat', compact('vat_types', 'vat_value_types','vat'));
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

  public function getVat($type){
      $vat = Vat::find(1);
      $value_type = 0;
      $value = 0;
      if($type == 'flight'){
          $type       = 1;
         $value_type = $vat->flight_vat_type;
         $value      = $vat->flight_vat_value;
      }elseif($type == 'hotel'){
          $type       = 2;
          $value_type = $vat->hotel_vat_type;
          $value      = $vat->hotel_vat_value;
      }elseif($type == 'car'){
          $type       = 3;
          $value_type = $vat->car_vat_type;
          $value      = $vat->car_vat_value;
      }
      elseif($type == 'package'){
          $type       = 4;
          $value_type = $vat->package_vat_type;
          $value      = $vat->package_vat_value;
      }
      return [
          'type' => $type,
          'value_type' => $value_type,
          'value' => $value
         ];

  }

}
