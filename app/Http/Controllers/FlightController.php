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

//        session()->put('h',"hi");
//
//        dd(session()->get('h'));
        $SabreSession = new SabreSessionManager();
//        $sess = Session::get('session_info');
        /*if(session()->has('session_info'))
        {
            dd(session()->get("session_info"));
        }
        else
        {
            echo "no way"; die;
        }*/
        dd($SabreSession->sessionStore('session_info')/*, $sess*/);
////        $var = $SabreSession->createSession();
//        $var = $SabreSession->sessionCreateValidator($SabreSession->createSession());
//        $var_refresh = $SabreSession->sessionRefreshValidator($SabreSession->refreshSession($var['session_token'],'message_id'));
//        $var_re_refresh = $SabreSession->refreshSession($var['session_token'],'message_id');

//        $var_close = $SabreSession->closeSession($var['session_token'],'message_id');
//        $var_re_refresh = $SabreSession->refreshSession($var['session_token'],'message_id');
//        dd(array(
//            "session_create" => $var,
////            "session_create_validated" =>$var_val,
//            "session_refresh" => $var_refresh,
////            "session_close" => $var_close,
//            "session_re_refresh" => $var_re_refresh
//        ));
        return view("frontend.flights.deals", compact('var'));
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
//          dd($check_session);
        if($check_session == 0){
            return 0;
        }elseif($check_session == 2){
            return 2;
        }
          $search = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('BargainFinderMaxRQ'),$this->Sabreflight->BargainMaxFinderXml($r),'BargainFinderMaxRQ');
          $search_array = $this->SabreConfig->mungXmlToObject($search);
//          dd($search_array);
//        return $search_array();
        return view("frontend.flights.available-flights", compact('search_array'));
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
