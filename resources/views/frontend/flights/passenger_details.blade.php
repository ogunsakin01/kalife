@extends('layouts.app')
@section('title') Flying Passengers Details @endsection

@section('content')
{{--{{dd($itinerary)}}--}}
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Customer</h3>
                <p>Sign in to your <a href="#">Traveler account</a> for fast booking.</p>
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>First & Last Name</label>
                                <input class="form-control" type="text" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input class="form-control" type="text" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input class="i-check" type="checkbox" checked/>Create Traveler account <small>(password will be send to your e-mail)</small>
                        </label>
                    </div>
                </form>
                <div class="gap gap-small"></div>
                <h3>Passengers</h3>
                <ul class="list booking-item-passengers">
                    <li>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Sex</label>
                                <div class="radio-inline radio-small">
                                    <label>
                                        <input class="i-radio" type="radio" name="passenger-1-sex" />Male</label>
                                </div>
                                <div class="radio-inline radio-small">
                                    <label>
                                        <input class="i-radio" type="radio" name="passenger-1-sex" />Female</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Surname</label>
                                    <input class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input class="date-pick-years form-control" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-md-offset-3">
                                <div class="form-group">
                                    <label>Citizenship</label>
                                    <input class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Document Series</label>
                                    <input class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Expiry Date</label>
                                    <input class="date-pick-years form-control" type="text" />
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Sex</label>
                                <div class="radio-inline radio-small">
                                    <label>
                                        <input class="i-radio" type="radio" name="passenger-2-sex" />Male</label>
                                </div>
                                <div class="radio-inline radio-small">
                                    <label>
                                        <input class="i-radio" type="radio" name="passenger-2-sex" />Female</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Surname</label>
                                    <input class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input class="date-pick-years form-control" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-md-offset-3">
                                <div class="form-group">
                                    <label>Citizenship</label>
                                    <input class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Document Series</label>
                                    <input class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Expiry Date</label>
                                    <input class="date-pick-years form-control" type="text" />
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="gap gap-small"></div>
                <div class="row">
                    <div class="col-md-6">
                        <img class="pp-img" src="img/paypal.png" alt="Image Alternative text" title="Image Title" />
                        <p>Important: You will be redirected to PayPal's website to securely complete your payment.</p><a class="btn btn-primary">Checkout via Paypal</a>
                    </div>
                    <div class="col-md-6">
                        <form class="cc-form">
                            <div class="clearfix">
                                <div class="form-group form-group-cc-number">
                                    <label>Card Number</label>
                                    <input class="form-control" placeholder="xxxx xxxx xxxx xxxx" type="text" /><span class="cc-card-icon"></span>
                                </div>
                                <div class="form-group form-group-cc-cvc">
                                    <label>CVC</label>
                                    <input class="form-control" placeholder="xxxx" type="text" />
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="form-group form-group-cc-name">
                                    <label>Cardholder Name</label>
                                    <input class="form-control" type="text" />
                                </div>
                                <div class="form-group form-group-cc-date">
                                    <label>Valid Thru</label>
                                    <input class="form-control" placeholder="mm/yy" type="text" />
                                </div>
                            </div>
                            <div class="checkbox checkbox-small">
                                <label>
                                    <input class="i-check" type="checkbox" checked/>Add to My Cards</label>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Proceed Payment" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="booking-item-payment">
                    <header class="clearfix">
                        <h5 class="mb0"><i class="fa fa-plane"></i> {{session()->get('flightSearchParam')['departure_airport']}} - <i class="fa fa-plane fa-flip-vertical"></i> {{session()->get('flightSearchParam')['arrival_airport']}}</h5>
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
                                    <p class="booking-item-payment-price-amount">&#x20A6; {{number_format(0,2)}}
                                    </p>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <p class="booking-item-payment-total">Total trip: <span>&#x20A6; {{number_format($itinerary[0]['totalPrice'],2)}}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="gap"></div>
    </div>

@endsection