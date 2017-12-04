<?php

namespace App\Http\Controllers;

use App\Airport;
use App\IataCity;
use App\Services\SabreFlight;
use App\Services\SabreSessionManager;
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
    }

    public function flightDeals(){
        return view("frontend.flights.deals", compact('var'));
    }

    public function availableFlights(){
        $flightsResult = session()->get('availableFlights');
//        dd($flightsResult);
        $airlines = $this->Sabreflight->availableAirline($flightsResult);
        $flightsResult = $this->Sabreflight->sortFlightArray($flightsResult);
        $flightSearchParam = session()->get('flightSearchParam');
//        dd($flightSearchParam);
        return view("frontend.flights.available-flights",compact('flightsResult','flightSearchParam','airlines'));
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
        $check_session = $this->SabreSession->sessionStore('session_info');
        if($check_session == 0){
            return 0;
        }elseif($check_session == 2){
            return 2;
        }
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
          $search = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('BargainFinderMaxRQ'),$this->Sabreflight->BargainMaxFinderXml($r),'BargainFinderMaxRQ');
          $search_array = $this->SabreConfig->mungXmlToObject($search);
          session()->put('availableFlights',$search_array);
          session()->put('flightSearchParam',$requestArray);

          return  $this->Sabreflight->flightSearchValidator($search_array);
    }

    public function multiCitySearch(Request $r){
        $check_session = $this->SabreSession->sessionStore('session_info');
        if($check_session == 0){
            return 0;
        }elseif($check_session == 2){
            return 2;
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
        $search = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('BargainFinderMaxRQ'),$this->Sabreflight->MultiCityBargainMaxFinderXml($r),'BargainFinderMaxRQ');
        $search_array = $this->SabreConfig->mungXmlToObject($search);
        session()->put('availableFlights',$search_array);
        session()->put('flightSearchParam',$requestArray);
        return  $this->Sabreflight->flightSearchValidator($search_array);
    }

    public function typeaheadJs(Request $request)
    {
//        $data = IataCity::select(DB::raw('CONCAT(name, " - ", iata) AS name'))
//            ->where("name","LIKE","%{$request->input('query')}%")
//            ->orWhere("iata","LIKE","%{$request->input('query')}%")
//            ->get();
//        $data = IataCity::typeAhead($request);
        $data = Airport::select(DB::raw('CONCAT(airport_name, " - ", airport_code) AS name'))
            ->where("airport_name","LIKE","%{$request->input('query')}%")
            ->orWhere("airport_code","LIKE","%{$request->input('query')}%")
            ->get();

        return response()->json($data);
    }





}
