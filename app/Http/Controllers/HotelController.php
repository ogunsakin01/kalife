<?php

namespace App\Http\Controllers;

use App\Services\InterswitchConfig;
use App\Services\PaystackConfig;
use App\Services\SabreConfig;
use App\Services\SabreHotel;
use App\Services\SabreSessionManager;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function __construct(){
        $this->SabreHotel = new SabreHotel();
        $this->SabreConfig = new SabreConfig();
        $this->SabreSession = new SabreSessionManager();
        $this->InterswitchConfig = new InterswitchConfig();
        $this->PaystackConfig = new PaystackConfig();
    }


    public function searchHotel(Request $r){
        $this->validate($r, [
            'city' => 'required|string',
            'checkin_date' => 'required|string',
            'checkout_date' => 'required|string',
            'guests' => 'required|integer'
        ]);
        $session_store = $this->SabreSession->sessionStore();
        if(empty($session_store) || is_null($session_store)){
            return 0;
        }
        elseif($session_store == 0){
            return 0;
        }
        elseif($session_store == 2){
            return 2;
        }
        else{
            $requestArray = [
                'guests' => $r->guests,
                'city' => $r->city,
                'checkin_date' => $r->checkin_date,
                'checkout_date' => $r->checkout_date
            ];
            $search = $this->SabreHotel->doCall($this->SabreHotel->callsHeader('OTA_HotelAvailLLSRQ',$session_store),$this->SabreHotel->HotelAvailRQXML($r),'OTA_HotelAvailLLSRQ');
            $file = fopen("TestSampleOTA_HotelAvailLLSRQ.txt","w");
            fwrite($file, $this->SabreHotel->HotelAvailRQXML($r));
            fclose($file);
            $file = fopen("TestSampleOTA_HotelAvailLLSRs.txt","w");
            fwrite($file, $search);
            fclose($file);
            $responseArray = $this->SabreConfig->mungXmlToArray($search);
            $validator = $this->SabreHotel->HotelAvailValidator($responseArray);
            if($validator == 1){
                session()->put('availableHotels',$responseArray);
                session()->put('hotelSearchParam',$requestArray);
            }
            return $validator;
        }
    }

    public function availableHotels(){
        $hotelSearchParam = session()->get('hotelSearchParam');
        $responseArray = session()->get('availableHotels');
        $amenities = $this->SabreHotel->HotelAvailAmenities($responseArray);
        $ratings = $this->SabreHotel->HotelRatings($responseArray);
        $hotels = $this->SabreHotel->HotelAvailSort($responseArray);
        session()->put('hotels',$hotels);
        return view('frontend.hotels.available_hotels',compact('hotelSearchParam','hotels','amenities','ratings'));
    }

    public function selectedRoomBooking($room){
        $session_info = session()->get('selectedHotel');
        $selectedHotel = $session_info;
        $hotelSearchParam = session()->get('hotelSearchParam');
        $hotelsAvail = session()->get('availableHotels');
        $hotel = $this->SabreHotel->HotelAvailSort($hotelsAvail)[session()->get('selectedHotelId')];
        return view('frontend.hotels.selected_room',compact('selectedHotel','hotelSearchParam','hotel','room'));
    }

    public function selectedHotel(){
        $session_info = session()->get('selectedHotel');
        $selectedHotel = $session_info;
        $hotelSearchParam = session()->get('hotelSearchParam');
        $hotelsAvail = session()->get('availableHotels');
        $hotel = $this->SabreHotel->HotelAvailSort($hotelsAvail)[session()->get('selectedHotelId')];
        return view('frontend.hotels.hotel_description',compact('selectedHotel','hotelSearchParam','hotel'));
    }

    public function hotelPropertyDescription(Request $r){
        $this->validate($r,[
            'id' => 'required|integer'
        ]);
        $session_store = $this->SabreSession->sessionStore();
        if(empty($session_store) || is_null($session_store)){
            return 0;
        }
        elseif($session_store == 0){
            return 0;
        }
        elseif($session_store == 2){
            return 2;
        }
        else{
            $getDescription   = $this->SabreHotel->doCall($this->SabreHotel->callsHeader('HotelPropertyDescriptionLLSRQ',$session_store),$this->SabreHotel->HotelPropertyDescriptionRQXML($r),'HotelPropertyDescriptionLLSRQ');
            $hotelPropertyResponse =  $this->SabreHotel->validateHotelPropertyDescription($this->SabreConfig->mungXmlToArray($getDescription));
//            return $this->SabreConfig->mungXmlToArray($getDescription);
            if($hotelPropertyResponse == 1){
                $rate = 0;
                $currency = $this->SabreHotel->getHotelRoomsCurrencyRate($this->SabreHotel->sortPropertyDescription($this->SabreConfig->mungXmlToArray($getDescription), $rate));
                if(!is_null($currency)){
                    $getConversionRate = $this->SabreHotel->doCall($this->SabreHotel->callsHeader('DisplayCurrencyLLSRQ',$session_store),$this->SabreHotel->DisplayCurrencyRQXML($currency),'DisplayCurrencyLLSRQ');
                    $file = fopen("TestSampleDisplayCurrencyLLSRQ.txt","w");
                    fwrite($file, $this->SabreHotel->DisplayCurrencyRQXML($currency));
                    fclose($file);
                    $file = fopen("TestSampleDisplayCurrencyLLSRS.txt","w");
                    fwrite($file, $getConversionRate);
                    fclose($file);
                    $rateConversionRate = $this->SabreConfig->mungXmlToArray($getConversionRate);
                    if(!is_null($rateConversionRate)){
                        $rate = $this->SabreHotel->getRate($rateConversionRate);
                    }else{
                        $rate = 0;
                    }

                }
                session()->put('rate',$rate);
                session()->put('selectedHotel',$this->SabreHotel->sortPropertyDescription($this->SabreConfig->mungXmlToArray($getDescription),$rate));
                session()->put('selectedHotelId',$r->id);
            }
            $file = fopen("TestSampleHotelPropertyDescriptionLLSRQ.txt","w");
            fwrite($file, $this->SabreHotel->HotelPropertyDescriptionRQXML($r));
            fclose($file);
            $file = fopen("TestSampleHotelPropertyDescriptionLLSRS.txt","w");
            fwrite($file, $getDescription);
            fclose($file);
            return $hotelPropertyResponse;
        }

    }

    public function createReservation(Request $r){
        $selectedHotel = session()->get('selectedHotel');
        $room = $r->room;
        $session_store = $this->SabreSession->sessionStore();
        if(empty($session_store) || is_null($session_store)){
            return 0;
        }
        elseif($session_store == 0){
            return 0;
        }
        elseif($session_store == 2){
            return 2;
        }
        else{
            $runPassengerDetails = $this->SabreHotel->doCall($this->SabreHotel->callsHeader('PassengerDetailsRQ',$session_store),$this->SabreHotel->PassengerDetailsRQXML(),'PassengerDetailsRQ');
            $runHotelReserve      = $this->SabreHotel->doCall($this->SabreHotel->callsHeader('OTA_HotelResLLSRQ',$session_store),$this->SabreHotel->HotelReserveRQXML($room,$selectedHotel),'OTA_HotelResLLSRQ');
            $runEndTransaction   = $this->SabreHotel->doCall($this->SabreHotel->callsHeader('EndTransactionLLSRQ',$session_store),$this->SabreHotel->EndTransactionRQXML(),'EndTransactionLLSRQ');

            $file = fopen("TestSamplehotelPassenegrDetailsRQ.txt","w");
            fwrite($file, $this->SabreHotel->PassengerDetailsRQXML());
            fclose($file);
            $file = fopen("TestSamplehotelPassenegrDetailsRS.txt","w");
            fwrite($file, $runPassengerDetails);
            fclose($file);
            $file = fopen("TestSamplehotelResRQ.txt","w");
            fwrite($file, $this->SabreHotel->HotelReserveRQXML($room,$selectedHotel));
            fclose($file);
            $file = fopen("TestSamplehotelResRS.txt","w");
            fwrite($file, $runHotelReserve);
            fclose($file);
            $file = fopen("TestSampleEndTransactionRQ.txt","w");
            fwrite($file, $this->SabreHotel->EndTransactionRQXML());
            fclose($file);
            $file = fopen("TestSampleEndTransactionRS.txt","w");
            fwrite($file, $runEndTransaction);
            fclose($file);
            dd(
                [
                    $this->SabreConfig->mungXmlToArray($runPassengerDetails),
                    $this->SabreConfig->mungXmlToArray($runHotelReserve),
                    $this->SabreConfig->mungXmlToArray($runEndTransaction)
                ]
            );
        }
    }

    public function hotelPaymentOption($room){
        $session_info = session()->get('selectedHotel');
        $selectedHotel = $session_info;
        $hotelSearchParam = session()->get('hotelSearchParam');
        $hotelsAvail = session()->get('availableHotels');
        $hotel = $this->SabreHotel->HotelAvailSort($hotelsAvail)[session()->get('selectedHotelId')];
        return view('frontend.hotels.payment_options',compact('selectedHotel','hotelSearchParam','hotel','room'));
    }
}
