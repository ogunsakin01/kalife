<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
  public function walletView()
  {
    return view('backend.wallet.wallet');
  }
}
