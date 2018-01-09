@extends('layouts.app')
@section('title') {{$selectedHotel['hotelName']}} Hotel Information  @endsection
@section('content')
    <div class="container">
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
                        <div class="col-md-12">
                            <img class="pp-img" src="{{asset('img/paypal.png')}}" alt="Image Alternative text" title="Image Title" />
                            <p>Important: You information as registered with us will be used to book this room. You will be redirected to out payment page to securely make your payment and complete your reservation.</p>
                            <button class="btn btn-primary" type="submit">Proceed to payment</button>
                        </div>
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
                            <h5>Booking for {{number_format($selectedHotel['rooms'][$room]['Duration'])}} nights</h5>
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
                                    <p class="booking-item-payment-price-title">{{number_format($selectedHotel['rooms'][$room]['Duration'])}} Nights</p>
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