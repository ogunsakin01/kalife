@extends('layouts.app')
@section('title') Flight Deals @endsection
@section('activeFlight')  active @endsection
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="active">Top Flight Deals</li>
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
        <h3 class="booking-title">530 things to do in New York on Mar 22 - Apr 17 <small><a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">Search Flight</a></small></h3>

        <div class="row">
            <div class="col-md-12">
                {{--php artisian serve--}}
                <div class="row row-wrap page-content">
                    <div class="col-md-3 page-content-1">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="{{url('/flight-details')}}">
                                    <img src="img/new_york_at_an_angle_800x600.jpg" alt="Image Alternative text" title="new york at an angle" />
                                    <h5 class="hover-title-center">Book Now</h5>
                                </a>
                            </header>
                            <div class="thumb-caption">
                                <ul class="icon-group text-tiny text-color">
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                </ul>
                                <h5 class="thumb-title"><a class="text-darken" href="{{url('/flight-details')}}">Manhattan Skyline</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> Queens (LaGuardia Airport (LGA))</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color"><small >from</small> Free</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><small>530 things to do in New York. &nbsp;&nbsp;Showing 1 – 15</small>
                        </p>
                        <ul class="pagination">
                            <li class="active"><a href="#">1</a>
                            </li>
                            <li><a href="#">2</a>
                            </li>
                            <li><a href="#">3</a>
                            </li>
                            <li><a href="#">4</a>
                            </li>
                            <li><a href="#">5</a>
                            </li>
                            <li><a href="#">6</a>
                            </li>
                            <li><a href="#">7</a>
                            </li>
                            <li class="dots">...</li>
                            <li><a href="#">43</a>
                            </li>
                            <li class="next"><a href="#">Next Page</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 text-right">
                        <p>Not what you're looking for? <a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">Search for flights here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection