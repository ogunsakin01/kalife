<?php

namespace App\Http\Controllers;

use App\FlightBooking;
use App\PackageBooking;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User();

        $name = $user->getAuthenticatedUserFullName();

        $userFlightBookings = count(FlightBooking::where('user_id',auth()->user()->id)->get());

        $userPackagesBookings = count(PackageBooking::where('user_id',auth()->user()->id)->get());


        $userWalletBalance = Wallet::where('user_id',auth()->user()->id)->first()->balance;

        $allFlightBookings = count(FlightBooking::all());


        $allPackagesBookings = count(PackageBooking::all());

        return view('backend.home', compact('name','userFlightBookings','userWalletBalance','userPackagesBookings','allFlightBookings','allPackagesBookings'));
    }
}
