@extends('layouts.app')
@section('title')Available flights @endsection
@section('activeFlight')
   class='active'
@endsection
@section('content')
    <pre>
        {{var_dump($flightsResult),die}}
        {{--{{dd($airlines)}}--}}
        </pre>
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a>
            </li>
            <li class="active">{{session()->get('flightSearchParam')->original['arrival_airport']}}</li>
        </ul>
        <div class="mfp-with-anim mfp-hide mfp-dialog mfp-search-dialog" id="search-dialog">
            <h3>Search for Flight</h3>
            <form>
                <div class="tabbable">
                    <ul class="nav nav-pills nav-sm nav-no-br mb10" id="flightChooseTab">
                        <li class="active"><a href="#flight-search-1" data-toggle="tab" class="trip_type">Round Trip</a>
                        </li>
                        <li><a href="#flight-search-2" data-toggle="tab" class="trip_type">One Way</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <input type="hidden" class="flight_type" value="Round Trip"/>
                        <div class="tab-pane fade in active" id="flight-search-1">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                        <label>From</label>
                                        <input class="typeahead form-control" id="departure_airport" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                        <label>To</label>
                                        <input class="typeahead form-control" id="arrival_airport" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-lg form-group-select-plus">
                                        <label>Cabin Type</label>
                                        <select class="form-control cabin_type">
                                            <option selected="selected" value="Y">Economy</option>
                                            <option value="S">Premium Economy</option>
                                            <option value="C">Business</option>
                                            <option value="J">Premium Business</option>
                                            <option value="F">First</option>
                                            <option value="P">Premium First</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input-daterange" data-date-format="M d, D">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                            <label>Departing</label>
                                            <input class="form-control departure_date" value="" name="start" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                            <label>Returning</label>
                                            <input class="form-control return_date" value="" name="end" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group form-group-lg form-group-select-plus">
                                            <label>Adults </label>
                                            <select class="form-control adult_passengers">
                                                <option selected="selected" value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group form-group-lg form-group-select-plus">
                                            <label>Children </label>
                                            <select class="form-control child_passengers">
                                                <option value="0" selected="selected">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group form-group-lg form-group-select-plus">
                                            <label>Infants </label>
                                            <select class="form-control infant_passengers">
                                                < <option value="0" selected="selected">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="flight-search-2">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                        <label>From</label>
                                        <input class="typeahead form-control" id="departure_airport_one" placeholder="City, Airport, U.S. Zip" value="" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                        <label>To</label>
                                        <input class="typeahead form-control" id="arrival_airport_one" placeholder="City, Airport, U.S. Zip" value="" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-lg form-group-select-plus">
                                        <label>Cabin Type</label>
                                        <select class="form-control cabin_type_one">
                                            <option selected="selected" value="Y">Economy</option>
                                            <option value="S">Premium Economy</option>
                                            <option value="C">Business</option>
                                            <option value="J">Premium Business</option>
                                            <option value="F">First</option>
                                            <option value="P">Premium First</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                        <label>Departing</label>
                                        <input class="date-pick form-control departure_date_one" data-date-format="M d, D" value="" type="text" />
                                    </div>
                                </div>
                                <input type="hidden" class="arrival_date_one" value=""/>
                                <div class="col-md-3">
                                    <div class="form-group form-group-lg form-group-select-plus">
                                        <label>Adults <small>12 years +</small></label>
                                        <select class="form-control adult_passengers_one">
                                            <option selected="selected" value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-lg form-group-select-plus">
                                        <label>Children <small>2 - 11 years</small></label>
                                        <select class="form-control child_passengers_one">
                                            <option value="0" selected="selected">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-lg form-group-select-plus">
                                        <label>Infants <small>below 2 years</small></label>
                                        <select class="form-control infant_passengers_one">
                                            < <option value="0" selected="selected">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-lg search_flight" type="button">Search for Flights</button>
            </form>
        </div>
        <h3 class="booking-title">{{count($flightsResult)}} Flights from {{session()->get('flightSearchParam')->original['departure_airport']}} to {{session()->get('flightSearchParam')->original['arrival_airport']}} on {{date('D, M d',strtotime(session()->get('flightSearchParam')->original['departure_date']))}} for {{session()->get('flightSearchParam')->original['adult_passengers']}} adult(s),{{session()->get('flightSearchParam')->original['child_passengers']}} children and {{session()->get('flightSearchParam')->original['infant_passengers']}} infant(s) <small><a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">Change search</a></small></h3>
        <div class="row">
            <div class="col-md-3">
                <aside class="booking-filters text-white">
                    <h3>Filter By:</h3>
                    <ul class="list booking-filters-list">
                        <li>
                            <h5 class="booking-filters-title">Stops <small>Price from</small></h5>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Non-stop<span class="pull-right">$215</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />1 Stop<span class="pull-right">$154</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />2+ Stops<span class="pull-right">$197</span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <h5 class="booking-filters-title">Price </h5>
                            <input type="text" id="price-slider">
                        </li>
                        <li>
                            <h5 class="booking-filters-title">Flight Class <small>Price from</small></h5>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Economy<span class="pull-right">$154</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Business<span class="pull-right">$316</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />First<span class="pull-right">$450</span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <h5 class="booking-filters-title">Airlines <small>Price from</small></h5>
                            @foreach($airlines as $i => $airline)
                                <div class="checkbox">
                                    <label>
                                        <input class="i-check airline_filter" value="{{$airline}}" type="checkbox" />{{\App\Airline::getAirline($airline)}}<span class="pull-right">$215</span>
                                    </label>
                                </div>
                                @endforeach

                        </li>
                        <li>
                            <h5 class="booking-filters-title">Departure Time</h5>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Morning (5:00a - 11:59a)</label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Afternoon (12:00p - 5:59p)</label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Evening (6:00p - 11:59p)</label>
                            </div>
                        </li>
                    </ul>
                </aside>
            </div>
            <div class="col-md-9">
                <div class="nav-drop booking-sort">
                    <h5 class="booking-sort-title"><a href="#">Sort: Sort: Price (low to high)<i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></a></h5>
                    <ul class="nav-drop-menu">
                        <li><a href="#">Price (high to low)</a>
                        </li>
                        <li><a href="#">Duration</a>
                        </li>
                        <li><a href="#">Stops</a>
                        </li>
                        <li><a href="#">Arrival</a>
                        </li>
                        <li><a href="#">Departure</a>
                        </li>
                    </ul>
                </div>
                <ul class="booking-list">
                    @foreach($flightsResult as $i => $flight)
                                                <li class="{{$flight[0]['airline']}} {{"price_".$flight[0]['totalPrice']}} {{"stop_".$flight[0]['stops']}}">
                        <div class="booking-item-container">
                            <div class="booking-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-airline-logo">
                                            <img src="{{\App\Services\SabreFlight::airlineImage($flight[0]['airline'])}}" class="img-responsive" alt="{{$flight[0]['airline']}}" title="Image Title" />
                                            <p>{{\App\Airline::getAirline($flight[0]['airline'])}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
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
                                    <div class="col-md-3"><span class="booking-item-price">&#x20A6; {{number_format($flight[0]['totalPrice'])}}</span>
                                        <p class="booking-item-flight-class">Class: Economy</p><a class="btn btn-primary" href="#">Select</a>&nbsp;<a class="btn btn-primary"><i class="fa fa-info-circle"></i> Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-item-details">
                                <div class="row">
                                    @foreach($flight[1] as $originDestination => $originDest)
                                    <div class="col-md-6">
                                        <p>Flight(s) Details</p>
                                        @foreach($originDest as $segmentInfo => $segment)
                                        <h5 class="list-title">{{\App\Airport::getCity($segment['departureAirport'])}} ({{$segment['departureAirport']}}) to {{\App\Airport::getCity($segment['arrivalAirport'])}} ({{$segment['arrivalAirport']}})</h5>
                                        <ul class="list">
                                            <li>{{\App\Airline::getAirline($segment['operatingAirline'])}} <b>{{$segment['operatingAirline']}} - {{$segment['flightNumber']}}</b></li>
                                            <li>{{\App\Services\SabreFlight::cabinType(session()->get('flightSearchParam')->original['cabin_type'])}} ({{session()->get('flightSearchParam')->original['cabin_type']}}), {{\App\Equipment::getEquipment($segment['equipment'])}}</li>
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
                <p class="text-right">Not what you're looking for? <a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">Try your search again</a>
                </p>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection