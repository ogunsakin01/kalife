@extends('layouts.app')
@section('title') {{$selectedHotel['hotelName']}} Hotel Information  @endsection
@section('content')
    {{--{{dd($selectedHotel)}}--}}
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a>
            </li>
            <li><a>Hotels</a>
            </li>
            <li><a href="{{url('/available-hotels')}}">{{$hotelSearchParam['city']}} Hotels</a></li>
            <li><a href="{{session()->previousUrl()}}">{{$selectedHotel['hotelName']}} Hotel</a></li>
            <li class="active">{{$selectedHotel['rooms'][$room]['roomDescription']}}</li>
        </ul>
        <div class="gap gap-small"></div>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <i class="fa fa-check"></i>
                    {{session()->get('message')}}
                </div>
            @endif
            @if(session()->has('errorMessage'))
                <div class="alert alert-warning">
                    <i class="fa fa-warning"></i>
                    {{session()->get('errorMessage')}}
                </div>
            @endif
                <div class="col-md-12">
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
                </div>
            <div class="col-md-8">

                @if(auth()->guest())
                    <p>Sign in to your <b>Kalife Travels and Tours</b> account for fast booking.</p>
                    <form method="post" action="{{url('/login')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon input-icon-show"></i>
                                        <label> Email</label>
                                        <input class="form-control" name="email" required type="email" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                                        <label> Password</label>
                                        <input class="form-control" name="password" required type="password" value=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary"> Login <i class="fa fa-sign-in"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="checkbox">
                        <label>
                            Are you a new customer ? <a class="popup-text" href="#register_new_user" data-effect="mfp-zoom-out">Register Here</a>. Can't remember password ? <a href="#">Click here</a>
                        </label>
                    </div>
                    <div class="gap gap-small"></div>
                    <h3>Customer</h3>
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i>
                        Kindly login to your account if you are an existing customer or register with us before you continue your booking process
                    </div>
                    <hr>
                    @else
                    <hr>
                    <div class="row">
                        <form method="post" action="{{url('hotelPassengerDetailsRQ')}}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$room}}" name="room">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle"></i>
                                    Your are logged in, proceed to payment.
                                </div>
                                <img class="pp-img" src="{{asset('img/paypal.png')}}" alt="Image Alternative text" title="Image Title" />
                                <p class="text-darken text-bigger">Important: You information as registered with us will be used to book this room. You will be redirected to out payment page to securely make your payment and complete your reservation.</p>
                                <button class="btn btn-primary" type="submit">Proceed to payment</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="booking-item-payment">
                    <header class="clearfix">
                        <a class="booking-item-payment-img" href="#">
                            <img src="{{asset('img/hotel_1_800x600.jpg')}}" alt="Image Alternative text" title="hotel 1" />
                        </a>
                        <h5 class="booking-item-payment-title"><a href="#">{{$selectedHotel['hotelName']}}</a></h5>
                        <ul class="icon-group booking-item-rating-stars">
                            @for($y = 0; $y < $hotel['starRating']; $y++)
                                <li><i class="fa fa-star"></i>
                                </li>
                            @endfor
                            @for($z = 0; $z < (5 - $hotel['starRating']); $z++)
                                <li><i class="fa fa-star-o"></i>
                                </li>
                            @endfor
                        </ul>
                    </header>
                    <ul class="booking-item-payment-details">
                        <li>
                            <h5>Booking for {{number_format($selectedHotel['rooms'][$room]['Duration'])}} days</h5>
                            <div class="booking-item-payment-date">
                                <p class="booking-item-payment-date-day">{{date('M, d',strtotime($selectedHotel['checkinDate']))}}</p>
                                <p class="booking-item-payment-date-weekday">{{date('l',strtotime($selectedHotel['checkinDate']))}}</p>
                            </div><i class="fa fa-arrow-right booking-item-payment-date-separator"></i>
                            <div class="booking-item-payment-date">
                                <p class="booking-item-payment-date-day">{{date('M, d',strtotime($selectedHotel['checkoutDate']))}}</p>
                                <p class="booking-item-payment-date-weekday">{{date('l',strtotime($selectedHotel['checkoutDate']))}}</p>
                            </div>
                        </li>
                        <li>
                            <h5>Room</h5>
                            <p class="booking-item-payment-item-title">{{$selectedHotel['rooms'][$room]['roomDescription']}}</p>
                            <ul class="booking-item-payment-price">
                                <li>
                                    <p class="booking-item-payment-price-title">{{number_format($selectedHotel['rooms'][$room]['Duration'])}} Days</p>
                                    <p class="booking-item-payment-price-amount">&#x20A6;{{number_format($selectedHotel['rooms'][$room]['baseAmountAllNightsNaira'],2)}}
                                    </p>
                                </li>
                                <li>
                                    <p class="booking-item-payment-price-title">Taxes and Fees</p>
                                    <p class="booking-item-payment-price-amount">&#x20A6; {{number_format(($selectedHotel['rooms'][$room]['vat'] + $selectedHotel['rooms'][$room]['tax']),2)}}
                                    </p>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <p class="booking-item-payment-total">Total trip: <span>&#x20A6; {{number_format($selectedHotel['rooms'][$room]['totalAmount'],2)}}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection