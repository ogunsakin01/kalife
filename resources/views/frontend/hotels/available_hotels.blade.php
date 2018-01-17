@extends('layouts.app')
@section('title')Available Hotels  @endsection
@section('activeHotel') active @endsection
@section('loadingOverlay')
    @include('partials.hotelSearchOverlay')
    @include('partials.hoteldescriptionOverlay')
@endsection
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a>
            </li>
            <li><a href="#">Hotels</a>
            </li>
            <li class="active">{{$hotelSearchParam['city']}} Hotels</li>
        </ul>
        <div class="gap gap-small"></div>
        <h3 class="booking-title">{{count($hotels)}} hotels in {{$hotelSearchParam['city']}} on {{date('M d',strtotime($hotelSearchParam['checkin_date']))}} - {{date('M d',strtotime($hotelSearchParam['checkout_date']))}} for {{$hotelSearchParam['guests']}} guest</h3>
        <form class="booking-item-dates-change mb40">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-hightlight"></i>
                        <label>Where</label>
                        <input class="typeahead form-control destination_city" value="" placeholder="City, Hotel Name or U.S. Zip Code" type="text" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-daterange" data-date-format="MM d, D">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                    <label>Check in</label>
                                    <input class="form-control checkin_date" name="start" type="text" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                    <label>Check out</label>
                                    <input class="form-control checkout_date" name="end" type="text" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group- form-group-select-plus">
                                <label>Guests</label>
                                <select class="form-control guests">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-select-plus">
                                <label>&nbsp;</label>
                             <button type="button" class="btn btn-primary search_hotel">Search Hotel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-3">
                <aside class="booking-filters text-white">
                    <h3>Filter By:</h3>
                    <ul class="list booking-filters-list">
                        <li>
                            <h5 class="booking-filters-title">Filter</h5>
                                <div class="checkbox">
                                    <label>
                                        <input class="hotel_filter all-available" value="all-hotel" type="checkbox" /> All Hotels
                                    </label>
                                </div>
                        </li>
                        <li>
                            <h5 class="booking-filters-title">Star Rating</h5>
                            @foreach($ratings as $i => $rating)
                            <div class="checkbox">
                                <label>
                                    <input class="hotel_filter" value="{{$i}}" type="checkbox" /> {{$i}} star(s)   ({{$rating}})
                                </label>
                            </div>
                                @endforeach
                        </li>
                        <li>
                            <h5 class="booking-filters-title">Facility</h5>
                            @foreach($amenities as $j => $amenity)
                            <div class="checkbox">
                                <label>
                                    <input class="hotel_filter" value="{{$j}}" type="checkbox" />{{$j}} ({{$amenity}})
                                </label>
                            </div>
                                @endforeach
                        </li>
                    </ul>
                </aside>
            </div>
            <div class="col-md-9">
                <ul class="booking-list">
                    @foreach($hotels as $k => $hotel)
                    <li class="all-hotels {{$hotel['hotelAmenity']}} {{$hotel['starRating']}}">
                        <a class="booking-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="booking-item-img-wrap">
                                        <img src="https://photo.hotellook.com/image_v2/limit/h{{$hotel['hotelCode']}}_1/640/480.jpg" alt="Image Alternative text" title="{{$hotel['hotelName']}}" />
                                        <div class="booking-item-img-num"><i class="fa fa-picture-o"></i>23</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="booking-item-rating">
                                        <ul class="icon-group booking-item-rating-stars">
                                            @for($y = 0; $y < $hotel['starRating']; $y++)
                                                <li><i class="fa fa-star"></i>
                                                </li>
                                                @endfor
                                            @for($z = 0; $z < (5 - $hotel['starRating']); $z++)
                                            <li><i class="fa fa-star-o"></i>
                                            </li>
                                                @endfor

                                        </ul><span class="booking-item-rating-number"><b >{{$hotel['starRating']}}</b> of 5</span><small></small>
                                    </div>
                                    <h5 class="booking-item-title">{{$hotel['hotelName']}}</h5>
                                    <p class="booking-item-address"><i class="fa fa-map-marker"></i> {{$hotel['address']}}</p><small class="booking-item-last-booked">Confidentiality Level ({{$hotel['confidentialLevel']}})</small>
                                </div>
                                <div class="col-md-3">
                                    <span class="booking-item-price-from">from</span>
                                    <span class="booking-item-price"> @if($hotel['minimumPrice'] == 0) View Details @elseif($hotel['minimumPrice'] != 0)&#x20A6;{{number_format($hotel['minimumPrice'])}} @endif </span>
                                    <span>@if($hotel['minimumPrice'] == 0) @elseif($hotel['minimumPrice'] != 0) /day @endif</span>
                                    <button class="btn btn-primary hotel_description" value="{{$k}}">More Details</button>
                                </div>
                            </div>
                        </a>
                    </li>
                        @endforeach
                </ul>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection