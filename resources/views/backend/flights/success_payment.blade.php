@extends('layouts.backend')
@section('tab-title')Flights @endsection

@section('title')Flight Booking Payment Confirmation @endsection
@section('content')
    @php
        $InterswitchConfig = new \App\Services\InterswitchConfig();
        $Wallet = new \App\Wallet();
    @endphp
    <div class="row">
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
                    <div class="t">
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






                </div>
            </div>
        </div>
        <div class="col-md-9">
              <div class="row">
                  @if($transactionStatus['status'] == 1)
                      <div class="col-md-3" align="center" data-toggle="tooltip" title="{{$transactionStatus['responseDescription']}}">
                          <btn class="btn btn-success btn-block">
                              <i class="fa fa-check-circle fa-3x"></i>
                          </btn>
                      </div>
                      <div class="col-md-9">
                          <div class="alert alert-success">
                              <p><strong>Booking Completed !!! <i class="fa fa-caret-right"></i></strong> {{$transactionStatus['responseDescription']}} </p>
                          </div>
                      </div>
                      @elseif($transactionStatus['status'] == 2)
                      <div class="col-md-3" align="center" data-toggle="tooltip" title="{{$transactionStatus['responseDescription']}}">
                          <button  class="btn btn-warning btn-block">
                              <i class="fa fa-warning fa-3x"></i>
                          </button>
                      </div>
                      <div class="col-md-9">
                          <div class="alert alert-warning">
                              <p><strong>Booking On Hold !!! <i class="fa fa-caret-right"></i></strong> {{$transactionStatus['responseDescription']}} </p>
                          </div>
                      </div>

                  @elseif($transactionStatus['status'] == 0)
                      <div class="col-md-3" align="center" data-toggle="tooltip" title="{{$transactionStatus['responseDescription']}}">
                          <button class="btn btn-danger btn-block" >
                              <i class="fa fa-times-circle fa-3x"></i>
                          </button>
                      </div>
                     <div class="col-md-9">
                    <div class="alert alert-error">
                        <p><strong>Booking Failed/Incomplete !!! <i class="fa fa-caret-right"></i></strong> {{$transactionStatus['responseDescription']}} </p>
                    </div>
                </div>
                      @endif
              </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body invoice">
                            <div class="inv-header row">
                                <div class="col-md-6">
                                    Transaction Reference <b>{{$transactionStatus['reference']}}</b>
                                    <span class="date">{{date('d/m/Y')}}</span>
                                </div>
                                <div class="col-md-6 inv-action">
                                    {{--<a href="javascript:void(0)" title="Print PDF"><span class="ti-file"></span></a>--}}
                                    {{--<a href="javascript:void(0)" title="Email"><span class="ti-email"></span></a>--}}
                                    {{--<a href="javascript:void(0)" title="Print"><span class="ti-printer"></span></a>--}}
                                </div>
                            </div>
                              @if($transactionStatus['status'] == 0)
                                  <p><strong>{{$transactionStatus['responseDescription']}}/strong></p>
                                  <p>Sorry, your booking failed</p>
                                  @else

                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($itinerary[2] as $i => $priceInfo)
                                        <tr>
                                            <td>{{$priceInfo['passengerType']}}<br>
                                                <small>
                                                    @if($priceInfo['passengerType'] == 'ADT')
                                                        Adult(s)
                                                        @elseif($priceInfo['passengerType'] == 'CNN')
                                                        Children
                                                    @elseif($priceInfo['passengerType'] == 'INF')
                                                        Infant(s)
                                                    @endif

                                                </small>
                                            </td>
                                            <td></td>
                                            <td>(x{{$priceInfo['quantity']}})</td>
                                            <td></td>
                                            <td>&#x20A6; {{number_format(($priceInfo['totalPrice'] * $priceInfo['quantity']),2)}}</td>
                                        </tr>
                                    @endforeach()

                                    <tr>
                                        <td>Taxes and Fees</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            @role('Super Admin')
                                            &#x20A6; {{number_format($itinerary[0]['adminToAdminMarkup'] + $itinerary[0]['vat'],2)}}
                                            @endrole
                                            @role('Agent')
                                            &#x20A6; {{number_format($itinerary[0]['adminToAgentMarkup'] + $itinerary[0]['vat'],2)}}
                                            @endrole
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>&#x20A6; {{number_format($itinerary[0]['airlineMarkdown'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Price Change</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>&#x20A6; {{number_format($itinerary[0]['itineraryPriceAddition'],2)}}</td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="inv-count row mb-3">
                                    <div class="col-md-4 ml-auto">
                                        <div class="row">
                                            <div class="label total text-muted col-4">
                                                Total
                                            </div>
                                            <div class="price total col-6">
                                                @role('Super Admin')
                                                &#x20A6; {{number_format($itinerary[0]['adminToAdminSumTotal'],2)}}
                                                @endrole
                                                @role('Agent')
                                                &#x20A6; {{number_format($itinerary[0]['adminToAgentSumTotal'],2)}}
                                                @endrole
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif


                        </div><!-- .card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script src="{{asset('backend/js/payment_options.js')}}"></script>
@endsection