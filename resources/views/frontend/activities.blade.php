@extends('layouts.app')
@section('title') Activities and attractions @endsection
@section('activeActivity')  active @endsection
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="active">Top Activities</li>
        </ul>
        <div class="gap gap-small"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="row row-wrap page-content">
                    @foreach($activities as $activity => $i)
                    <div class="col-md-3 page-content-1">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="{{url('/package-attraction-details/'.$i)}}">
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
                                <h5 class="thumb-title"><a class="text-darken" href="{{url('/flight-details')}}">{{$activity->package_name}}</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> {{$activity->package_location}}</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color"><small >from</small> &#x20A6;{{number_format($activity->adult_price,2)}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{$activities->links()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection