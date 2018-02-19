<?php
/**
 *To do on wallet controller,
 *1-Confirming users hotel booking bank payment
 *2-Confirming users car booking bank payment
 * @function approveBankPayment
 */



namespace App\Http\Controllers;

use App\Bank;
use App\BankDetail;
use App\BankPayment;
use App\FlightBooking;
use App\Mail\SuccessfulFlightBooking;
use App\Mail\SuccessfulPackageBooking;
use App\Mail\WalletUpdate;
use App\OnlinePayment;
use App\PackageBooking;
use App\Services\InterswitchConfig;
use App\Services\PaystackConfig;
use App\Services\SabreConfig;
use App\TravelPackage;
use App\Wallet;
use App\WalletDeposit;
use App\WalletLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use App\Mail\FailedPayment;
use App\Mail\SuccessfulPayment;
use App\User;

class WalletController extends Controller
{
    public function  __construct(){
       $this->SabreConfig = new SabreConfig();
       $this->InterswitchConfig = new InterswitchConfig();
       $this->PaystackConfig = new PaystackConfig();
    }

    public function walletView()
   {
    $wallet = new Wallet();

    $wallet_log = new WalletLog();

    $bank = new Bank();

    $bank_detail = new BankDetail();

    $balance = $wallet->authenticatedUserWalletBalance();

//  $logs = $wallet_log->fetchAuthenticatedUserWalletLog();

    $logs = WalletLog::getLogsOfAuthenticatedUser();

    $banks = $bank->fetchBanks();

    $log_total_debit = 0;

    $log_total_credit  = 0;

    foreach($logs as $i => $log){
        if($log->transaction_type == 1){
            $log_total_credit = $log_total_credit + $log->amount;
        }elseif($log->transaction_type == 0){
            $log_total_debit = $log_total_debit + $log->amount;
        }
    }


    $bank_details = $bank_detail->fetchBankDetails();

    $wallet_deposits = WalletDeposit::getDepositsByUserId(auth()->user()->id);

    $online_payments = OnlinePayment::getAllTransactionByUserId(auth()->user()->id);



    return view('backend.wallet.wallet', compact('balance', 'logs', 'banks', 'bank_details', 'online_payments','wallet_deposits','log_total_credit','log_total_debit'));
  }

    public function getBankDetail($id)
  {
    $bank_detail = new BankDetail();

    $response = $bank_detail->getBankDetails($id);

    return response()->json($response);
  }

    public function saveWalletDeposit(Request $r)
  {
      $reference = $this->SabreConfig->bookingReference('wallet-deposit');

      $r->reference = $reference;

      $image = $r->file('slip_photo');

      if(is_null($image)){
          $r->slip_photo = "";
      }else{
          $imageName = time().$image->getClientOriginalName();
          $image_path = 'images/gallery/bank_payments/'.$imageName;
          $image->move(public_path('images/gallery/bank_payments'),$imageName);
          $r->slip_photo = $image_path;
      }
          $r->status = 2;
         WalletDeposit::storeOrUpdate($r);
      \Brian2694\Toastr\Facades\Toastr::success('Your wallet deposit request uploaded. Kindly wait for approval from the admin');
         return redirect(url('backend/wallet'));
  }

    public function updatePaymentProof(Request $r){
      $deposit = WalletDeposit::find($r->deposit_id);
      $image = $r->file('slip_photo');
      $imageName = time().$image->getClientOriginalName();
      $image_path = 'images/gallery/bank_payments/'.$imageName;
      $image->move(public_path('images/gallery/bank_payments'),$imageName);
      $deposit->slip_photo = $image_path;
      $deposit->update();
      \Brian2694\Toastr\Facades\Toastr::success('Payment Proof updated successfully');
      return redirect(session()->previousUrl());

  }

    public function onlineTransactions(){
    $interswitchTransactions =  OnlinePayment::getAllInterswitchTransactions();
    $paystackTransactions    =  OnlinePayment::getAllPayStackTransactions();
      return view('backend.wallet.online_transactions', compact('interswitchTransactions','paystackTransactions'));
  }

