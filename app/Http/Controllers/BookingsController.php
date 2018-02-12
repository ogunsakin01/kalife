<?php

namespace App\Http\Controllers;

use App\FlightBooking;
use App\Package;
use App\PackageBooking;
use App\Role;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function __construct(){
        $this->role = new Role();
    }


    public function authenticatedUserPackageBookings(){
        $bookings = PackageBooking::orderBy('id','desc')->get();
        return view('backend.bookings.package.user',compact('bookings'));
    }

    public function agentsPackageBookings(){
        $bookings = PackageBooking::orderBy('id','desc')->get();
        $successful_bookings = 0;
        $failed_bookings = 0;

        foreach($bookings as $booking){
            if($this->role->getUserRole($booking->user_id) === 2){
                if($booking->payment_status === 1){
                    $successful_bookings =  $successful_bookings+1;
                }elseif($booking->payment_status === 0){
                    $failed_bookings = $failed_bookings + 1;
                }
            }
        }

        return view('backend.bookings.package.agents',compact('bookings','successful_bookings','failed_bookings'));
    }

    public function customersPackageBookings(){
        $bookings = PackageBooking::orderBy('id','desc')->get();
        $successful_bookings = 0;
        $failed_bookings = 0;

        foreach($bookings as $booking){
            if($this->role->getUserRole($booking->user_id) === 1){
                if($booking->payment_status === 1){
                    $successful_bookings =  $successful_bookings+1;
                }elseif($booking->payment_status === 0){
                    $failed_bookings = $failed_bookings + 1;
                }
            }
        }

        return view('backend.bookings.package.customers',compact('bookings','successful_bookings','failed_bookings'));
    }


    public function authenticatedUserFlightBookings(){
       $bookings = FlightBooking::orderBy('id','desc')->get();
       return view('backend.bookings.flight.user',compact('bookings'));
    }

    public function agentsFlightBookings(){

    }

    public function customersFlightBookings(){

    }

    public function authenticatedUserHotelBookings(){

    }

    public function agentsHotelBookings(){

    }

    public function customersHotelBookings(){

    }


    public function authenticatedUserCarBookings(){

    }

    public function agentCarBookings(){

    }

    public function customerCarBookings(){

    }

}
