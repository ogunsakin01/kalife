<?php

namespace App\Http\Controllers;

use App\BankPayment;
use App\FlightBooking;
use App\Gallery;
use App\Mail\FailedPayment;
use App\Mail\PaymentPreNotification;
use App\Mail\SuccessfulFlightBooking;
use App\Mail\SuccessfulPackageBooking;
use App\Mail\SuccessfulPayment;
use App\OnlinePayment;
use App\Package;
use App\PackageBooking;
use App\Services\InterswitchConfig;
use App\Services\PaystackConfig;
use App\Services\SabreFlight;
use App\Services\SabreSessionManager;
use App\TravelPackage;
use App\User;
use App\Wallet;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Exception;

class FrontEndPaymentController extends Controller
{
    public function __construct(){
        $this->SabreFlight = new SabreFlight();
        $this->SessionManager = new SabreSessionManager();
        $this->InterswitchConfig = new InterswitchConfig();
        $this->PaystackConfig = new PaystackConfig();
    }

    public function flightPaymentConfirmationPaystack(){
        if(isset($_GET['reference'])){
            $txnRef = $_GET['reference'];
            $transactionInfo = OnlinePayment::getTransaction($txnRef);
            if(empty($transactionInfo) || is_null($transactionInfo)){
                $transactionStatus = [
                    'email' => '0',
                    'reference' => $txnRef,
                    'status' => 0,
                    'responseCode' => 00,
                    'responseDescription' => "Transaction with this transaction reference is not found in out database",
                    'responseFull' => '0',
                    'amount' => 0
                ];
            }
            else{
                $userInfo = User::getUserById($transactionInfo->user_id);
                $transactionStatus = $this->PaystackConfig->query($txnRef);
                $transactionStatus['email'] = $userInfo->email;
                OnlinePayment::updateTransaction($transactionStatus);
                FlightBooking::updatePaymentStatus($transactionStatus);
                $bookingInfo = FlightBooking::getBooking($txnRef);
                if($transactionStatus['status'] == 1){
                    try{
                        Mail::to($userInfo)->send(new SuccessfulPayment($userInfo,$transactionStatus));
                    }
                    catch(Exception $e){
                        Toastr::info('Your payment was successful but we are unable to send you a payment success email');
                    }
                    try{
                        Mail::to($userInfo)->send(new SuccessfulFlightBooking($userInfo,$transactionStatus,$bookingInfo));
                    }
                    catch(Exception $e){
                        Toastr::info('Could not sen email containing booking information, visit your booking page for more info');
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
                'email' => '0',
                'reference' => 0,
                'status' => 0,
                'responseCode' => 00,
                'responseDescription' => "Transaction reference can not be empty",
                'responseFull' => '0',
                'amount' => '0'
            ];
        }

        session()->put('transactionStatus',$transactionStatus);
        return redirect(url('/flight-booking-complete'));
    }

    public function flightPaymentConfirmationInterswitch(){
        if(isset($_POST['txnref'])){
               $txnRef = $_POST['txnref'];
              $transactionInfo = OnlinePayment::getTransaction($txnRef);
              if(empty($transactionInfo) || is_null($transactionInfo)){
                  $transactionStatus = [
                      'email' => '0',
                      'reference' => $txnRef,
                      'status' => 0,
                      'responseCode' => 00,
                      'responseDescription' => "Transaction with this transaction reference is not found in out database",
                      'responseFull' => '0'
                  ];
              }else{
                  $userInfo = User::getUserById($transactionInfo->user_id);
                  $transactionStatus = $this->InterswitchConfig->requery($txnRef,$transactionInfo->amount);
                  $transactionStatus['email'] = $userInfo->email;
                  OnlinePayment::updateTransaction($transactionStatus);
                  FlightBooking::updatePaymentStatus($transactionStatus);
                  $bookingInfo = FlightBooking::getBooking($txnRef);
                  if($transactionStatus['status'] == 1){
                      try{
                          Mail::to($userInfo)->send(new SuccessfulPayment($userInfo,$transactionStatus));
                      }
                      catch(Exception $e){
                          Toastr::info('Your payment was successful but we are unable to send you a payment success email');
                      }
                      try{
                          Mail::to($userInfo)->send(new SuccessfulFlightBooking($userInfo,$transactionStatus,$bookingInfo));
                      }
                      catch(Exception $e){
                          Toastr::info('Could not sen email containing booking information, visit your booking page for more info');
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
                   'email' => '0',
                   'reference' => 0,
                   'status' => 0,
                   'responseCode' => 00,
                   'responseDescription' => "Transaction reference can not be empty",
                   'responseFull' => '0'
               ];
           }
        session()->put('transactionStatus',$transactionStatus);
        return redirect(url('/flight-booking-complete'));
    }

    public function hotelPaymentConfirmationPaystack(){
        if(isset($_GET['reference'])){
            $txnRef = $_GET['reference'];
            $transactionInfo = OnlinePayment::getTransaction($txnRef);
            if(empty($transactionInfo) || is_null($transactionInfo)){

            }else{

            }
        }else{

        }
    }

    public function hotelPaymentConfirmationInterswitch(){
        if(isset($_POST['txnref'])){
            $txnRef = $_POST['txnref'];
            $transactionInfo = OnlinePayment::getTransaction($txnRef);
            if(empty($transactionInfo) || is_null($transactionInfo)){

            }else{

            }
        }else{

        }
    }

    public function packagePaymentConfirmationPaystack(){
        if(isset($_GET['reference'])){
            $txnRef = $_GET['reference'];
            $transactionInfo = OnlinePayment::getTransaction($txnRef);
            if(empty($transactionInfo) || is_null($transactionInfo)){
                $transactionStatus = [
                    'email' => '0',
                    'reference' => $txnRef,
                    'status' => 0,
                    'responseCode' => 00,
                    'responseDescription' => "Transaction with this transaction reference is not found in out database",
                    'responseFull' => '0',
                    'amount' => $transactionInfo->amount
                ];
            }else{
                $userInfo = User::getUserById($transactionInfo->user_id);
                $transactionStatus = $this->PaystackConfig->query($txnRef);
                $transactionStatus['email'] = $userInfo->email;
                OnlinePayment::updateTransaction($transactionStatus);
                PackageBooking::updatePaymentStatus($transactionStatus);
                $bookingInfo = PackageBooking::getBookingByReference($txnRef);
                $packageInfo = TravelPackage::find($bookingInfo->package_id);
                if($transactionStatus['status'] == 1){
                    try{
                        Mail::to($userInfo)->send(new SuccessfulPayment($userInfo,$transactionStatus));
                    }
                    catch(Exception $e){
                        Toastr::info('Unable to send email','Email Failed');
                    }
                    try{
                        Mail::to($userInfo)->send(new SuccessfulPackageBooking($userInfo, $transactionStatus, $bookingInfo, $packageInfo));
                    }
                    catch(Exception $e){
                        Toastr::info('Unable to send email','Email Failed');
                    }

                }elseif($transactionStatus['status'] == 0){
                    try{
                        Mail::to($userInfo)->send(new FailedPayment($userInfo,$transactionStatus));
                    }
                    catch(Exception $e){
                        Toastr::info('Unable to send email','Email Failed');
                    }
                }

            }
        }
        else{
            $transactionStatus = [
                'email' => '0',
                'reference' => 0,
                'status' => 0,
                'responseCode' => 00,
                'responseDescription' => "Transaction reference can not be empty",
                'responseFull' => '0',
                'amount' => '0'
            ];
        }

        session()->put('transactionStatus',$transactionStatus);
        return redirect(url('/package-booking-complete'));
    }

    public function packagePaymentConfirmationInterswitch(){
        if(isset($_POST['txnref'])){
            $txnRef = $_POST['txnref'];
            $transactionInfo = OnlinePayment::getTransaction($txnRef);
            if(empty($transactionInfo) || is_null($transactionInfo)){
                $transactionStatus = [
                    'email' => '0',
                    'reference' => $txnRef,
                    'status' => 0,
                    'responseCode' => 00,
                    'responseDescription' => "Transaction with this transaction reference is not found in out database",
                    'responseFull' => '0'
                ];
            }else{
                $userInfo = User::getUserById($transactionInfo->user_id);
                $transactionStatus = $this->InterswitchConfig->requery($txnRef,$transactionInfo->amount);
                $transactionStatus['email'] = $userInfo->email;
                OnlinePayment::updateTransaction($transactionStatus);
                PackageBooking::updatePaymentStatus($transactionStatus);
                $bookingInfo = PackageBooking::getBookingByReference($txnRef);
                $packageInfo = TravelPackage::find($bookingInfo->package_id);
                if($transactionStatus['status'] == 1){
                    try{
                        Mail::to($userInfo)->send(new SuccessfulPayment($userInfo,$transactionStatus));
                    }
                    catch(Exception $e){
                        Toastr::info('Unable to send email','Email Failed');
                    }
                    try{
                        Mail::to($userInfo)->send(new SuccessfulPackageBooking($userInfo, $transactionStatus, $bookingInfo, $packageInfo));
                    }
                    catch(Exception $e){
                        Toastr::info('Unable to send email','Email Failed');
                    }


                }elseif($transactionStatus['status'] == 0){
                    try{
                        Mail::to($userInfo)->send(new FailedPayment($userInfo,$transactionStatus));
                    }
                    catch(Exception $e){
                        Toastr::info('Unable to send email','Email Failed');
                    }
                }
            }
        }
        else{
            $transactionStatus = [
                'email' => '0',
                'reference' => 0,
                'status' => 0,
                'responseCode' => 00,
                'responseDescription' => "Transaction reference can not be empty",
                'responseFull' => '0'
            ];
        }
        session()->put('transactionStatus',$transactionStatus);
        return redirect(url('/package-booking-complete'));
    }

    public function initiatePaystack(Request $r){
        return $this->PaystackConfig->initialize($r->email,$r->amount,$r->reference,$r->site_redirect_url);
    }

    public function saveTransaction(Request $r){
        $userInfo = User::getUserById($r->user_id);
        Mail::to($userInfo)->send(new PaymentPreNotification($userInfo,$r->amount,$r->txn_reference));
        return OnlinePayment::store($r);
    }

    public function bookingComplete(){
        $Itinerary = session()->get('selectedItinerary');
        $transactionStatus = session()->get('transactionStatus');
        return view("frontend.flights.success_payment", compact('transactionStatus','Itinerary'));
    }

    public function packageBookingComplete(){
        $transactionStatus = session()->get('transactionStatus');
        $bookingInfo = '';
        $packageInfo = '';
        $images = '';
        if($transactionStatus['reference'] !== 0){
           $bookingInfo = PackageBooking::getBookingByReference($transactionStatus['reference']);
           $packageInfo = TravelPackage::find($bookingInfo->package_id);
           $images = Gallery::getGalleryByPackageId($bookingInfo->package_id);
        }
        return view("frontend.packages.success_payment", compact('transactionStatus','bookingInfo','packageInfo','images'));
    }

    public function hotelBookingComplete(){

    }

    public function interswitchRequery(Request $r){
       $transactionInfo = OnlinePayment::getTransaction($r->reference);

       $requery = $this->InterswitchConfig->requery($r->reference,$transactionInfo->amount);
           $userInfo = User::getUserById($transactionInfo->user_id);
           $requery['email'] = $userInfo->email;
           if($requery['responseCode'] !== '--'){
               OnlinePayment::updateTransaction($requery);
               if($requery['status'] == 1){
                   try{
                       Mail::to($userInfo)->send(new SuccessfulPayment($userInfo,$requery));
                   }
                   catch(Exception $e){
                       Toastr::success('Payment confirmed. Could not send you a confirmation email');
                   }
                   if(substr($r->reference, 0 , 3) == "PKG"){
                       $bookingInfo = PackageBooking::getBookingByReference($r->reference);
                       $packageInfo = TravelPackage::find($bookingInfo->package_id);
                       PackageBooking::updatePaymentStatus($requery);
                       try{
                           Mail::to($userInfo)->send(new SuccessfulPackageBooking($userInfo, $requery, $bookingInfo, $packageInfo));
                       }
                       catch(Exception $e){
                           Toastr::success('Travel package booking successful,could not send email containing booking information');
                       }
                   }elseif(substr($r->reference, 0 , 3) == "AIR"){
                       $bookingInfo = FlightBooking::getBooking($r->reference);
                       FlightBooking::updatePaymentStatus($requery);

                       try{
                           Mail::to($userInfo)->send(new SuccessfulFlightBooking($userInfo,$requery,$bookingInfo));
                       }
                       catch(Exception $e){
                           Toastr::success('Flight booking successful, could not send email containing booking information');
                       }

                   }elseif(substr($r->reference, 0 , 3) == "HOT"){

                   }elseif(substr($r->reference, 0 , 3) == "WDR"){
                       Wallet::updateWalletBalance(auth()->user()->id,$requery['amount'],'credit');
                   }
               }
           }
        return $requery;
    }

    public function bankPayment(Request $r){
        if(substr($r->reference,0,3) == 'AIR'){
            $booking = FlightBooking::getBooking($r->reference);
        }elseif(substr($r->reference,0,3) == 'PKG'){
            $booking = PackageBooking::getBookingByReference($r->reference);
        }
        $amount = $booking->total_amount;
        $rawData = [
          'reference' => $r->reference,
          'user_id'   => auth()->user()->id,
          'amount'    => $amount,
          'bank_detail_id' =>$r->selected_bank,
          'slip_photo'      => '',
          'status'          => 2
        ];
        $data = (object) $rawData;
        BankPayment::storeOrUpdate($data);
        if(auth()->user()->hasRole('Customer')){
            return redirect(url('/bank-payments'));
        }
       return redirect(url('/backend/login'));
    }



}