    public function saveOrUpdateBankDetails(Request $r){
      $this->validate($r, [
          'account_number' => 'required|numeric|digits:10'
      ]);
      return BankDetail::storeOrUpdate($r);
  }

    public function activateBankDetails(Request $r){
      return BankDetail::activateBankDetails($r->id);
  }

    public function deActivateBankDetails(Request $r){
      return BankDetail::deActivateBankDetails($r->id);
  }

    public function buildInterswitchTransaction(Request $r){
        $this->validate($r, [
            'amount' => 'required|numeric|min:3'
        ]);

        $reference = $this->SabreConfig->bookingReference('wallet-deposit');

        $kobo_amount = $r->amount * 100;

        $hash = $this->InterswitchConfig->transactionHash($reference,$kobo_amount,url('backend/wallet/payment-confirmation'));

        return [
          'reference'  => $reference,
          'hash'       => $hash,
          'mac_key'    => $this->InterswitchConfig->mac_key,
          'product_id' => $this->InterswitchConfig->product_id,
          'item_id'    => $this->InterswitchConfig->item_id,
          'amount'     => $kobo_amount,
          'redirect_url' => url('backend/wallet/payment-confirmation'),
          'fancy_amount' => number_format(($kobo_amount / 100),2)
        ];
  }

    public function initiatePaystackTransaction(Request $r){
        $email = auth()->user()->email;
        $kobo_amount = $r->amount * 100;
        $reference  = $this->SabreConfig->bookingReference('wallet-deposit');
        $redirect_url = url('backend/wallet/payment-confirmation');
       return $this->PaystackConfig->initialize($email,$kobo_amount,$reference,$redirect_url);
  }

    public function interswitchPaymentConfirmation(){
        if(isset($_POST['txnref'])){
            $txnRef = $_POST['txnref'];
            $transactionInfo = OnlinePayment::getTransaction($txnRef);
            if(empty($transactionInfo) || is_null($transactionInfo)){
                $transactionStatus = [
                    'email' => 0,
                    'reference' => $txnRef,
                    'status' => 0,
                    'responseCode' => 0,
                    'responseDescription' => "Transaction with this transaction reference is not found in out database",
                    'responseFull' => 0,
                    'amount' => 0
                ];
            }
            else{
                $userInfo = User::getUserById($transactionInfo->user_id);
                $transactionStatus = $this->InterswitchConfig->requery($txnRef,$transactionInfo->amount);
                $transactionStatus['email'] = $userInfo->email;
                OnlinePayment::updateTransaction($transactionStatus);
                Wallet::updateWalletBalance(auth()->user()->id,$transactionStatus['amount'],'credit');
                if($transactionStatus['status'] == 1){
                    try{

                        Mail::to($userInfo)->send(new SuccessfulPayment($userInfo,$transactionStatus));
                    }
                    catch(Exception $e){
                        Toastr::info('Your payment was successful but we are unable to send you a payment success email');
                    }
                    try{
                        Mail::to($userInfo)->send(new WalletUpdate($userInfo,$transactionStatus['amount'],1));
                    }
                    catch(Exception $e){
                        Toastr::info('Could not send you your wallet update email');
                    }
                }elseif($transactionStatus['status'] == 0){
                    try{
                        Mail::to($userInfo)->send(new FailedPayment($userInfo,$transactionStatus));
                    }
                    catch(Exception $e){

                        Toastr::error('Your payment failed and we could not send an email containing the details to you');
                    }
                }

            }
        }
        else{
            $transactionStatus = [
                'email' => 0,
                'reference' => 0,
                'status' => 0,
                'responseCode' => 0,
                'responseDescription' => "Transaction reference can not be empty",
                'responseFull' => 0,
                'amount' => 0
            ];
        }

        session()->put('transactionStatus',$transactionStatus);
        return redirect(url('/backend/wallet/payment-complete'));
    }

