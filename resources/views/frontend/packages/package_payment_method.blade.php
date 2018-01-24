@extends('layouts.app')
@section('title'){{-- {{$name}}--}} Booking @endsection
@section('activeAttraction')  active @endsection
@section('content')
    <div class="gap gap-small"></div>
    <div class="container">
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
                            @if(isset($images[0]))

                                <img src="{{asset($images[0]['image_path'])}}" alt="{{$name}}" style="width:100%; height: 100%" title="{{$name}}"/>
                            @else
                                <img src="{{asset('images/gallery/packages/no-image.jpg')}}"  alt="No image available for this attraction" title="No image available for this attraction" />
                            @endif
                        </a>
                        <h5 class="booking-item-payment-title"><a href="#">{{$name}}</a></h5>
                    </header>
                    <ul class="booking-item-payment-details">
                        <li>
                            <h5>April, 27 Saturday</h5>
                        </li>
                        <li>
                            <h5>Pricing</h5>
                            <ul class="booking-item-payment-price">
                                <li>
                                    <p class="booking-item-payment-price-title">{{$bookingData['adults']}} Adult(s)</p>
                                    <p class="booking-item-payment-price-amount">&#x20A6; {{number_format(($attraction_info->adult_price * $bookingData['adults']), 2)}}</p>
                                </li>
                                <li>
                                    <p class="booking-item-payment-price-title">{{$bookingData['kids']}} Kid(s)</p>
                                    <p class="booking-item-payment-price-amount">&#x20A6; {{number_format(($attraction_info->kids_price * $bookingData['kids']), 2)}}</p>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <p class="booking-item-payment-total">Total trip: <span>&#x20A6;<b class="total_package_amount">{{number_format(($bookingData['total_amount'] / 100),2)}}</b></span></p>
                </div>
            </div>
            &nbsp;&nbsp;

        </div>
        <div class="gap"></div>
    </div>
@endsection