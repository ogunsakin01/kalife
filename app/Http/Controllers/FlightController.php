<?php

namespace App\Http\Controllers;

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
        return view("frontend.flights.available-flights",compact('flightsResult'));
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
          $search = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('BargainFinderMaxRQ'),$this->Sabreflight->BargainMaxFinderXml($r),'BargainFinderMaxRQ');
          $search_array = $this->SabreConfig->mungXmlToObject($search);
          $sorted_array = $this->Sabreflight->sortFlightArray($search_array);
          session()->put('availableFlights',$sorted_array);
          return  $this->Sabreflight->flightSearchValidator($search_array);
    }

    public function typeaheadJs(Request $request)
    {
        $data = IataCity::select(DB::raw('CONCAT(name, " - ", iata) AS name'))
            ->where("name","LIKE","%{$request->input('query')}%")
            ->orWhere("iata","LIKE","%{$request->input('query')}%")
            ->get();

        return response()->json($data);
    }

}
