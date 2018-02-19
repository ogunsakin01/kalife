@extends('layouts.backend')
@section('tab-title')Flights @endsection

@section('title')Passenger Details @endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            @if($itinerary[0]['itineraryPriceAddition'] != 0)
                <div class="alert alert-info">
                    <p><strong><i class="fa fa-warning"></i> Important Notice !!!</strong>
                    @if($itinerary[0]['itineraryPriceAddition'] < 0)
                            The price of this this Itinerary has decreased by &#x20A6; {{number_format($itinerary[0]['itineraryPriceAddition'])}}
                        @elseif($itinerary[0]['itineraryPriceAddition'] > 0)
                        The price of this this Itinerary has increased by &#x20A6; {{number_format($itinerary[0]['itineraryPriceAddition'])}}
                    @endif
                    </p>
                </div>
            @endif

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
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 style="color: #1751cd;">
                        <i class="fa fa-plane"></i> {{session()->get('flightSearchParam')['departure_airport']}} -
                        <i class="fa fa-plane fa-flip-vertical"></i> {{session()->get('flightSearchParam')['arrival_airport']}}
                    </h5>
                </div>
                <div class="card-body">


                            <h5>Flight Details</h5>
                            <div class="booking-item-payment-flight">
                                @foreach($itinerary[1] as $i => $originDestination)
                                    <p>FROM {{$originDestination[0]['departureAirportName']}}</p>
                                    @foreach($originDestination as $j => $segment)
                                        <hr/>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div>
                                                    <h5>
                                                        <i class="fa fa-plane"></i>
                                                        {{date('g:i A',strtotime($segment['departureDateTime']))}}
                                                    </h5>
                                                    <p>
                                                        {{date('D, M d',strtotime($segment['departureDateTime']))}}
                                                        <br/>
                                                        <b>{{$segment['departureAirportName']}}</b>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">

                                                    <div>
                                                        <h5>
                                                            <i class="fa fa-plane fa-flip-vertical"></i>
                                                            {{date('g:i A',strtotime($segment['arrivalDateTime']))}}
                                                        </h5>
                                                        <p>
                                                            {{date('D, M d',strtotime($segment['arrivalDateTime']))}}
                                                            <br/>
                                                        <b>{{$segment['arrivalAirportName']}}</b>
                                                        </p>
                                                    </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div>
                                                    <p> Duration <b>:{{$segment['timeDuration']}}</b></p>

                                                </div>
                                                <div>
                                                    <p> Flight Number <b>:{{$segment['operatingAirline']}}-{{$segment['flightNumber']}}</b> </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>


                            <h5>Pricing BrakeDown</h5>
                                @foreach($itinerary[2] as $i => $priceInfo)
                                    <hr/>
                                    <p>{{$priceInfo['passengerType']}} <small>(x{{$priceInfo['quantity']}})</small>
                                       <b class="pull-right">&#x20A6; {{number_format(($priceInfo['totalPrice'] * $priceInfo['quantity']),2)}}</b>
                                    </p>
                                @endforeach()
                                    <hr/>
                                    <p>Taxes and Fees
                                        @role('Super Admin')
                                        <b class="pull-right">&#x20A6; {{number_format($itinerary[0]['adminToAdminMarkup'] + $itinerary[0]['vat'],2)}}</b>
                                        @endrole
                                        @role('Agent')
                                        <b class="pull-right">&#x20A6; {{number_format($itinerary[0]['adminToAgentMarkup'] + $itinerary[0]['vat'],2)}}</b>
                                        @endrole
                                    </p>
                                    <hr/>
                                    <p>Discount
                                        <b class="pull-right">&#x20A6; {{number_format($itinerary[0]['airlineMarkdown'],2)}}</b>
                                    </p>
                                     <hr/>
                                    <p>Price Change
                                        <b class="pull-right">&#x20A6; {{number_format($itinerary[0]['itineraryPriceAddition'],2)}}</b>
                                    </p>






                </div>
                <div class="card-footer">
                    @role('Super Admin')
                    <b class="text-dark">Total Amount: <span>&#x20A6; {{number_format($itinerary[0]['adminToAdminSumTotal'],2)}}</span> </b>
                    @endrole
                    @role('Agent')
                    <b class="text-dark">Total Amount: <span>&#x20A6; {{number_format($itinerary[0]['adminToAgentSumTotal'],2)}}</span> </b>
                    @endrole
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">

                <div class="card-body">
                    <p class="card-header">
                        Passenger(s) Details
                    </p>
                    <hr/>
                    <form method="post" action="{{url('backend/passengerDetailsRQ')}}">
                        {{csrf_field()}}
                        @for($i = 0; $i < session()->get('flightSearchParam')['adult_passengers']; $i++)
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-bigger">ADULT ({{$i+1}}) <small>above 12 years old</small></p>
                                </div>
                                <div class="col-md-3">
                                    <label>Sex</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" required name="adult_sex[{{$i}}]" value="M" /> Male</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" required name="adult_sex[{{$i}}]" value="F"/> Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                        <label>Surname</label>
                                        <input class="form-control" name="adult_surname[]" required type="text" />
                                    </div>

                                </div>
                                <div class="col-md-3">

                                    <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                        <label>Given name</label>
                                        <input class="form-control" name="adult_given_name[]" required type="text" />
                                    </div>

                                </div>
                                <div class="col-md-3">

                                    <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-show"></i>
                                        <label>Date of Birth</label>
                                        <input class="datepicker form-control" name="adult_date_of_birth[]" required type="text" />
                                    </div>

                                </div>
                            </div>
                            <hr/>
                        @endfor
                        @for($i = 0; $i < session()->get('flightSearchParam')['child_passengers']; $i++)
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-bigger">CHILD ({{$i+1}}) <small>2 - 11 years old</small></p>
                                </div>
                                <div class="col-md-3">
                                    <label>Sex</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" required name="child_sex[{{$i}}]" value="M" /> Male</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" required name="child_sex[{{$i}}]" value="F"/> Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                        <label>Surname</label>
                                        <input class="form-control" name="child_surname[]" required type="text" />
                                    </div>

                                </div>
                                <div class="col-md-3">

                                    <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                        <label>Given name</label>
                                        <input class="form-control" name="child_given_name[]" required type="text" />
                                    </div>

                                </div>
                                <div class="col-md-3">

                                    <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-show"></i>
                                        <label>Date of Birth</label>
                                        <input class="datepicker form-control" name="child_date_of_birth[]" required type="text" />
                                    </div>

                                </div>
                            </div>
                            <hr/>
                        @endfor
                        @for($i = 0; $i < session()->get('flightSearchParam')['infant_passengers']; $i++)
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-bigger">INFANT ({{$i+1}}) <small>below 2 years old</small></p>
                                </div>
                                <div class="col-md-3">
                                    <label>Sex</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" required name="infant_sex[{{$i}}]" value="M" /> Male</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" required name="infant_sex[{{$i}}]" value="F"/> Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                        <label>Surname</label>
                                        <input class="form-control" name="infant_surname[]" required type="text" />
                                    </div>

                                </div>
                                <div class="col-md-3">

                                    <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                        <label>Given name</label>
                                        <input class="form-control" name="infant_given_name[]" required type="text" />
                                    </div>

                                </div>
                                <div class="col-md-3">

                                    <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-show"></i>
                                        <label>Date of Birth</label>
                                        <input class="datepicker form-control" name="infant_date_of_birth[]" required type="text" />
                                    </div>

                                </div>
                            </div>
                            <hr/>
                        @endfor
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-alt-primary">Proceed to Payment <i class="fa fa-money"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script src="{{asset('backend/js/home.js')}}"></script>
@endsection