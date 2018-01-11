@extends('layouts.app')
@section('title') Flying Passengers Details @endsection

@section('content')
<div class="gap gap-small"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="booking-item-payment">
                    <header class="clearfix">
                        <h5 class="mb0" style="color: #1751cd;"><i class="fa fa-plane"></i> {{session()->get('flightSearchParam')['departure_airport']}} - <i class="fa fa-plane fa-flip-vertical"></i> {{session()->get('flightSearchParam')['arrival_airport']}}</h5>
                    </header>
                    <ul class="booking-item-payment-details">
                        <li>
                            <h5>Flight Details</h5>
                            <div class="booking-item-payment-flight">
                                @foreach($Itinerary[1] as $i => $originDestination)
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
                    </ul>
                    <p class="booking-item-payment-total">Total trip: <span>&#x20A6;{{number_format($Itinerary[0]['adminToUserSumTotal'],2)}}</span>
                    </p>
                </div>
            </div>
            <div class="col-md-8 ">
                @if($transactionStatus['status'] == 0)
                    <i class="fa fa-times round box-icon-large box-icon-center box-icon-danger mb30"></i>
                    <h2 class="text-center">Sorry {{auth()->user()->first_name}}, your payment failed</h2>
                    <h4 class="text-center">Payment Reference : {{$transactionStatus['reference']}}</h4>
                    <h4 class="text-center">Payment Gateway Response : {{$transactionStatus['responseDescription']}} </h4>
                @elseif($transactionStatus['status'] == 1)
                    <i class="fa fa-check round box-icon-large box-icon-center box-icon-success mb30"></i>
                    <h2 class="text-center">Hi {{auth()->user()->first_name}}, your payment was successful!</h2>
                    <h4 class="text-center">Payment Reference : {{$transactionStatus['reference']}}</h4>
                    <h4 class="text-center">Payment Gateway Response : {{$transactionStatus['responseDescription']}} </h4>
                    <h5 class="text-center mb30">Booking details has been send to {{$transactionStatus['email']}}</h5>

                    <ul class="order-payment-list list mb30">
                        @foreach($Itinerary[2] as $i => $priceInfo)
                            <li>
                                <div class="row">
                                    <div class="col-xs-9">
                                        <h5><i class="fa fa-plane"></i> {{$priceInfo['passengerType']}}</h5>
                                        <p><small>(x{{$priceInfo['quantity']}})</small>
                                        </p>
                                    </div>
                                    <div class="col-xs-3">
                                        <p class="text-right"><span class="text-lg">&#x20A6;{{number_format($priceInfo['totalPrice'],2)}}</span>
                                        </p>
                                    </div>
                                </div>
                            </li>

                        @endforeach()

                            <li>
                                <div class="row">
                                    <div class="col-xs-9">
                                        <h5><i class="fa fa-money"></i> Taxes and Fees</h5>
                                        <p><small></small>
                                        </p>
                                    </div>
                                    <div class="col-xs-3">
                                        <p class="text-right"><span class="text-lg">&#x20A6;{{number_format($Itinerary[0]['adminToUserMarkup'] + $Itinerary[0]['vat'],2)}}</span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-9">
                                        <h5><i class="fa fa-money"></i> Discount</h5>
                                        <p><small></small>
                                        </p>
                                    </div>
                                    <div class="col-xs-3">
                                        <p class="text-right"><span class="text-lg">&#x20A6;{{number_format($Itinerary[0]['airlineMarkdown'],2)}}</span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-9">
                                        <h5><i class="fa fa-money"></i> Price Increase</h5>
                                        <p><small></small>
                                        </p>
                                    </div>
                                    <div class="col-xs-3">
                                        <p class="text-right"><span class="text-lg">&#x20A6; {{number_format($Itinerary[0]['itineraryPriceAddition'])}}</span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-9">
                                        <h5><i class="fa fa-money"></i> Total Amount Paid</h5>
                                        <p><small></small>
                                        </p>
                                    </div>
                                    <div class="col-xs-3">
                                        <p class="text-right"><span class="text-lg"><b>&#x20A6;{{number_format($Itinerary[0]['adminToUserSumTotal'],2)}}</b></span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                    </ul>
                @endif




                <h4 class="text-center">What else do you need ?</h4>
                <ul class="list list-inline list-center">
                    <li><a class="btn btn-primary" href="{{url('/flights')}}"><i class="fa fa-home"></i> Flights</a>
                        {{--<p class="text-center lh1em mt5"><small>240 offers<br /> from $85</small>--}}
                        {{--</p>--}}
                    </li>
                    <li><a class="btn btn-primary" href="{{url('/hotels')}}"><i class="fa fa-building-o"></i> Hotels</a>
                        {{--<p class="text-center lh1em mt5"><small>362 offers<br /> from $75</small>--}}
                        {{--</p>--}}
                    </li>

                    <li><a class="btn btn-primary" href="{{url('/bookings')}}"><i class="fa fa-dashboard"></i> Your Bookings</a>
                        {{--<p class="text-center lh1em mt5"><small>165 offers<br /> from $143</small>--}}
                        {{--</p>--}}
                    </li>
                    {{--<li><a class="btn btn-primary" href="#"><i class="fa fa-bolt"></i> Travel Packages</a>--}}
                        {{--<p class="text-center lh1em mt5"><small>366 offers<br /> from $116</small>--}}
                        {{--</p>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </div>
        <div class="gap"></div>
    </div>
    @endsection