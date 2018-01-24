@extends('layouts.app')
@section('title') Package Booking Payment Confirmation @endsection
@section('activeAttraction')  active @endsection
@section('content')
    <div class="gap gap-small"></div>
    <div class="container">
        <div class="row">
            @if($transactionStatus['reference'] === 0 )
                <div class="col-md-12">
                        <i class="fa fa-times round box-icon-large box-icon-center box-icon-danger mb30"></i>
                        <h2 class="text-center">Sorry {{auth()->user()->first_name}}, your payment failed</h2>
                        <h4 class="text-center">Payment Reference : {{$transactionStatus['reference']}}</h4>
                        <h4 class="text-center">Payment Gateway Response : {{$transactionStatus['responseDescription']}} </h4>

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
                @else

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
                        <li>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h5><i class="fa fa-briefcase"></i> {{$packageInfo->package_name}}</h5>
                                </div>
                            </div>
                        </li>
                        @if($bookingInfo->adults > 0)
                            <li>
                                <div class="row">
                                    <div class="col-xs-9">
                                        <h5><i class="fa fa-user"></i> Adult(s)</h5>
                                        <p><small>(x{{$bookingInfo->adults}})</small>
                                        </p>
                                    </div>
                                    <div class="col-xs-3">
                                        <p class="text-right"><span class="text-lg">&#x20A6;{{number_format(($bookingInfo->adults * $packageInfo->adult_price),2)}}</span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                       @endif
                        @if($bookingInfo->kids > 0)
                                <li>
                                    <div class="row">
                                        <div class="col-xs-9">
                                            <h5><i class="fa fa-user"></i> Kid(s)</h5>
                                            <p><small>(x{{$bookingInfo->kids}})</small>
                                            </p>
                                        </div>
                                        <div class="col-xs-3">
                                            <p class="text-right"><span class="text-lg">&#x20A6;{{number_format(($bookingInfo->kids * $packageInfo->kids_price),2)}}</span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        <li>
                            <div class="row">
                                <div class="col-xs-9">
                                    <h5><i class="fa fa-money"></i> Total Amount Paid</h5>
                                    <p><small></small>
                                    </p>
                                </div>
                                <div class="col-xs-3">
                                    <p class="text-right"><span class="text-lg"><b>&#x20A6;{{number_format(($bookingInfo->total_amount / 100),2)}}</b></span>
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
                <div class="col-md-4">
                    <div class="booking-item-payment">
                        <header class="clearfix">
                            <a class="booking-item-payment-img" href="#">
                                @if(isset($images[0]))

                                    <img src="{{asset($images[0]['image_path'])}}" alt="{{$packageInfo->package_name}}" style="width:100%; height: 100%" title="{{$packageInfo->package_name}}"/>
                                @else
                                    <img src="{{asset('images/gallery/packages/no-image.jpg')}}"  alt="No image available for this attraction" title="No image available for this attraction" />
                                @endif
                            </a>
                            <h5 class="booking-item-payment-title"><a href="#">{{$packageInfo->package_name}}</a></h5>
                        </header>
                        <ul class="booking-item-payment-details">
                            <li>
                                <h5>April, 27 Saturday</h5>
                            </li>
                            <li>
                                <h5>Pricing</h5>
                                <ul class="booking-item-payment-price">
                                    @if($bookingInfo->adults > 0)
                                        <li>
                                            <p class="booking-item-payment-price-title">{{$bookingInfo->adults}} Adult(s)</p>
                                            <p class="booking-item-payment-price-amount">&#x20A6;{{number_format(($bookingInfo->adults * $packageInfo->adult_price),2)}}</p>
                                        </li>
                                    @endif
                                    @if($bookingInfo->kids > 0)
                                        <li>
                                            <p class="booking-item-payment-price-title">{{$bookingInfo->kids}} Kid(s)</p>
                                            <p class="booking-item-payment-price-amount">&#x20A6;&#x20A6;{{number_format(($bookingInfo->kids * $packageInfo->kids_price),2)}}</p>
                                        </li>
                                    @endif


                                </ul>
                            </li>
                        </ul>
                        <p class="booking-item-payment-total">Total trip: <span>&#x20A6;<b class="total_package_amount">{{number_format(($bookingInfo->total_amount / 100),2)}}</b></span></p>
                    </div>
                </div>
                @endif
        </div>
        <div class="gap"></div>
    </div>
@endsection