@extends('layouts.app')
@section('title')Booking History @endsection
@section('content')
    <div class="gap gap-small"></div>
    <div class="container">
        <h1 class="page-title">Bookings History</h1>
    </div>
    <div class="container">
        <div class="row">
           @include('partials.profileSideBar');
            <div class="col-md-9">
                <h4>Records</h4>
                <ul class="list list-inline user-profile-statictics mb30">
                    <li>
                        <a href="{{url('/flight-bookings')}}">
                            <i class="fa fa-plane user-profile-statictics-icon"></i>
                            <h5>{{\App\FlightBooking::getBookingsByUserId(auth()->user()->id)}}</h5>
                            <p>Itineraries</p>
                        </a>
                    </li>
                    <li><a href="#">
                            <i class="fa fa-building-o user-profile-statictics-icon"></i>
                            <h5>0</h5>
                            <p>Hotels</p>
                        </a>
                    </li>
                    <li><a href="#">
                            <i class="fa fa-car user-profile-statictics-icon"></i>
                            <h5>0</h5>
                            <p>Car Rentals</p>
                        </a>
                    </li>
                    <li><a href="#">
                            <i class="fa fa-suitcase user-profile-statictics-icon"></i>
                            <h5>0</h5>
                            <p>Travel Packages</p>
                        </a>
                    </li>

                </ul>
                <div id="map-canvas" style="width:100%; height:400px;"></div>
            </div>
        </div>
    </div>
    @endsection