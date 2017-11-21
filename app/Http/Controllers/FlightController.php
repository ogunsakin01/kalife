<?php

namespace App\Http\Controllers;

use App\Services\SabreFlight;
use Illuminate\Http\Request;


class FlightController extends Controller
{
    public function __construct(){

    }
    public function flightDeals(){
        $var = "john";
        return view("flights.deals", compact('var'));
    }
}
