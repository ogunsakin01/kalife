@extends('layouts.app')
@section('title')Customer Bookings Overview  @endsection
@section('content')
    <div class="gap gap-small"></div>
    <div class="container">
        <h1 class="page-title">Travel Profile</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <aside class="user-profile-sidebar">
                    <div class="user-profile-avatar text-center">
                        <img src="img/amaze_300x300.jpg" alt="Image Alternative text" title="AMaze" />
                        <h5>John Doe</h5>
                        <p>Member Since May 2012</p>
                    </div>
                    <ul class="list user-profile-nav">
                        <li><a href="user-profile.html"><i class="fa fa-user"></i>Overview</a>
                        </li>
                        <li><a href="user-profile-settings.html"><i class="fa fa-cog"></i>Settings</a>
                        </li>
                        <li><a href="user-profile-photos.html"><i class="fa fa-camera"></i>My Travel Photos</a>
                        </li>
                        <li><a href="user-profile-booking-history.html"><i class="fa fa-clock-o"></i>Booking History</a>
                        </li>
                        <li><a href="user-profile-cards.html"><i class="fa fa-credit-card"></i>Credit/Debit Cards</a>
                        </li>
                        <li><a href="user-profile-wishlist.html"><i class="fa fa-heart-o"></i>Wishlist</a>
                        </li>
                    </ul>
                </aside>
            </div>
            <div class="col-md-9">
                <h4>Total Traveled</h4>
                <ul class="list list-inline user-profile-statictics mb30">
                    <li><i class="fa fa-dashboard user-profile-statictics-icon"></i>
                        <h5>12540</h5>
                        <p>Miles</p>
                    </li>
                    <li><i class="fa fa-globe user-profile-statictics-icon"></i>
                        <h5>2%</h5>
                        <p>World</p>
                    </li>
                    <li><i class="fa fa-building-o user-profile-statictics-icon"></i>
                        <h5>15</h5>
                        <p>Cityes</p>
                    </li>
                    <li><i class="fa fa-flag-o user-profile-statictics-icon"></i>
                        <h5>3</h5>
                        <p>Countries</p>
                    </li>
                    <li><i class="fa fa-plane user-profile-statictics-icon"></i>
                        <h5>20</h5>
                        <p>Trips</p>
                    </li>
                </ul>
                <div id="map-canvas" style="width:100%; height:400px;"></div>
            </div>
        </div>
    </div>
    <div class="gap"></div>
    @endsection