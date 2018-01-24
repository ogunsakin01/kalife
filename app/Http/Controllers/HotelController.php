<?php

namespace App\Http\Controllers;

use App\HotelBooking;
use App\Services\InterswitchConfig;
use App\Services\PaystackConfig;
use App\Services\SabreConfig;
use App\Services\SabreHotel;
use App\Services\SabreSessionManager;
use App\SessionToken;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        if(!session()->has(['availableHotels','hotelSearchParam'])){return back();}
        $hotelSearchParam = session()->get('hotelSearchParam');
        $responseArray = session()->get('availableHotels');
        $amenities = $this->SabreHotel->HotelAvailAmenities($responseArray);
        $ratings = $this->SabreHotel->HotelRatings($responseArray);
        $hotels = $this->SabreHotel->HotelAvailSort($responseArray);
        session()->put('hotels',$hotels);
        return view('frontend.hotels.available_hotels',compact('hotelSearchParam','hotels','amenities','ratings'));
    }

    public function selectedRoomBooking($room){
        if(!session()->has(['availableHotels','hotelSearchParam','selectedHotel'])){return back();}
        $session_info = session()->get('selectedHotel');
        $selectedHotel = $session_info;
        $hotelSearchParam = session()->get('hotelSearchParam');
        $hotelsAvail = session()->get('availableHotels');
        $hotel = $this->SabreHotel->HotelAvailSort($hotelsAvail)[session()->get('selectedHotelId')];
        $rateDescription = [];

        if($selectedHotel['rooms'][$room]['hrdRequiredForSell'] == 'true'){
            $rateDescriptionParam = [
                'hotelCode' => $selectedHotel['hotelCode'],
                'currencyCode' => $selectedHotel['rooms'][$room]['currencyCode'],
                'checkOutDate' => $selectedHotel['checkoutDate'],
                'checkInDate' => $selectedHotel['checkinDate'],
                'rph' => $selectedHotel['rooms'][$room]['rph']
            ];
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
            else {
                $getRateDescription = $this->SabreHotel->doCall($this->SabreHotel->callsHeader('HotelRateDescriptionLLSRQ', $session_store), $this->SabreHotel->HotelRateDescriptionRQXML($rateDescriptionParam), 'HotelRateDescriptionLLSRQ');
                $file = fopen("TestSampleRateDescriptionRQ.txt","w");
                fwrite($file,  $this->SabreHotel->HotelRateDescriptionRQXML($rateDescriptionParam));
                fclose($file);
                $file = fopen("TestSampleRateDescriptionRS.txt","w");
                fwrite($file, $getRateDescription);
                fclose($file);
                /*return*/
                dd($this->SabreConfig->mungXmlToArray($getRateDescription));
            }
        }

        return view('frontend.hotels.selected_room',compact('selectedHotel','hotelSearchParam','hotel','room','rateDescription'));
    }

    public function selectedHotel(){
        if(!session()->has(['availableHotels','hotelSearchParam','selectedHotel'])){return back();}
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
            $file = fopen("TestSampleHotelPropertyDescriptionLLSRQ.txt","w");
            fwrite($file, $this->SabreHotel->HotelPropertyDescriptionRQXML($r));
            fclose($file);
            $file = fopen("TestSampleHotelPropertyDescriptionLLSRS.txt","w");
            fwrite($file, $getDescription);
            fclose($file);
            $hotelPropertyResponse =  $this->SabreHotel->validateHotelPropertyDescription($this->SabreConfig->mungXmlToArray($getDescription));
//            return $this->SabreConfig->mungXmlToArray($getDescription);
            if($hotelPropertyResponse == 1){
                $rate = 0;
                $currency = $this->SabreHotel->getHotelRoomsCurrencyRate($this->SabreHotel->sortPropertyDescription($this->SabreConfig->mungXmlToArray($getDescription), $rate));
                if(!empty($currency) && !is_null($currency) && $currency !== ""){
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
            $file = fopen("TestSampleHotelPassengerDetailsRQ.txt","w");
            fwrite($file, $this->SabreHotel->PassengerDetailsRQXML());
            fclose($file);
            $file = fopen("TestSampleHotelPassengerDetailsRS.txt","w");
            fwrite($file, $runPassengerDetails);
            fclose($file);
            if($this->SabreHotel->validatePassengerDetailsResponse($this->SabreConfig->mungXmlToArray($runPassengerDetails)) == 1){
                $runHotelReserve = $this->SabreHotel->doCall($this->SabreHotel->callsHeader('OTA_HotelResLLSRQ',$session_store),$this->SabreHotel->HotelReserveRQXML($room,$selectedHotel),'OTA_HotelResLLSRQ');
                $file = fopen("TestSampleHotelResRQ.txt","w");
                fwrite($file, $this->SabreHotel->HotelReserveRQXML($room,$selectedHotel));
                fclose($file);
                $file = fopen("TestSampleHotelResRS.txt","w");
                fwrite($file, $runHotelReserve);
                fclose($file);
                SessionToken::tokenClosed($session_store['message_id']);
                SessionToken::tokenUsed($session_store['message_id']);
                session()->put('message_id',$session_store['message_id']);
                $responseValidator = $this->SabreHotel->validateHotelResResponse($this->SabreConfig->mungXmlToArray($runHotelReserve));
                if($responseValidator == 1){
                    $reference = $this->SabreConfig->bookingReference('hotel');
                    session()->put('bookingReference',$reference);
                    /**
                    Store booking here
                     *
                     */

                    return redirect(url('/payment-option/'.$room.'/reservation'));
                }elseif($responseValidator == 2){
                    return redirect()->back()->with('errorMessage','You cannot continue the booking process. Select another hotel or another room from the result and try again.');
                }elseif($responseValidator == 0){
                    return redirect()->back()->with('errorMessage','You cannot continue the booking process. Could not connect to server.');
                }
            }else{
                $responseValidator = $this->SabreHotel->validatePassengerDetailsResponse($this->SabreConfig->mungXmlToArray($runPassengerDetails));
                if($responseValidator == 2){
                    return redirect()->back()->with('errorMessage','You cannot continue the booking process. Select another hotel or another room from the result and try again.');
                }elseif($responseValidator == 0){
                    return redirect()->back()->with('errorMessage','You cannot continue the booking process. Could not connect to server.');
                }
            }

        }
    }

    public function hotelPaymentOption($room){
        if(!session()->has(['availableHotels','hotelSearchParam','selectedHotel','selectedHotelId'])){return back();}
        $session_info = session()->get('selectedHotel');
        $selectedHotel = $session_info;
        $hotelSearchParam = session()->get('hotelSearchParam');
        $hotelsAvail = session()->get('availableHotels');
        $hotel = $this->SabreHotel->HotelAvailSort($hotelsAvail)[session()->get('selectedHotelId')];
        $txnRef = session()->get('bookingReference');
        $bookingInfo = HotelBooking::find($txnRef);
        $custInfo = User::find($bookingInfo->user_id);
        $paymentInfo = [
            'reference' => $txnRef,
            'amount' => $bookingInfo->total_amount,
            'pay_item_id' => $this->InterswitchConfig->item_id,
            'site_redirect_url' => url('/flight-booking-confirmation'),
            'product_id' => $this->InterswitchConfig->product_id,
            'cust_id' => $bookingInfo->user_id,
            'cust_name' => $custInfo->first_name.' '.$custInfo->last_name,
            'hash' => $this->InterswitchConfig->transactionHash($txnRef,$bookingInfo->total_amount,url('/hotel-booking-confirmation')),
            'email' => $custInfo->email
        ];
        return view('frontend.hotels.payment_options',compact('selectedHotel','hotelSearchParam','hotel','room','bookingInfo','paymentInfo'));
    }

}
