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
        $check_session = $this->SabreSession->sessionStore();
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
            $file = fopen("TestSampleBergainMaxFinderRQ.txt","w");
            fwrite($file,$this->Sabreflight->BargainMaxFinderXml($r));
            fclose($file);
            $file = fopen("TestSampleBergainMaxFinderRS.txt","w");
            fwrite($file, $search);
            fclose($file);
            return  $this->Sabreflight->flightSearchValidator($search_array);
        }


    }

    public function multiCitySearch(Request $r){
        $check_session = $this->SabreSession->sessionStore();
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

            $file = fopen("TestSampleBergainMaxFinderMultipleCitiesRQ.txt","w");
            fwrite($file,$this->Sabreflight->MultiCityBargainMaxFinderXml($r));
            fclose($file);
            $file = fopen("TestSampleBergainMaxFinderMultipleCitiesRS.txt","w");
            fwrite($file, $search);
            fclose($file);


            return  $this->Sabreflight->flightSearchValidator($search_array);

    }

    public function flightCreatePNR(Request $r){
        $itinerary = session()->get('selectedItinerary');
        $message_id = session()->get('message_id');
        $token = SessionToken::getTokenWithId($message_id);
        $session_info = [
            'token' => $token,
            'message_id' => $message_id
        ];
        $request = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('PassengerDetailsRQ',$session_info),$this->Sabreflight->PassengerDetailsRQXML($r),'PassengerDetailsRQ');
        $responseArray = $this->SabreConfig->mungXmlToArray($request);
        $info = $this->Sabreflight->passengerDetailsValidator($responseArray);

        $file = fopen("TestSamplePassengerDetailsRQ.txt","w");
        fwrite($file,$this->Sabreflight->PassengerDetailsRQXML($r));
        fclose($file);
        $file = fopen("TestSamplePassengerDetailsRS.txt","w");
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
                $this->SabreSession->closeSession($token,$message_id);
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
        }elseif($check_session == 2){
            return 21;
        }else{
             session()->put('message_id',$check_session['message_id']);
             SessionToken::tokenUsed($check_session['message_id']);
             $priceItinerary = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('EnhancedAirBookRQ',$check_session),$this->Sabreflight->EnhancedAirBookRQXML($Itinerary,session()->get('flightSearchParam')),'EnhancedAirBookRQ');
             $flightBookPricing = $this->SabreConfig->mungXmlToArray($priceItinerary);
             $status = $this->Sabreflight->enhancedAirBookValidator($flightBookPricing);
             $file = fopen("TestSampleEnhancedAirBookRQ.txt","w");
             fwrite($file,$this->Sabreflight->EnhancedAirBookRQXML($Itinerary,session()->get('flightSearchParam')));
             fclose($file);
             $file = fopen("TestSampleEnhancedAirBookRs.txt","w");
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

}
