@extends('layouts.app')
@section('title') Flight Deals @endsection
@section('activeFlight')  active @endsection
@section('loadingOverlay')
    @include('partials.flightSearchOverlay')
@endsection
@section('activeFlight')  active @endsection
@section('content')
    <div class="gap gap-small"></div>
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="active">Top Flight Deals</li>
        </ul>
        <h3 class="booking-title">Want a search of your choice ? <big><a class="popup-text" href="#flight-search-dialog" data-effect="mfp-zoom-out"> Click Here</a></big></h3>

        <div class="row">
            <div class="col-md-12">
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
                                    {{--<ul class="icon-group text-tiny text-color">--}}
                                        {{--<li><i class="fa fa-star-o"></i>--}}
                                        {{--</li>--}}
                                        {{--<li><i class="fa fa-star-o"></i>--}}
                                        {{--</li>--}}
                                        {{--<li><i class="fa fa-star-o"></i>--}}
                                        {{--</li>--}}
                                        {{--<li><i class="fa fa-star-o"></i>--}}
                                        {{--</li>--}}
                                        {{--<li><i class="fa fa-star-o"></i>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                    <h5 class="thumb-title"><a class="text-darken">Not available</a></h5>
                                    <p class="mb0"><small><i class="fa fa-map-marker"></i> There are no flight packages available at the moment. Please check back some other time</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($flights as $flight)
                            <div class="col-md-3 page-content-1">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img" href="{{url('/flight-details/'.$flight->id.'/'.$flight->package_name)}}">
                                            @if(isset(App\Gallery::getGalleryByPackageId($flight->id)[0]))
                                                <img src="{{asset(App\Gallery::getGalleryByPackageId($flight->id)[0]['image_path'])}}" style="height: 100%; width:100%" alt="{{$flight->package_name}}" title="{{$flight->package_name}}" />
                                            @else
                                                <img src="{{asset('images/gallery/packages/no-image.jpg')}}" alt="{{$flight->package_name}}" style="height:100%; width: 100%;" title="{{$flight->package_name}}" />
                                            @endif
                                            <h5 class="hover-title-center">Book Now</h5>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        {{--<ul class="icon-group text-tiny text-color">--}}
                                            {{--<li><i class="fa fa-star"></i>--}}
                                            {{--</li>--}}
                                            {{--<li><i class="fa fa-star"></i>--}}
                                            {{--</li>--}}
                                            {{--<li><i class="fa fa-star"></i>--}}
                                            {{--</li>--}}
                                            {{--<li><i class="fa fa-star"></i>--}}
                                            {{--</li>--}}
                                            {{--<li><i class="fa fa-star"></i>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                        <h5 class="thumb-title"><a class="text-darken" href="{{url('/flight-details/'.$flight->id.'/'.$flight->package_name)}}">{{$flight->package_name}}</a></h5>
                                        {{--<p class="mb0"><small><i class="fa fa-map-marker"></i> {{$flight->package_location}}</small>--}}
                                        {{--</p>--}}
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