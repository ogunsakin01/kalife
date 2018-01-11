<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankDetail;
use App\Wallet;
use App\WalletLog;
use Illuminate\Http\Request;

class WalletController extends Controller
{
  public function walletView()
  {
    $wallet = new Wallet();

    $wallet_log = new WalletLog();

    $bank = new Bank();

    $bank_detail = new BankDetail();

    $balance = $wallet->authenticatedUserWalletBalance();

    $logs = $wallet_log->fetchAuthenticatedUserWalletLog();

    $banks = $bank->fetchBanks();

    $bank_details = $bank_detail->fetchBankDetails();

    return view('backend.wallet.wallet', compact('balance', 'logs', 'banks', 'bank_details'));
  }

  public function getBankDetail($id)
  {
    $bank_detail = new BankDetail();

    $response = $bank_detail->getBankDetails($id);

    return response()->json($response);
  }
}
