@extends('layouts.app')
@section('title') Flight Deals @endsection
@section('activeFlight')  active @endsection
@section('loadingOverlay')
    @include('partials.flightSearchOverlay')
@endsection
@section('activeFlight')  active @endsection
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="active">Top Flight Deals</li>
        </ul>
        <h3 class="booking-title">Find a cheap flight to your destination </h3>
         <div class="row">
             <div class="col-md-12">
                 <form class="booking-item-dates-change mb40">
                     <div class="tabbable">
                         <ul class="nav nav-pills nav-sm nav-no-br mb10" id="flightChooseTab">
                             <li class="active"><a href="#flight-search-1" data-toggle="tab" class="trip_type">Round Trip</a>
                             </li>
                             <li><a href="#flight-search-2" data-toggle="tab" class="trip_type">One Way</a>
                             </li>
                             <li><a data-toggle="tab" class="popup-text trip_type" href="#multi-city-dialog" data-effect="mfp-zoom-out">Multi City</a>
                             </li>
                         </ul>
                         <div class="tab-content">
                             <input type="hidden" class="flight_type" value="Round Trip"/>
                             <div class="tab-pane fade in active" id="flight-search-1">
                                 <div class="row">
                                     <div class="col-md-5">
                                         <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                             <label>From</label>
                                             <input class="typeahead form-control" id="departure_airport" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                                         </div>
                                     </div>
                                     <div class="col-md-5">
                                         <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                             <label>To</label>
                                             <input class="typeahead form-control" id="arrival_airport" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                                         </div>
                                     </div>
                                     <div class="col-md-2">
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
                                                 <label>Adults <small>12 years +</small></label>
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
                                                 <label>Children <small>2 - 11 years</small></label>
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
                                                 <label>Infants <small>below 2 years</small></label>
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
                             <div class="tab-pane fade" id="flight-search-3">
                                 <div class="row destination_1">
                                     <div class="col-md-4">
                                         <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                             <label>From</label>
                                             <input class="typeahead form-control departure_airport_multi" id="" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                                         </div>
                                     </div>
                                     <div class="col-md-4">
                                         <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                             <label>To</label>
                                             <input class="typeahead form-control arrival_airport_multi" id="arrival_airport" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                                         </div>
                                     </div>
                                     <div class="col-md-3">
                                         <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                             <label>Departure Date</label>
                                             <input class="form-control departure_date_multi multi-datepicker" value="" name="start" type="text" />
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-4">
                                         <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                             <label>From</label>
                                             <input class="typeahead form-control departure_airport_multi" id="" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                                         </div>
                                     </div>
                                     <div class="col-md-4">
                                         <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                             <label>To</label>
                                             <input class="typeahead form-control arrival_airport_multi" id="arrival_airport" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                                         </div>
                                     </div>
                                     <div class="col-md-3">
                                         <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                             <label>Departure Date</label>
                                             <input class="form-control departure_date_multi multi-datepicker" value="" name="start" type="text" />
                                         </div>
                                     </div>
                                     <div class="col-md-1">
                                         <div class="form-group form-group-lg form-group-icon-left">
                                             <i class="fa fa-times-circle input-icon"></i>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-4">
                                         <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                             <label>From</label>
                                             <input class="typeahead form-control departure_airport_multi" id="" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                                         </div>
                                     </div>
                                     <div class="col-md-4">
                                         <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                             <label>To</label>
                                             <input class="typeahead form-control arrival_airport_multi" id="arrival_airport" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                                         </div>
                                     </div>
                                     <div class="col-md-3">
                                         <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                             <label>Departure Date</label>
                                             <input class="form-control departure_date_multi multi-datepicker" value="" name="start" type="text" />
                                         </div>
                                     </div>
                                     <div class="col-md-1">
                                         <div class="form-group form-group-lg form-group-icon-left">
                                             <i class="fa fa-times-circle input-icon"></i>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-3">
                                         <button class="btn btn-group btn-primary-invert add-destination" type="button"><i class="fa fa-plus"></i> Add Destination</button>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-3">
                                         <div class="form-group form-group-lg form-group-select-plus">
                                             <label>Cabin Type</label>
                                             <select class="form-control cabin_type_multi">
                                                 <option selected="selected" value="Y">Economy</option>
                                                 <option value="S">Premium Economy</option>
                                                 <option value="C">Business</option>
                                                 <option value="J">Premium Business</option>
                                                 <option value="F">First</option>
                                                 <option value="P">Premium First</option>
                                             </select>
                                         </div>
                                     </div>
                                     <div class="col-md-3">
                                         <div class="form-group form-group-lg form-group-select-plus">
                                             <label>Adults <small>12 years +</small></label>
                                             <select class="form-control adult_passengers_multi">
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
                                             <select class="form-control child_passengers_multi">
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
                                             <select class="form-control infant_passengers_multi">
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
         </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Top Flight Deals</h3>
                <div class="row row-wrap page-content">
                    @if(!isset($flights[0]))
                        <div class="col-md-3 page-content-1">
                            <div class="thumb">
                                <header class="thumb-header">
                                    <a class="hover-img">
                                        <img src="{{asset('img/sorry.jpg')}}" style="height: 100%; width:100%" alt="No flight available" title="No flight available" />
                                        <h5 class="hover-title-center">Not available</h5>
                                    </a>
                                </header>
                                <div class="thumb-caption">
                                    <h5 class="thumb-title"><a class="text-darken">Not available</a></h5>
                                    <p class="mb0"><small><i class="fa fa-map-marker"></i> There are no flight packages available at the moment. Please check back some other time</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($flights as $flight)
                            {{--{{dd($flight)}}--}}
                            <div class="col-md-3 page-content-1">
                                <div class="thumb">
                                    <header class="thumb-header">
{{--                                        {{dd(\App\FlightDeal::getByPackageId($flight->id)->destination)}}--}}
                                        <a class="hover-img" href="{{url('/flight-details/'.$flight->id.'/'.$flight->name)}}">
                                                <img src="{{\App\Services\SabreConfig::cityImage(\App\Services\SabreConfig::iataCode(\App\FlightDeal::getByPackageId($flight->id)->destination))}}" alt="{{$flight->name}}" style="height:100%; width: 100%;" title="{{$flight->name}}" />
                                            <h5 class="hover-title-center">Book Now</h5>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h5 class="thumb-title"><a class="text-darken" href="{{url('/flight-details/'.$flight->id.'/'.$flight->name)}}">{{$flight->name}}</a></h5>
                                        <p class="mb0 text-darken"><span class="text-lg lh1em text-color"><small >from</small> &#x20A6;{{number_format($flight->adult_price,2)}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{$flights->links()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection