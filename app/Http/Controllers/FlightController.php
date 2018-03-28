<?php

namespace App\Http\Controllers;

use App\Airline;
use App\Airport;
use App\FlightBooking;
use App\IataCity;
use App\Services\InterswitchConfig;
use App\Services\PaystackConfig;
use App\Services\SabreFlight;
use App\Services\SabreSessionManager;
use App\SessionToken;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Services\SabreConfig;


class FlightController extends Controller
{

    public function __construct(){
        $this->Sabreflight = new SabreFlight();
        $this->SabreSession = new SabreSessionManager();
        $this->SabreConfig = new SabreConfig();
        $this->InterswitchConfig = new InterswitchConfig();
        $this->PaystackConfig = new PaystackConfig();
    }

    public function checkUserPermission(){
        if(auth()->user()){
            if(auth()->user()->hasRole('Agent') || auth()->user()->hasRole('Super Admin')){
                return redirect(url('backend/login'));
            }
        }
    }

    public function flightDeals(){
        return view("frontend.flights.deals", compact('var'));
    }

    public function availableFlights(){
        if(!session()->has(['availableFlights','flightSearchParam'])){
            Toastr::error('Session Expired. Try search again');
            return back();
        }
        $flightsResult = session()->get('availableFlights');
        $flightSearchParam = session()->get('flightSearchParam');
        $airlines = $this->Sabreflight->availableAirline($flightsResult);
        $flightsResult = $this->Sabreflight->sortFlightArray($flightsResult);
        return view('frontend.flights.available_flights',compact('flightsResult','flightSearchParam','airlines'));
    }

    public function flightPassengerDetails(){
        if(!session()->has('selectedItinerary')){
            Toastr::error('Session Expired. Try search again');
            return redirect(url('/'));
        }
        $itinerary = session()->get('selectedItinerary');
            return view('frontend.flights.passenger_details',compact('itinerary'));
    }

