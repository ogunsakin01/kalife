@extends('layouts.app')
@section('title') Attractions @endsection
@section('activeAttraction')  active @endsection
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="active">Top Attractions</li>
        </ul>
        <div class="gap gap-small"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="row row-wrap page-content">
                    @if(!isset($attractions[0]))
                        <div class="col-md-3 page-content-1">
                            <div class="thumb">
                                <header class="thumb-header">
                                    <a class="hover-img">
                                            <img src="{{asset('img/sorry.jpg')}}" style="height: 100%; width:100%" alt="No attraction available" title="No attraction available" />
                                        <h5 class="hover-title-center">Not available</h5>
                                    </a>
                                </header>
                                <div class="thumb-caption">
                                    <ul class="icon-group text-tiny text-color">
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                        <li><i class="fa fa-star-o"></i>
                                        </li>
                                    </ul>
                                    <h5 class="thumb-title"><a class="text-darken">Not available</a></h5>
                                    <p class="mb0"><small><i class="fa fa-map-marker"></i> There are no attraction packages available at the moment. Please check back some other time</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($attractions as $attraction)
                            {{--<div class="col-md-3">--}}
                                {{--<div class="thumb">--}}
                                    {{--<a class="hover-img" href="{{url('/attraction-details/'.$attraction->id.'/'.$attraction->package_name)}}">--}}
                                        {{--@if(isset(App\Gallery::getGalleryByPackageId($attraction->id)[0]))--}}

                                            {{--<img src="{{asset(App\Gallery::getGalleryByPackageId($attraction->id)[0]['image_path'])}}" style="height: 100%; width:100%" alt="{{$attraction->package_name}}" title="{{$attraction->package_name}}" />--}}
                                        {{--@else--}}
                                            {{--<img src="{{asset('images/gallery/packages/no-image.jpg')}}" alt="{{$attraction->package_name}}" style="height:100%; width: 100%;" title="{{$attraction->package_name}}" />--}}
                                        {{--@endif--}}
                                        {{--<div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">--}}
                                            {{--<div class="text-small">--}}

                                                {{--<h5>{{$attraction->name}}</h5>--}}
                                                {{--<p class="mb0"><i class="fa fa-map-marker"></i>{{\App\Attraction::getByPackageId($attraction->id)->city}}</p>--}}
                                                {{--<p class="mb0">offer from &#x20A6;{{number_format($attraction->adult_price,2)}}</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-md-3 page-content-1">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img" href="{{url('/attraction-details/'.$attraction->id.'/'.$attraction->name)}}">
                                            @if(isset(App\Gallery::getGalleryByPackageId($attraction->id)[0]))

                                                <img src="{{asset(App\Gallery::getGalleryByPackageId($attraction->id)[0]['image_path'])}}" style="height: 100%; width:100%" alt="{{$attraction->name}}" title="{{$attraction->name}}" />
                                            @else
                                                <img src="{{asset('images/gallery/packages/no-image.jpg')}}" alt="{{$attraction->name}}" style="height:100%; width: 100%;" title="{{$attraction->name}}" />
                                            @endif
                                            <h5 class="hover-title-center">Book Now</h5>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h5 class="thumb-title"><a class="text-darken" href="{{url('/attraction-details/'.$attraction->id.'/'.$attraction->name)}}">{{$attraction->name}}</a></h5>
                                        <p class="mb0"><small><i class="fa fa-map-marker"></i> {{\App\Attraction::getByPackageId($attraction->id)->city}}</small>
                                        </p>
                                        <p class="mb0 text-darken"><span class="text-lg lh1em text-color"><small >from</small> &#x20A6;{{number_format($attraction->adult_price,2)}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{$attractions->links()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection