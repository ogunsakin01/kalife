<?php

namespace App\Http\Controllers;

use App\FlightBooking;
use App\Mail\FailedPayment;
use App\Mail\SuccessfulFlightBooking;
use App\Mail\SuccessfulPayment;
use App\OnlinePayment;
use App\Services\InterswitchConfig;
use App\Services\PaystackConfig;
use App\Services\SabreFlight;
use App\Services\SabreSessionManager;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
                    'amount' => $transactionInfo->amount
                ];
            }else{
                $userInfo = User::getUserById($transactionInfo->user_id);
                $transactionStatus = $this->PaystackConfig->query($txnRef);
                $transactionStatus['email'] = $userInfo->email;
                OnlinePayment::updateTransaction($transactionStatus);
                FlightBooking::updatePaymentStatus($transactionStatus);
                $bookingInfo = FlightBooking::getBooking($txnRef);
                if($transactionStatus['status'] == 1){
                    Mail::to($userInfo)->send(new SuccessfulPayment($userInfo,$transactionStatus));
                    Mail::to($userInfo)->send(new SuccessfulFlightBooking($userInfo,$transactionStatus,$bookingInfo));
                }elseif($transactionStatus['status'] == 0){
                    Mail::to($userInfo)->send(new FailedPayment($userInfo,$transactionStatus));
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
                      Mail::to($userInfo)->send(new SuccessfulPayment($userInfo,$transactionStatus));
                      Mail::to($userInfo)->send(new SuccessfulFlightBooking($userInfo,$transactionStatus,$bookingInfo));
                  }elseif($transactionStatus['status'] == 0){
                      Mail::to($userInfo)->send(new FailedPayment($userInfo,$transactionStatus));
                  }
              }
           }else{
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

            }else{

            }
        }else{

        }
    }

    public function packagePaymentConfirmationInterswitch(){
        if(isset($_POST['txnref'])){
            $txnRef = $_POST['txnref'];
            $transactionInfo = OnlinePayment::getTransaction($txnRef);
            if(empty($transactionInfo) || is_null($transactionInfo)){

            }else{

            }
        }else{

        }
    }

    public function initiatePaystack(Request $r){
        return $this->PaystackConfig->initialize($r->email,$r->amount,$r->reference,$r->site_redirect_url);
    }

    public function saveTransaction(Request $r){
        return OnlinePayment::store($r);
    }

    public function bookingComplete(){
        $Itinerary = session()->get('selectedItinerary');
        $transactionStatus = session()->get('transactionStatus');
        return view("frontend.flights.success_payment", compact('transactionStatus','Itinerary'));
    }
}