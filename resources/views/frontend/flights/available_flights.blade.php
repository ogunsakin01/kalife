@extends('layouts.app')
@section('title')Available flights @endsection
@section('loadingOverlay')
    @include('partials.flightSearchOverlay')
    @include('partials.flightPricingOverlay')
@endsection
@section('activeFlight')  active @endsection
@section('content')
    <div class="gap gap-small"></div>
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a>
            <li>{{session()->get('flightSearchParam')['flight_type']}}</li>
            </li>
            <li class="active">{{session()->get('flightSearchParam')['departure_airport']}}</li>
            <li class="active">{{session()->get('flightSearchParam')['arrival_airport']}}</li>
        </ul>

        <h3 class="booking-title">{{count($flightsResult)}} Flights from {{session()->get('flightSearchParam')['departure_airport']}} to {{session()->get('flightSearchParam')['arrival_airport']}} on {{date('D, M d',strtotime(session()->get('flightSearchParam')['departure_date']))}} for {{session()->get('flightSearchParam')['adult_passengers']}} adult(s),{{session()->get('flightSearchParam')['child_passengers']}} children and {{session()->get('flightSearchParam')['infant_passengers']}} infant(s) <small><a class="popup-text" href="#flight-search-dialog" data-effect="mfp-zoom-out">Change search</a></small></h3>
        <div class="row">
            <div class="col-md-3">
                <aside class="booking-filters text-white">
                    <h3>Filter By:  <small><i class="to_spin"></i></small></h3>
                    <ul class="list booking-filters-list">
                        <li>
                            <div class="checkbox">
                                <label class="stopover">
                                    <input class="all_check all_flights" checked="checked" type="checkbox" /> All Available Flights ({{count($flightsResult)}})
                                </label>
                            </div>
                        </li>
                        <li>
                            <h5 class="booking-filters-title">Stops <small>Price from</small></h5>
                            <div class="checkbox">
                                <label class="stopover">
                                    <input class="all_check stops" type="checkbox" value="0" />Non-stop ({{\App\Services\SabreFlight::minimumPrice('stops','0',$flightsResult)['number']}})<span class="pull-right">&#x20A6; {{number_format(\App\Services\SabreFlight::minimumPrice('stops','0',$flightsResult)['minimumPrice'])}}</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label class="stopover">
                                    <input class="all_check stops" type="checkbox" value="1" />1 Stop ({{\App\Services\SabreFlight::minimumPrice('stops','1',$flightsResult)['number']}})<span class="pull-right">&#x20A6; {{number_format(\App\Services\SabreFlight::minimumPrice('stops','1',$flightsResult)['minimumPrice'])}}</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label class="stopover">
                                    <input class="all_check stops" type="checkbox" value="2" />2 Stops ({{\App\Services\SabreFlight::minimumPrice('stops','2',$flightsResult)['number']}})<span class="pull-right">&#x20A6; {{number_format(\App\Services\SabreFlight::minimumPrice('stops','2',$flightsResult)['minimumPrice'])}}7</span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <h5 class="booking-filters-title">Airlines <small>Price from</small></h5>
                            @foreach($airlines as $i => $airline)
                                <div class="checkbox">
                                    <label class="airline">
                                        <input class="all_check selected_airline" value="{{$airline}}" type="checkbox" />{{\App\Airline::getAirline($airline)}} ({{\App\Services\SabreFlight::minimumPrice('airline',$airline,$flightsResult)['number']}})<span class="pull-right">&#x20A6; {{number_format(\App\Services\SabreFlight::minimumPrice('airline',$airline,$flightsResult)['minimumPrice'])}}</span>
                                    </label>
                                </div>
                                @endforeach

                        </li>
                    </ul>
                </aside>
            </div>
            <div class="col-md-9">
                <ul class="booking-list">
                    @foreach($flightsResult as $i => $flight)
                                                <li class="flights_{{$flight[0]['airline']}} {{"flights_".$flight[0]['totalPrice']}} {{"flights_".$flight[0]['stops']}} flights">
                        <div class="booking-item-container">
                            <div class="booking-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-airline-logo">
                                            <img src="{{\App\Services\SabreFlight::airlineImage($flight[0]['airline'])}}" class="img-responsive" alt="{{$flight[0]['airline']}}" title="Image Title" />
                                            <p>{{\App\Airline::getAirline($flight[0]['airline'])}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5>{{date('g:i A',strtotime($flight[1][0][0]['departureDateTime']))}}</h5>
                                                <p class="booking-item-date">{{date('D, M d',strtotime($flight[1][0][0]['departureDateTime']))}}</p>
                                                <p class="booking-item-destination">{{\App\Airport::getCity($flight[1][0][0]['departureAirport'])}}({{$flight[1][0][0]['departureAirport']}})</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5>{{date('g:i A',strtotime($flight[1][0][0]['arrivalDateTime']))}}</h5>
                                                <p class="booking-item-date">{{date('D, M d',strtotime($flight[1][0][0]['arrivalDateTime']))}}</p>
                                                <p class="booking-item-destination">{{\App\Airport::getCity($flight[1][0][0]['arrivalAirport'])}}({{$flight[1][0][0]['arrivalAirport']}})</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>{{$flight[1][0][0]['timeDuration']}}</h5>
                                        <p>{{$flight[0]['stops']}} stop(s)</p>
                                    </div>
                                    <div class="col-md-4"><span class="booking-item-price">&#x20A6; {{number_format($flight[0]['adminToUserSumTotal'])}}</span>
                                        <p class="booking-item-flight-class">Class: {{\App\Services\SabreFlight::cabinType(session()->get('flightSearchParam')['cabin_type'])}}</p><button class="btn btn-primary"><i class="fa fa-info-circle"></i> Details</button>&nbsp; <button class="btn btn-primary itinerary_select" type="button" value="{{$i}}" {{--href="{{url($i.'/flight-booking-details')}}"--}}> Select <i class="fa fa-plane"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-item-details">
                                <div class="row">
                                    @foreach($flight[1] as $originDestination => $originDest)
                                    <div class="col-md-6">
                                        <p>Trip (Flights (s)) Details</p>
                                        @foreach($originDest as $segmentInfo => $segment)
                                        <h5 class="list-title">{{\App\Airport::getCity($segment['departureAirport'])}} ({{$segment['departureAirport']}}) to {{\App\Airport::getCity($segment['arrivalAirport'])}} ({{$segment['arrivalAirport']}})</h5>
                                        <ul class="list">
                                            <li>{{\App\Airline::getAirline($segment['operatingAirline'])}} <b>{{$segment['operatingAirline']}} - {{$segment['flightNumber']}}</b></li>
                                            <li>{{\App\Services\SabreFlight::cabinType(session()->get('flightSearchParam')['cabin_type'])}} ({{session()->get('flightSearchParam')['cabin_type']}}), {{\App\Equipment::getEquipment($segment['equipment'])}}</li>
                                            <li><b>Depart</b> {{date('g:i A D, M d',strtotime($segment['departureDateTime']))}} <b>Arrive</b> {{date('g:i A D, M d',strtotime($segment['arrivalDateTime']))}}</li>
                                            <li><b>Duration</b>: {{$segment['timeDuration']}}</li>
                                        </ul>
                                       @endforeach
                                    </div>
                                   @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach

                </ul>
                <p class="text-right">Not what you're looking for? <a class="popup-text" href="#flight-search-dialog" data-effect="mfp-zoom-out">Try your search again</a>
                </p>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection
@section('timeoutScript')
    @include('partials.timeout')
    @endsection