    public function searchFlight(Request $r){
       $this->validate($r, [
           'departure_airport' => 'required|string',
           'arrival_airport' => 'required|string',
           'adult_passengers' => 'required|integer',
           'child_passengers' => 'required|integer',
           'infant_passengers' => 'required|integer',
           'flight_type' => 'required|string',
           'cabin_type' =>  'required|string'
       ]);
        $check_session = $this->SabreSession->searchSessionStore();
        if(empty($check_session) || is_null($check_session)){
            return 0;
        }
        elseif($check_session == 0){
            return 0;
        }elseif($check_session == 2){
            return 2;
        }else{
            $requestArray = [
                'departure_airport' => $r->departure_airport,
                'arrival_airport' => $r->arrival_airport,
                'departure_date' => $r->departure_date,
                'adult_passengers' => $r->adult_passengers,
                'child_passengers' => $r->child_passengers,
                'infant_passengers' => $r->infant_passengers,
                'cabin_type' => $r->cabin_type,
                'flight_type' => $r->flight_type
            ];
            $search = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('BargainFinderMaxRQ',$check_session),$this->Sabreflight->BargainMaxFinderXml($r),'BargainFinderMaxRQ');
            $search_array = $this->SabreConfig->mungXmlToArray($search);
            session()->put('availableFlights',$search_array);
            session()->put('flightSearchParam',$requestArray);

            $file = fopen("BargainFinderMaxRS.xml","w");
            fwrite($file, $search);
            fclose($file);
            return  $this->Sabreflight->flightSearchValidator($search_array);
        }


    }

    public function multiCitySearch(Request $r){
        $check_session = $this->SabreSession->searchSessionStore();
        if($check_session == 0){
            return 0;
        }elseif($check_session == 2){
            return 2;
        }elseif($check_session == 3){
            return 3;
        }elseif($check_session == 31){
            return 31;
        }

        $requestArray = [
                'departure_airport' => "Multiple Cities",
                'arrival_airport' => "Multiple Cities",
                'departure_date' => "Multiple Dates",
                'adult_passengers' => $r['searchParameters'][0]['adult_passengers'],
                'child_passengers' => $r['searchParameters'][0]['child_passengers'],
                'infant_passengers' => $r['searchParameters'][0]['infant_passengers'],
                'cabin_type' => $r['searchParameters'][0]['cabin_type'],
                'flight_type' => 'Multi Destinations'
            ];
            $search = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('BargainFinderMaxRQ',$check_session),$this->Sabreflight->MultiCityBargainMaxFinderXml($r),'BargainFinderMaxRQ');
            $search_array = $this->SabreConfig->mungXmlToArray($search);
            session()->put('availableFlights',$search_array);
            session()->put('flightSearchParam',$requestArray);

            $file = fopen("BargainFinderMaxRS.xml","w");
            fwrite($file, $search);
            fclose($file);


            return  $this->Sabreflight->flightSearchValidator($search_array);

    }

    public function flightCreatePNR(Request $r){
        $itinerary = session()->get('selectedItinerary');
        $message_id = session()->get('message_id');
        $tokenData    = SessionToken::where('message_id',$message_id)->first();
        $session_info = [
            'token'      => $tokenData->token,
            'message_id' => $message_id,
            'conv_id'    => $tokenData->conv_id
        ];
        $request = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('PassengerDetailsRQ',$session_info),$this->Sabreflight->PassengerDetailsRQXML($r),'PassengerDetailsRQ');
        $responseArray = $this->SabreConfig->mungXmlToArray($request);
        $info = $this->Sabreflight->passengerDetailsValidator($responseArray);

        $file = fopen("PassengerDetailsRS.xml","w");
        fwrite($file,$request);
        fclose($file);

        if($info == 0){
            return redirect(url('/flight-passenger-details'))->with('errorMessage','Unable to connect to the booking server. Ensure your internet connection is strong and try again');
        }
        else{
            if($info['pnrStatus'] == 0){
                return redirect(url('/flight-passenger-details'))->with('errorMessage','You cannot continue the booking process. Select another flight from the result and try again.');
            }else{
                $total_amount = 0;
                $markup = 0;
                if(auth()->user()->hasRole('Agent')){
                    $total_amount = $itinerary[0]['adminToAgentSumTotal'];
                    $markup = $itinerary[0]['adminToAgentMarkup'];
                }elseif(auth()->user()->hasRole('Super Admin')){
                    $total_amount = $itinerary[0]['adminToAdminSumTotal'];
                    $markup = $itinerary[0]['adminToAdminMarkup'];
                }elseif(auth()->user()->hasRole('Customer')){
                    $total_amount = $itinerary[0]['adminToUserSumTotal'];
                    $markup = $itinerary[0]['adminToUserMarkup'];
                }
                if(auth())
                $this->SabreSession->closeSession($tokenData->token,$message_id,$tokenData->conv_id);
                SessionToken::tokenClosed($message_id);
                SessionToken::tokenUsed($message_id);
                $txnRef = $this->SabreConfig->bookingReference('flight');
                $data = [
                    'user_id' => auth()->user()->id,
                    'booking_reference' => $txnRef,
                    'pnr_code' => $info['pnr'],
                    'itinerary_amount' => $itinerary[0]['totalPrice'],
                    'admin_markup' => $markup,
                    'airline_markdown' => $itinerary[0]['airlineMarkdown'],
                    'vat' => $itinerary[0]['vat'],
                    'agent_markup' => 0,
                    'total_amount' => $total_amount,
                    'ticket_time_limit' => $info['ticketTimeLimit'],
                    'pnr_status' => $info['pnrStatus'],
                    'pnr_request_response' => $info['responseObject']
                ];
                FlightBooking::store($data);
                session()->put('bookingReference',$txnRef);
                return redirect(url("/flight-booking-payment-methods"));
            }

        }
    }

    public function typeaheadJs(Request $request)
    {
        $data = Airport::select(DB::raw('CONCAT(airport_code, " - ", airport_name) AS name'))
            ->where("airport_code","LIKE","%{$request->input('query')}%")
            ->orWhere("airport_name","LIKE","%{$request->input('query')}%")
            ->get();

        return response()->json($data);
    }

    public function airlineTypeAheadJs(Request $request){
        $data = Airline::select(DB::raw('CONCAT(Airline) AS name'))
            ->where("IATA","LIKE","%{$request->input('query')}%")
            ->orWhere("Airline","LIKE","%{$request->input('query')}%")
            ->get();

        return response()->json($data);
    }

    public function flightBookPricing(Request $r){
        $id = $r->id;
        $Itinerary = $this->Sabreflight->sortFlightArray(session()->get('availableFlights'))[$id];
        $check_session = $this->SabreSession->sessionStore();
        if($check_session == 0){

            return 0;

        }
        elseif($check_session == 2){

            return 21;

        }
        else{

             session()->put('message_id',$check_session['message_id']);
             SessionToken::tokenUsed($check_session['message_id']);
             $priceItinerary = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('EnhancedAirBookRQ',$check_session),$this->Sabreflight->EnhancedAirBookRQXML($Itinerary,session()->get('flightSearchParam')),'EnhancedAirBookRQ');
             $flightBookPricing = $this->SabreConfig->mungXmlToArray($priceItinerary);
             $status = $this->Sabreflight->enhancedAirBookValidator($flightBookPricing);
             $file = fopen("EnhancedAirBookRS.xml","w");
             fwrite($file,$priceItinerary);
             fclose($file);

             if($status == 1){

                 /**
                  *
                  * Updating price with new price update from price quote
                  *
                  * */

                 $newItineraryPrice = $flightBookPricing['soap-env_Body']['EnhancedAirBookRS']['TravelItineraryReadRS']['TravelItinerary']['ItineraryInfo']['ItineraryPricing']['PriceQuoteTotals']['TotalFare']['@attributes']['Amount'];
                 $oldItineraryPrice = $Itinerary[0]['totalPrice'];
                 $itineraryPriceAddition = $newItineraryPrice - $oldItineraryPrice;
                 $Itinerary[0]['itineraryPriceAddition'] = $itineraryPriceAddition;
                 $Itinerary[0]['adminToUserSumTotal'] = $Itinerary[0]['adminToUserSumTotal'] + $itineraryPriceAddition;
                 $Itinerary[0]['adminToAgentSumTotal'] = $Itinerary[0]['adminToAgentSumTotal'] + $itineraryPriceAddition;
                 $Itinerary[0]['adminToAdminSumTotal'] = $Itinerary[0]['adminToAdminSumTotal'] + $itineraryPriceAddition;
                 $Itinerary[0]['totalPrice'] = $newItineraryPrice;
                 session()->put('selectedItinerary',$Itinerary);
                 return $status;

             }else{

                 $this->SabreSession->closeSession($check_session['token'],$check_session['message_id'],$check_session['conv_id']);
                 SessionToken::tokenClosed($check_session['message_id']);
                 return $status;

             }
         }