    public function paystackPaymentConfirmation(){
        if(isset($_GET['reference'])){
            $txnRef = $_GET['reference'];
            $transactionInfo = OnlinePayment::getTransaction($txnRef);
            if(empty($transactionInfo) || is_null($transactionInfo)){
                $transactionStatus = [
                    'email' => 0,
                    'reference' => $txnRef,
                    'status' => 0,
                    'responseCode' => 0,
                    'responseDescription' => "Transaction with this transaction reference is not found in out database",
                    'responseFull' => 0,
                    'amount' => 0
                ];
            }
            else{
                $userInfo = User::getUserById($transactionInfo->user_id);
                $transactionStatus = $this->PaystackConfig->query($txnRef);
                $transactionStatus['email'] = $userInfo->email;
                OnlinePayment::updateTransaction($transactionStatus);
                Wallet::updateWalletBalance(auth()->user()->id,$transactionStatus['amount'],'credit');
                if($transactionStatus['status'] == 1){
                    try{
                        Mail::to($userInfo)->send(new SuccessfulPayment($userInfo,$transactionStatus));
                    }
                    catch(Exception $e){
                        Toastr::info('Your payment was successful but we are unable to send you a payment success email');
                    }
                    try{
                        Mail::to($userInfo)->send(new WalletUpdate($userInfo,$transactionStatus['amount'],1));
                    }
                    catch(Exception $e){
                        Toastr::info('Could not send you your wallet update email');
                    }
                }elseif($transactionStatus['status'] == 0){
                    try{
                        Mail::to($userInfo)->send(new FailedPayment($userInfo,$transactionStatus));
                    }
                    catch(Exception $e){
                        Toastr::error('Your payment failed and we could not send an email containing the details to you');
                    }
                }

            }
        }
        else{
            $transactionStatus = [
                'email' => 0,
                'reference' => 0,
                'status' => 0,
                'responseCode' => 0,
                'responseDescription' => "Transaction reference can not be empty",
                'responseFull' => 0,
                'amount' => 0
            ];
        }

        session()->put('transactionStatus',$transactionStatus);
        return redirect(url('/backend/wallet/payment-complete'));
    }

    public function onlinePaymentComplete(){
        $transactionStatus = session()->get('transactionStatus');
        return view('backend.wallet.payment_complete',compact('transactionStatus'));
    }

    public function requeryOnlinePayment(Request $r){
        $transaction = OnlinePayment::getTransaction($r->reference);
        if($transaction->gateway_id == 1){
            $requery = $this->InterswitchConfig->requery($r->reference,$transaction->amount);
        }elseif($transaction->gateway_id == 2){
            $requery = $this->PaystackConfig->query($r->reference);
        }
        if($requery['status'] == 1){
            OnlinePayment::updateTransaction($requery);
            Wallet::updateWalletBalance(auth()->user()->id,$requery['amount'],'credit');
            try{
                Mail::to(auth()->user()->id)->send(new SuccessfulPayment(auth()->user()->id,$requery));
            }
            catch(Exception $e){
                Toastr::info('Your payment was successful but we are unable to send you a payment success email');
            }
            try{
                Mail::to(auth()->user()->id)->send(new WalletUpdate(auth()->user()->id,$requery['amount'],1));
            }
            catch(Exception $e){
                Toastr::info('Could not send you your wallet update email');
            }
        }

        return $requery;

    }

    public function allWalletsTransactionLogs(){
        $logs = WalletLog::orderBy('id','desc')->get();
        $total_log_amount     = 0;
        $total_debit_amount   = 0;
        $total_credit_amount  = 0;
        foreach($logs as $log){
            $total_log_amount = $total_log_amount + $log->amount;
            if($log->transaction_type == 0){
                $total_debit_amount = $total_debit_amount + $log->amount;
            }elseif($log->transaction_type == 1){
                $total_credit_amount = $total_credit_amount + $log->amount;
            }
        }

        return view('backend.wallet.all_wallets_transactions',compact('logs','total_log_amount','total_credit_amount','total_debit_amount'));
    }

