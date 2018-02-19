@extends('layouts.app')

@section('title') Top Hotels Deals   @endsection
@section('activeHotel') active @endsection
@section('loadingOverlay')
    @include('partials.hotelSearchOverlay')
@endsection
@section('content')

    {{--<div class="container">--}}
        {{--<h1 class="page-title">Search Hotels</h1>--}}
    {{--</div>--}}




    <div class="container">
        {{--<form class="booking-item-dates-change mb40">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="form-group form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-hightlight"></i>--}}
                        {{--<label>Where</label>--}}
                        {{--<input class="typeahead form-control destination_city" value="" placeholder="City, Hotel Name or U.S. Zip Code" type="text" />--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="input-daterange" data-date-format="MM d, D">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-6">--}}
                                {{--<div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>--}}
                                    {{--<label>Check in</label>--}}
                                    {{--<input class="form-control checkin_date" name="start" type="text" />--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>--}}
                                    {{--<label>Check out</label>--}}
                                    {{--<input class="form-control checkout_date" name="end" type="text" />--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-6">--}}
                            {{--<div class="form-group form-group- form-group-select-plus">--}}
                                {{--<label>Guests</label>--}}
                                {{--<select class="form-control guests">--}}
                                    {{--<option value="1">1</option>--}}
                                    {{--<option value="2">2</option>--}}
                                    {{--<option value="3">3</option>--}}
                                    {{--<option value="4">4</option>--}}
                                    {{--<option value="5">5</option>--}}
                                    {{--<option value="6">6</option>--}}
                                    {{--<option value="7">7</option>--}}
                                    {{--<option value="8">8</option>--}}
                                    {{--<option value="9">9</option>--}}
                                    {{--<option value="10">10</option>--}}
                                    {{--<option value="11">11</option>--}}
                                    {{--<option value="12">12</option>--}}
                                    {{--<option value="13">13</option>--}}
                                    {{--<option value="14">14</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6">--}}
                            {{--<div class="form-group form-group-select-plus">--}}
                                {{--<label>&nbsp;</label>--}}
                                {{--<button type="button" class="btn btn-primary search_hotel">Search Hotel</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</form>--}}
        <div class="gap gap-small"></div>
        <h3 class="mb20">Top Hotel Deals</h3>
        <div class="row row-wrap">
            @foreach($hotel_packages as $hotel_package)
            <div class="col-md-3">
                <div class="thumb">
                    <header class="thumb-header">
                        <a class="hover-img" href="{{url('/hotel-details/'.$hotel_package->id.'/'.$hotel_package->name)}}">
                            @if(isset(App\Gallery::getGalleryByPackageId($hotel_package->id)[0]))

                                <img src="{{asset(App\Gallery::getGalleryByPackageId($hotel_package->id)[0]['image_path'])}}" style="width: 100%; height: 250px;" alt="{{$hotel_package->name}}" title="{{$hotel_package->name}}" />
                            @else
                                <img src="{{asset('images/gallery/packages/no-image.jpg')}}" alt="{{$hotel_package->name}}" style="width: 100%; height: 250px;" title="{{$hotel_package->name}}" />
                            @endif
                                <h5 class="hover-title-center">Book Now</h5>
                        </a>
                    </header>
                    <div class="thumb-caption">
                        <ul class="icon-group text-tiny text-color">
                            @for($i = 0; $i < \App\HotelDeal::getByPackageId($hotel_package->id)->star_rating; $i++)
                                <li><i class="fa fa-star"></i>
                                </li>
                                @endfor
                                @for($i = 0; $i < (5 - \App\HotelDeal::getByPackageId($hotel_package->id)->star_rating); $i++)
                                    <li><i class="fa fa-star-o"></i>
                                    </li>
                                @endfor
                        </ul>
                        <h5 class="thumb-title"><a class="text-darken" href="#">{{\App\HotelDeal::getByPackageId($hotel_package->id)->name}}</a></h5>
                        <p class="mb0"><small><i class="fa fa-map-marker"></i> {{\App\HotelDeal::getByPackageId($hotel_package->id)->city}}</small>
                        </p>
                        <p class="mb0 text-darken"><small>from</small> <span class="text-lg lh1em text-color">&#x20A6;{{number_format($hotel_package->adult_price, 2)}}</span>
                        </p>
                    </div>
                </div>
            </div>
                @endforeach

        </div>
        <div class="gap gap-small"></div>
    </div>

@endsection