//
    }

    public function flightPaymentPage(){
        if(!session()->has(['selectedItinerary','bookingReference'])){return back();}
        $itinerary = session()->get('selectedItinerary');
        $txnRef = session()->get('bookingReference');
        $bookingInfo = FlightBooking::getBooking($txnRef);
        $custInfo = User::getUserById($bookingInfo->user_id);
        $paymentInfo = [
            'reference' => $txnRef,
            'amount' => $bookingInfo->total_amount,
            'pay_item_id' => $this->InterswitchConfig->item_id,
            'site_redirect_url' => url('/flight-booking-confirmation'),
            'product_id' => $this->InterswitchConfig->product_id,
            'cust_id' => $bookingInfo->user_id,
            'cust_name' => $custInfo->first_name.' '.$custInfo->last_name,
            'hash' => $this->InterswitchConfig->transactionHash($txnRef,$bookingInfo->total_amount,url('/flight-booking-confirmation')),
            'email' => $custInfo->email
        ];
        return view('frontend.flights.payment_options',compact('itinerary','paymentInfo'));
    }

    public function closeSabreToken($token_id){
        $tokenData = SessionToken::find($token_id);
        $close_session = $this->SabreSession->closeSession($tokenData->token,$tokenData->message_id,$tokenData->conv_id);

        $close_status = $this->SabreSession->sessionTokenCloseValidator($close_session);

        if($close_status == 1){
            SessionToken::tokenClosed($tokenData->message_id);
            SessionToken::tokenUsed($tokenData->message_id);
            dd('Yes, Session Closed Successfully');
        }else{
            dd($close_session);
        }

    }

    public function closeAllSabreSessionTokens(){
        $tokenDatas = SessionToken::all();
        foreach($tokenDatas as $serial => $tokenData){

            if(strtotime($tokenData->created_at,strtotime('+ 1 hour')) < strtotime(date('Y-m-d H:i:s'))){
                if($tokenData->closed_status == 0){
                    $close_session = $this->SabreSession->closeSession($tokenData->token,$tokenData->message_id,$tokenData->conv_id);
                    $close_status = $this->SabreSession->sessionTokenCloseValidator($close_session);
                    if($close_status == 1){
                        SessionToken::tokenClosed($tokenData->message_id);
                        SessionToken::tokenUsed($tokenData->message_id);
                        Toastr::success('Session toke with id = '. $tokenData->id. "has been closed successfully");
                    }else{
                        Toastr::error('Unable to close session token with id = '. $tokenData->id);
                    }
                }
            }
        }
    }

    public function cancelPnr($pnr){
        $check_session = $this->SabreSession->sessionStore();
        if(empty($check_session) || is_null($check_session)){
            return 0;
        }
        elseif($check_session == 0){
            return 0;
        }elseif($check_session == 2){
            return 2;
        }else{
            $readItinerary = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('TravelItineraryReadRQ',$check_session),$this->Sabreflight->travelItineraryReadRQ($pnr),'TravelItineraryReadRQ');
            $responseArray = $this->SabreConfig->mungXmlToArray($readItinerary);
            $readItineraryValidator = $this->Sabreflight->travelItineraryReadValidator($responseArray);
            if($readItineraryValidator == 1){
                session()->put('message_id',$check_session['message_id']);
                SessionToken::tokenUsed($check_session['message_id']);
                 $cancelPnr = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('OTA_CancelLLSRQ',$check_session),$this->Sabreflight->cancelPnrRQXML(),'OTA_CancelLLSRQ');
                 $responseArray = $this->SabreConfig->mungXmlToArray($cancelPnr);
                 $cancelPnrValidator = $this->Sabreflight->cancelPnrValidator($responseArray);
                 if($cancelPnrValidator == 1){
                     $flightBooking = FlightBooking::where('pnr',$pnr)->first();
                     $flightBooking->cancel_tikcet_status = 1;
                     $flightBooking->update();
                 }
                 $this->SabreSession->closeSession($check_session['token'],$check_session['message_id'],$check_session['conv_id']);
                 SessionToken::tokenClosed($check_session['message_id']);
                 return $cancelPnrValidator;
            }elseif($readItineraryValidator == 0){
                   return 0;
            }elseif(is_array($readItineraryValidator)){
                if($readItineraryValidator[0] == 2){
                   return json_encode($readItineraryValidator);
                }else{
                   return 2;
                }
            }


        }

    }

    public function voidTicket($ticketNumber){
        $check_session = $this->SabreSession->sessionStore();
        if(empty($check_session) || is_null($check_session)){
            return 0;
        }
        elseif($check_session == 0){
            return 0;
        }elseif($check_session == 2){
            return 2;
        }else{
            $voidTicket = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('VoidTicketLLSRQ',$check_session),$this->Sabreflight->voidTicketRQXML($ticketNumber),'VoidTicketLLSRQ');
            $responseArray = $this->SabreConfig->mungXmlToArray($voidTicket);
            return $this->Sabreflight->voidTicketValidator($responseArray);
        }
    }

    public function issueTicket($pnr){

    }

}
