@extends('layouts.app')
@section('title') Flight Deals @endsection
@section('activeFlight')  active @endsection
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="active">Top Flight Deals</li>
        </ul>
        <h3 class="booking-title">530 things to do in New York on Mar 22 - Apr 17 <small><a class="popup-text" href="#flight-search-dialog" data-effect="mfp-zoom-out">Search Flight</a></small></h3>

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
                        <p>Not what you're looking for? <a class="popup-text" href="#flight-search-dialog" data-effect="mfp-zoom-out">Search for flights here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection