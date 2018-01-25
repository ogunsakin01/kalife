<?php

namespace App\Http\Controllers;

use App\Attraction;
use App\Email;
//use App\Message;
use App\Gallery;
use App\GoodToKnow;
use App\OnlinePayment;
use App\Package;
use App\PackageAttraction;
use App\PackageBooking;
use App\PackageFlight;
use App\Services\InterswitchConfig;
use App\Services\PaystackConfig;
use App\Services\SabreConfig;
use App\Services\SabreFlight;
use App\Services\SabreSessionManager;
use App\SightSeeing;
use App\TravelPackage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class FrontEndController extends Controller
{

    public function __construct(){
        $this->SabreFlight = new SabreFlight();
        $this->SabreConfig = new SabreConfig();
        $this->SessionManager = new SabreSessionManager();
        $this->InterswitchConfig = new InterswitchConfig();
        $this->PaystackConfig = new PaystackConfig();
    }

    public function subscribe(Request $r){
        $this->validate($r, [
            'email' => 'required|string'
        ]);
        $email = $r->email;
       if(Email::getEmail($email)){
           return 2;
       }else{
           $store = Email::store($email);
               return 1;
       }
    }

    public function message(Request $r){
        $this->validate($r, [
            'email' => 'required|string',
            'name'  =>  'required|string',
            'message' => 'required|string'
        ]);
        if(\App\Message::getMessage($r)){
           return 2;
        }else{
            \App\Message::store($r);
            return 1;
        }

    }

    public function tokenRefresh(Request $r){
        $this->validate($r, [
            'refresh' => 'required|string'
            ]);

        return $this->SessionManager->refreshSessionToken();
    }

    public function pageTimeOut(Request $r){
        $this->validate($r, [
            'timeout' => 'required|string'
        ]);
        return 1;
    }

    public function attractions(){
          $attractions = TravelPackage::where('attraction',1)
              ->where('hotel', 0)
              ->where('flight', 0)
              ->where('status', 1)
              ->paginate(8);
          return view('frontend.attractions.attractions',compact('attractions'));

    }

    public function attractionDetails($id,$name){

          $images = Gallery::getGalleryByPackageId($id);
          $attraction_info = TravelPackage::find($id);
          $attraction = Attraction::getByPackageId($id);
          $sight_seeings = SightSeeing::getSightseeingByPackageId($id);
        return view('frontend.attractions.attraction_details', compact('id','name','images','attraction_info','sight_seeings','attraction'));
    }

    public function attractionBook($id,$name){
        $images = Gallery::getGalleryByPackageId($id);
        $attraction_info = TravelPackage::find($id);
        $attraction = Attraction::getByPackageId($id);
        $sight_seeings = SightSeeing::getSightseeingByPackageId($id);
        return view('frontend.packages.package_booking', compact('id','name','images','attraction','attraction_info','sight_seeings'));
    }

    public function flightDeals(){
        $flights = Package::where('attraction',0)
            ->where('hotel', 0)
            ->where('flight', 1)
            ->where('status', 1)
            ->paginate(8);
        return view('frontend.flights.deals',compact('flights'));
    }

    public function bookPackage(Request $r){
        $user_id = auth()->user()->id;
        $txnRef = $this->SabreConfig->bookingReference('package');
        $amount = $r->total_amount * 100;
        $bookingData = [
            'reference' => $txnRef,
            'user_id' => $user_id,
            'package_id' => $r->package_id,
            'adults' => $r->adults,
            'children' => $r->children,
            'infants'  => $r->infants,
            'total_amount' => $amount
        ];
        PackageBooking::store($bookingData);


           return redirect(url("/package-payment-methods/$txnRef"));
    }

    public function packagePaymentMethod($txnRef){
            $bookingInfo = PackageBooking::getBookingByReference($txnRef);
            if(is_null($bookingInfo) || empty($bookingInfo)){
               return redirect(back());
            }
            $custInfo = User::find($bookingInfo->user_id);
            $paymentInfo = [
            'reference' => $txnRef,
            'amount' => $bookingInfo->total_amount,
            'pay_item_id' => $this->InterswitchConfig->item_id,
            'site_redirect_url' => url('/package-booking-confirmation'),
            'product_id' => $this->InterswitchConfig->product_id,
            'cust_id' => $bookingInfo->user_id,
            'cust_name' => $custInfo->first_name.' '.$custInfo->last_name,
            'hash' => $this->InterswitchConfig->transactionHash($txnRef,$bookingInfo->total_amount,url('/package-booking-confirmation')),
            'email' => $custInfo->email
            ];
            $id = $bookingInfo->package_id;
            $attraction_info = TravelPackage::find($id);
            $bookingData = $bookingInfo;
            $name = $attraction_info->package_name;
            $images = Gallery::getGalleryByPackageId($id);
            return view('frontend.packages.package_payment_method', compact('id','name','paymentInfo','bookingData','attraction_info','images'));
    }

    public function flightDealDetails($id,$name){
        $images = Gallery::getGalleryByPackageId($id);
        $flight_info = Package::getPackageById($id);
        $good_to_knows = GoodToKnow::getGoodToKnowByPackageId($id);
        $flights = PackageFlight::getFlightsByPackageId($id);
        return view('frontend.flights.details', compact('id','name','images','flights','flight_info','good_to_knows'));
    }

    public function hotelDeals(){
        $hotel_packages = TravelPackage::where('attraction',0)
            ->where('hotel', 1)
            ->where('flight', 0)
            ->where('status', 1)
            ->paginate(8);
        return view('frontend.hotels.deals',compact('hotel_packages'));
    }

}
