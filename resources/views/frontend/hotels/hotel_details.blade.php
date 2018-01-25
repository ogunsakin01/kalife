@extends('layouts.app')
@section('title') {{$name}} {{$hotel->name}} details  @endsection
@section('activeHotel') active @endsection
@section('loadingOverlay')
    @include('partials.hotelSearchOverlay')
@endsection
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a>
            </li>
            <li><a href="{{url('/hotels')}}">Hotels</a>
            </li>
            <li><a href="#">{{\App\PackageCategory::find($hotel_info->category_id)->category}}</a>
            </li>
            <li class="active"><a>{{$name}}</a>
            </li>
        </ul>
        <div class="booking-item-details">
            <header class="booking-item-header">
                <div class="row">
                    <div class="col-md-9">
                        <h2 class="lh1em">{{$hotel->name}} <small>{{$name}}</small></h2>

                        <p class="lh1em text-small"><i class="fa fa-map-marker"></i> {{\App\HotelDeal::getByPackageId($hotel_info->id)->city}}&nbsp;&nbsp;&nbsp; ({{\App\HotelDeal::getByPackageId($hotel_info->id)->address}})</p>
                        <ul class="list list-inline text-small">
                            <li><i class="fa fa-phone"></i> {{$hotel_info->phone_number}}</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p class="booking-item-header-price"><small>price from</small>  <span class="text-lg"> &#x20A6;{{number_format($hotel_info->adult_price)}}</span>
                        </p>
                    </div>
                </div>
            </header>
            <div class="row">
                <div class="col-md-7">
                    <div class="tabbable booking-details-tabbable">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-camera"></i>Photos</a>
                            </li>
                            <li><a href="#google-map-tab" data-toggle="tab"><i class="fa fa-map-marker"></i>On the Map</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab-1">
                                <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">
                                    @if(isset($images[0]))
                                        @foreach($images as $image)
                                            <img src="{{asset($image['image_path'])}}" alt="{{"Why"}}" style="width:100%; height: 100%" title="{{$name}}"/>
                                        @endforeach
                                    @else
                                        <img src="{{asset('images/gallery/packages/no-image.jpg')}}"  alt="No image available for this hotel" title="No image available for this hotel" />
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="google-map-tab">
                                <div id="map-canvas" style="width:100%; height:500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="booking-item-meta">
                        <h2 class="lh1em mt40">{{\App\PackageCategory::find($hotel_info->category_id)->category}}</h2>
                        <h3>Kalife <small > recommends</small></h3>
                        <div class="booking-item-rating">
                            <ul class="icon-list icon-group booking-item-rating-stars">
                                @for($i = 0; $i < $hotel->star_rating; $i++)
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                @endfor
                                @for($i = 0; $i < (5 - $hotel->star_rating); $i++)
                                    <li><i class="fa fa-star-o"></i>
                                    </li>
                                @endfor
                            </ul><span class="booking-item-rating-number"><b > {{$hotel->star_rating}} </b> of 5 <small class="text-smaller"></small></span>
                            <p><a class="text-default" href="#">Kalife Travel and Tours Hotel Rating</a>
                            </p>
                        </div>
                    </div>
                    <div class="gap gap-small">
                        <h4>Package Information</h4>
                        <p>{{substr($hotel_info->information, 325)}}</p>
                    </div>
                    <a href="{{url('/book-package/'.$id.'/'.$name)}}" class="btn btn-primary btn-lg">Book hotel</a>
                </div>
            </div>
        </div>
        <div class="row row-wrap">
            <div class="col-md-12">
                <h4>Hotel Details</h4>
                <p>{{$hotel->information}}</p>
            </div>

        </div>
        <div class="gap"></div>



        <div class="gap gap-small"></div>

    </div>
    <script>
        var customLatitude = '6.45407';
        var customLongitude = '3.39467';
    </script>
@endsection