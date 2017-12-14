@extends('layouts.app')
@section('title')Payment Options @endsection
@section('activeFlight')
    class='active'
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        <i class="fa fa-check"></i>
                        {{session()->get('message')}}
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
                                    <form>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-info">
                                                    <i class="fa fa-info"></i>
                                                    Pay directly with your bank card
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <ul class="order-payment-list list mb30">
                                                    @foreach($itinerary[2] as $i => $priceInfo)
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    <h5><i class="fa fa-plane"></i> {{$priceInfo['passengerType']}}</h5>
                                                                    <p><small>(x{{$priceInfo['quantity']}})</small>
                                                                    </p>
                                                                </div>
                                                                <div class="col-xs-3">
                                                                    <p class="text-right"><span class="text-lg">&#x20A6; {{number_format($priceInfo['totalPrice'],2)}}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            </p>
                                                        </li>
                                                    @endforeach()
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-xs-9">
                                                                <h5><i class="fa fa-plane"></i> Taxes and Fees</h5>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <p class="text-right"><span class="text-lg">&#x20A6; {{number_format($itinerary[0]['adminToUserMarkup'] + $itinerary[0]['vat'],2)}}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    <h5><i class="fa fa-plane"></i> Discount</h5>
                                                                </div>
                                                                <div class="col-xs-3">
                                                                    <p class="text-right"><span class="text-lg">&#x20A6; {{number_format($itinerary[0]['airlineMarkdown'],2)}}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    <h5><i class="fa fa-plane"></i> <b>Total Amount</b></h5>
                                                                </div>
                                                                <div class="col-xs-3">
                                                                    <p class="text-right"><span class="text-lg">&#x20A6; {{number_format($itinerary[0]['adminToUserSumTotal'],2)}}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-primary btn-lg" type="submit">Pay Now <i class="fa fa-credit-card"></i></button>
                                            </div>
                                            <div class="col-md-6">
                                                <img src="{{url("img/payment/payment-options.png")}}" style="max-width: 300px; max-height: 90px;" class="img-responsive"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tab-2">
                                    <h4>Paystack Payment Gateway</h4>
                                    <form>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-info">
                                                    <i class="fa fa-info"></i>
                                                    Pay directly with your bank card
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <ul class="order-payment-list list mb30">
                                                    @foreach($itinerary[2] as $i => $priceInfo)
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    <h5><i class="fa fa-plane"></i> {{$priceInfo['passengerType']}}</h5>
                                                                    <p><small>(x{{$priceInfo['quantity']}})</small>
                                                                    </p>
                                                                </div>
                                                                <div class="col-xs-3">
                                                                    <p class="text-right"><span class="text-lg">&#x20A6; {{number_format($priceInfo['totalPrice'],2)}}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            </p>
                                                        </li>
                                                    @endforeach()
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-xs-9">
                                                                <h5><i class="fa fa-plane"></i> Taxes and Fees</h5>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <p class="text-right"><span class="text-lg">&#x20A6; {{number_format($itinerary[0]['adminToUserMarkup'] + $itinerary[0]['vat'],2)}}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-xs-9">
                                                                <h5><i class="fa fa-plane"></i> Discount</h5>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <p class="text-right"><span class="text-lg">&#x20A6; {{number_format($itinerary[0]['airlineMarkdown'],2)}}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-xs-9">
                                                                <h5><i class="fa fa-plane"></i> <b>Total Amount</b></h5>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <p class="text-right"><span class="text-lg">&#x20A6; {{number_format($itinerary[0]['adminToUserSumTotal'],2)}}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-primary btn-lg" type="submit">Pay Now <i class="fa fa-credit-card"></i></button>
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
                                            <div class="col-md-12">
                                                <ul class="order-payment-list list mb30">
                                                    @foreach($itinerary[2] as $i => $priceInfo)
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    <h5><i class="fa fa-plane"></i> {{$priceInfo['passengerType']}}</h5>
                                                                    <p><small>(x{{$priceInfo['quantity']}})</small>
                                                                    </p>
                                                                </div>
                                                                <div class="col-xs-3">
                                                                    <p class="text-right"><span class="text-lg">&#x20A6; {{number_format($priceInfo['totalPrice'],2)}}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            </p>
                                                        </li>
                                                    @endforeach()
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-xs-9">
                                                                <h5><i class="fa fa-plane"></i> Taxes and Fees</h5>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <p class="text-right"><span class="text-lg">&#x20A6; {{number_format($itinerary[0]['adminToUserMarkup'] + $itinerary[0]['vat'],2)}}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-xs-9">
                                                                <h5><i class="fa fa-plane"></i> Discount</h5>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <p class="text-right"><span class="text-lg">&#x20A6; {{number_format($itinerary[0]['airlineMarkdown'],2)}}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-xs-9">
                                                                <h5><i class="fa fa-plane"></i> <b>Total Amount</b></h5>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <p class="text-right"><span class="text-lg">&#x20A6; {{number_format($itinerary[0]['adminToUserSumTotal'],2)}}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-primary btn-lg" type="submit">Proceed</button>
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
                        <h5 class="mb0" style="color: #1751cd;"><i class="fa fa-plane"></i> {{session()->get('flightSearchParam')['departure_airport']}} - <i class="fa fa-plane fa-flip-vertical"></i> {{session()->get('flightSearchParam')['arrival_airport']}}</h5>
                    </header>
                    <ul class="booking-item-payment-details">
                        <li>
                            <h5>Flight Details</h5>
                            <div class="booking-item-payment-flight">
                                @foreach($itinerary[1] as $i => $originDestination)
                                    <p>FROM {{$originDestination[0]['departureAirportName']}}</p>
                                    @foreach($originDestination as $j => $segment)
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="booking-item-flight-details">
                                                    <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                        <h5>{{date('g:i A',strtotime($segment['departureDateTime']))}}</h5>
                                                        <p class="booking-item-date">{{date('D, M d',strtotime($segment['departureDateTime']))}}</p>
                                                        <p class="booking-item-destination">{{$segment['departureAirportName']}}</p>
                                                    </div>
                                                    <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                        <h5>{{date('g:i A',strtotime($segment['arrivalDateTime']))}}</h5>
                                                        <p class="booking-item-date">{{date('D, M d',strtotime($segment['arrivalDateTime']))}}</p>
                                                        <p class="booking-item-destination">{{$segment['arrivalAirportName']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="booking-item-flight-duration">
                                                    <p>Duration</p>
                                                    <h5>{{$segment['timeDuration']}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </li>
                        <li>
                            <h5>Pricing BrakeDown</h5>
                            <ul class="booking-item-payment-price">
                                @foreach($itinerary[2] as $i => $priceInfo)
                                    <li>
                                        <p class="booking-item-payment-price-title">{{$priceInfo['passengerType']}} <small>(x{{$priceInfo['quantity']}})</small></p>
                                        <p class="booking-item-payment-price-amount">&#x20A6; {{number_format($priceInfo['totalPrice'],2)}}
                                        </p>
                                    </li>
                                @endforeach()

                                <li>
                                    <p class="booking-item-payment-price-title">Taxes and Fees</p>
                                    <p class="booking-item-payment-price-amount">&#x20A6; {{number_format($itinerary[0]['adminToUserMarkup'] + $itinerary[0]['vat'],2)}}</p>
                                </li>
                                <li>
                                    <p class="booking-item-payment-price-title">Discount</p>
                                    <p class="booking-item-payment-price-amount">&#x20A6; {{number_format($itinerary[0]['airlineMarkdown'],2)}}
                                    </p>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <p class="booking-item-payment-total">Total trip: <span>&#x20A6; {{number_format($itinerary[0]['adminToUserSumTotal'],2)}}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="gap"></div>
    </div>
    @endsection