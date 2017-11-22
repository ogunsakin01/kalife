<?php

namespace App\Http\Controllers;

use App\Services\SabreFlight;
use App\Services\SabreSessionManager;
use Illuminate\Http\Request;


class FlightController extends Controller
{
    public function __construct(){
        $this->Sabreflight = new SabreFlight();
        $this->SabreSession = new SabreSessionManager();
    }
    public function flightDeals(){
        $SabreSession = new SabreSessionManager();
        $var = $SabreSession->createSession();
        $var_refresh = $SabreSession->refreshSession($var['session_token'],'message_id');
        $var_close = $SabreSession->closeSession($var['session_token'],'message_id');
        $var_re_refresh = $SabreSession->refreshSession($var['session_token'],'message_id');
        dd(array(
            "session_create" => $var,
            "session_refresh" => $var_refresh,
            "session_close" => $var_close,
            "session_re_refresh" => $var_re_refresh
        ));
        return view("flights.deals", compact('var'));
    }
    public function searchFlight(){
       $search_parameters =  $this->validate([
           'departure_airport' => 'required|string',
           'arrival_airport' => 'required|string',
           'departure_date' => 'required|date',
           'arrival_date' => 'sometimes|required|date',
           'adult_passengers' => 'required|integer',
           'child_passengers' => 'required|integer',
           'infant_passengers' => 'required|integer',
       ]);
    }
}
