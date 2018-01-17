@extends('layouts.app')
@section('title') {{$selectedHotel['hotelName']}} Hotel Information  @endsection
@section('activeHotel') active @endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a>
            </li>
            <li><a>Hotels</a>
            </li>
            <li><a href="{{url('/available-hotels')}}">{{$hotelSearchParam['city']}} Hotels</a></li>
            <li><a>{{$selectedHotel['hotelName']}} Hotel</a></li>
            <li >{{$selectedHotel['rooms'][$room]['roomDescription']}}</li>
            <li class="active">Payment Options</li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        <i class="fa fa-check"></i>
                        {{session()->get('message')}}
                    </div>
                @endif
                @if(session()->has('errorMessage'))
                    <div class="alert alert-danger">
                        <i class="fa fa-times"></i>
                        {{session()->get('errorMessage')}}
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#tab-1" data-toggle="tab"><span ><img src="{{url("img/payment/interswitch-New.png")}}" style="max-width: 100px; max-height: 50px;" class="img-responsive"/></span></a>
                        </li>
                        <li><a href="#tab-2" data-toggle="tab"><span ><img src="{{url("img/payment/paystack_new_logo.png")}}" style="max-width: 100px; max-height: 50px;" class="img-responsive"/></span></a>
                        </li>
                        <li><a href="#tab-3" data-toggle="tab"> <span > <img src="{{url("img/payment/bank_payment.png")}}" style="max-width: 100px; max-height: 50px;" class="img-responsive"/></span></a>
                        </li>
                    </ul>
                    <div class="tab-content" style="background-color: #f7f7f7; padding: 15px; ">
                        <div class="tab-pane fade in active" id="tab-1">
                            <h4>Interswitch Payment Gateway</h4>
                            <form method="post" action="{{\App\Services\InterswitchConfig::$ActionUrl}}">
                                <input type="hidden" class="reference_1" name="txn_ref" value="{{$paymentInfo['reference']}}"/>
                                <input type="hidden" class="amount_1" name="amount" value="{{$paymentInfo['amount']}}"/>
                                <input type="hidden" name="currency" value="566"/>
                                <input type="hidden" name="pay_item_id" value="{{$paymentInfo['pay_item_id']}}"/>
                                <input type="hidden" name="site_redirect_url" value="{{$paymentInfo['site_redirect_url']}}"/>
                                <input type="hidden" name="product_id" value="{{$paymentInfo['product_id']}}"/>
                                <input type="hidden" class="cust_id_1" name="cust_id" value="{{$paymentInfo['cust_id']}}"/>
                                <input type="hidden" name="cust_name" value="{{$paymentInfo['cust_name']}}"/>
                                <input type="hidden" name="hash" value="{{$paymentInfo['hash']}}"/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <i class="fa fa-info"></i>
                                            Pay directly with your bank card
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-lg pay_now" value="1" type="submit">Pay Now <i class="fa fa-credit-card"></i></button>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{url("img/payment/payment-options.png")}}" style="max-width: 300px; max-height: 90px;" class="img-responsive"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab-2">
                            <h4>Paystack Payment Gateway</h4>
                            <form method="post" action="{{url('/initiatePaystack')}}">
                                {{csrf_field()}}
                                <input type="hidden" class="reference_2" name="reference" value="{{$paymentInfo['reference']}}"/>
                                <input type="hidden" class="amount_2" name="amount" value="{{$paymentInfo['amount']}}"/>
                                <input type="hidden" class="" name="site_redirect_url" value="{{$paymentInfo['site_redirect_url']}}"/>
                                <input type="hidden" class="cust_id_2" name="cust_id" value="{{$paymentInfo['cust_id']}}"/>
                                <input type="hidden" class="" name="email" value="{{$paymentInfo['email']}}"/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <i class="fa fa-info"></i>
                                            Pay directly with your bank card
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-lg pay_now" value="2" type="submit">Pay Now <i class="fa fa-credit-card"></i></button>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{url("img/payment/paystack.png")}}" style="max-width: 300px; max-height: 90px;" class="img-responsive"/>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab-3">
                            <h4>Pay By Bank</h4>
                            <form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <i class="fa fa-info"></i>
                                            You will be presented with the list of our banks and a means of confirmation of payment will be needed from you to confirm your booking
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-lg" type="button">Proceed</button>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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