    public function allBankTransactionLogs(){

         $wallet_deposits = WalletDeposit::getAllDeposit();
         $bank_payments   = BankPayment::getAllBankPayment();
         return view('backend.wallet.bank_transactions', compact('wallet_deposits','bank_payments'));

    }

    public function approveBankPayment(Request $r){
        $update_status = BankPayment::updateBankPayment($r->reference,1);

        $userInfo = User::find($update_status->user_id);
        $transactionStatus = [
            'status' => $update_status->status,
            'reference' => $r->reference
        ];
          $amount = $update_status->amount * 100;
        if(substr($r->reference,0,3) == "WDR"){
            Wallet::updateWalletBalance($update_status->user_id,$amount,'credit');
            try{
                Mail::to($userInfo)->send(new WalletUpdate($userInfo,$amount,1));
            }
            catch(Exception $e){
                Toastr::info('Could not send you your wallet update email');
            }
        }

        elseif(substr($r->reference,0,3) == "AIR"){

            FlightBooking::updatePaymentStatus($transactionStatus);
            $bookingInfo = FlightBooking::getBooking($r->reference);
            try{
                Mail::to($userInfo)->send(new SuccessfulFlightBooking($userInfo,$transactionStatus,$bookingInfo));
            }
            catch(Exception $e){
                Toastr::info('Could not sen email containing booking information, visit your booking page for more info');
            }
        }

        elseif(substr($r->reference,0,3) == "HOT"){

        }

        elseif(substr($r->reference,0,3) == "PKG"){
            PackageBooking::updatePaymentStatus($transactionStatus);
            $bookingInfo = PackageBooking::getBookingByReference($r->reference);
            $packageInfo = TravelPackage::find($bookingInfo->package_id);
            try{
                Mail::to($userInfo)->send(new SuccessfulPackageBooking($userInfo, $transactionStatus, $bookingInfo, $packageInfo));
            }
            catch(Exception $e){
                Toastr::info('Unable to send email','Email Failed');
            }
        }

        elseif(substr($r->reference,0,3) == "CAR"){

        }
        return $update_status;
    }

    public function declineBankPayment(Request $r){
        $update_status = BankPayment::updateBankPayment($r->reference,0);
        return $update_status;
    }

    public function approveWalletDeposit(Request $r){
        $update_status = WalletDeposit::updateWalletDeposit($r->reference,1);
        $creditWallet  = Wallet::updateWalletBalance($update_status->user_id,$update_status->amount,'credit');
        $userInfo = User::find($update_status->user_id);
        try{
            Mail::to($userInfo)->send(new WalletUpdate($userInfo,$update_status->amount,1));
        }
        catch(Exception $e){
            Toastr::info('Could not send you your wallet update email');
        }
       return $update_status;
    }

    public function declineWalletDeposit(Request $r){
        $update_status = WalletDeposit::updateWalletDeposit($r->reference,0);
        return $update_status;

    }

    public function updateBankPaymentProof(Request $r){
        $bank_payment = BankPayment::find($r->bank_payment_id);
        $image = $r->file('slip_photo');
        $imageName = time().$image->getClientOriginalName();
        $image_path = 'images/gallery/bank_payments/'.$imageName;
        $image->move(public_path('images/gallery/bank_payments'),$imageName);
        $bank_payment->slip_photo = $image_path;
        $bank_payment->update();
        \Brian2694\Toastr\Facades\Toastr::success('Payment Proof updated successfully');
        return redirect(session()->previousUrl());
    }

    public function flightPaymentWithWallet(Request $r){

        Wallet::updateWalletBalance(auth()->user()->id,$r->amount,'debit');

        $transactionStatus = [
            'email' => auth()->user()->email,
            'reference' => $r->reference,
            'status' => 1,
            'responseCode' => "00",
            'responseDescription' => 'Payment with wallet was successful, check your bookings for more information',
            'responseFull' => '',
            'amount' => $r->amount
        ];

        FlightBooking::updatePaymentStatus($transactionStatus);
        session()->put('transactionStatus',$transactionStatus);
        return redirect(route('backend-flight-booking-complete'));
    }

}
