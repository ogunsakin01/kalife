@extends('layouts.backend')
@section('tab-title')Flights @endsection

@section('title')Flight Booking Payment Options @endsection
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

                <div class="row">
                    <div class="col-md-3" align="center" data-toggle="tooltip" title="Payment by bank transfer is available">
                        <div class="card">
                        <img src="{{asset('img/payment/bank_payment.png')}}" style="max-height: 50px;" />
                        </div>
                    </div>
                    <div class="col-md-3" align="center" data-toggle="tooltip" title="Payment with your wallet option is available">
                        <div class="card">
                        <img src="{{asset('img/payment/wallet.png')}}" style="max-height: 50px;" />
                        </div>
                    </div>
                    <div class="col-md-3" align="center" data-toggle="tooltip" title="Direct online payment with Paystack is available">
                        <div class="card">
                        <img src="{{asset('img/payment/paystack_new_logo.png')}}" style="max-height: 50px;" />
                        </div>
                    </div>
                    <div class="col-md-3" align="center" data-toggle="tooltip" title="Direct online payment with Interswitch is available">
                        <div class="card">
                        <img src="{{asset('img/payment/interswitch-images.png')}}" style="max-height: 50px;" />
                        </div>
                    </div>
                </div>

           <div class="row">
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-header">
                           Select Payment Option
                       </div>
                       <div class="card-body">

                           <div class="row">
                               <div class="col-md-4" style="border-right: 1px solid blue;">
                                   <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                                       <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-expanded="true"> Interswitch</a>
                                       <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-expanded="false"> Paystack</a>
                                       <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-expanded="false"> Wallet</a>
                                       {{--<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-expanded="false"> Pay By Bank</a>--}}
                                   </div>
                               </div>
                               <div class="col-md-8">
                                   <div class="tab-content" id="v-pills-tabContent">
                                       <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-expanded="true">
                                           <form method="post" action="{{$InterswitchConfig->requestActionUrl}}">
                                               <img src="{{asset('img/payment/Interswitch-images.png')}}" style="height: 100px;" />
                                               <input type="hidden" class="reference_1" name="txn_ref" value="{{$paymentInfo['reference']}}"/>
                                               <input type="hidden" class="amount_1" name="amount" value="{{$paymentInfo['amount']}}"/>
                                               <input type="hidden" name="currency" value="566"/>
                                               <input type="hidden" name="pay_item_id" value="{{$paymentInfo['pay_item_id']}}"/>
                                               <input type="hidden" name="site_redirect_url" value="{{$paymentInfo['site_redirect_url']}}"/>
                                               <input type="hidden" name="product_id" value="{{$paymentInfo['product_id']}}"/>
                                               <input type="hidden" class="cust_id_1" name="cust_id" value="{{$paymentInfo['cust_id']}}"/>
                                               <input type="hidden" name="cust_name" value="{{$paymentInfo['cust_name']}}"/>
                                               <input type="hidden" name="hash" value="{{$paymentInfo['hash']}}"/>
                                               <h5><b>Total Amount :</b> &#x20A6;{{number_format(($paymentInfo['amount'] / 100),2)}}</h5>
                                               <button type="submit" class="btn btn-primary"><i class="fa fa-credit-card-alt"></i> Pay Now</button>
                                           </form>
                                       </div>
                                       <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-expanded="false">
                                           <form method="post" action="{{url('/initiatePaystack')}}">
                                               <img src="{{asset('img/payment/paystack_new_logo.png')}}" style="height: 100px;" />
                                               {{csrf_field()}}
                                               <input type="hidden" class="reference_2" name="reference" value="{{$paymentInfo['reference']}}"/>
                                               <input type="hidden" class="amount_2" name="amount" value="{{$paymentInfo['amount']}}"/>
                                               <input type="hidden" class="" name="site_redirect_url" value="{{$paymentInfo['site_redirect_url']}}"/>
                                               <input type="hidden" class="cust_id_2" name="cust_id" value="{{$paymentInfo['cust_id']}}"/>
                                               <input type="hidden" class="" name="email" value="{{$paymentInfo['email']}}"/>
                                               <h5><b>Total Amount :</b> &#x20A6;{{number_format(($paymentInfo['amount'] / 100),2)}}</h5>
                                               <button type="submit" class="btn btn-primary"><i class="fa fa-credit-card-alt"></i> Pay Now</button>
                                           </form>
                                       </div>
                                       <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-expanded="false">
                                           <img src="{{asset('img/payment/wallet.png')}}" style="height: 100px;" />
                                           <h5><b>Total Amount :</b> &#x20A6;{{number_format(($paymentInfo['amount'] / 100),2)}}</h5>
                                            @if(\App\Wallet::where('user_id',auth()->user()->id)->first()->balance > $paymentInfo['amount'])
                                                <form method="post" action="{{route('backend-wallet-flight-payment')}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="reference" value="{{$paymentInfo['reference']}}"/>
                                                    <input type="hidden" name="amount" value="{{$paymentInfo['amount']}}"/>
                                                    <button class="btn btn-alt-primary" type="submit"> <i class="ti-wallet"></i> Pay From Wallet</button>
                                                </form>
                                                @else
                                                <div class="alert alert-danger">
                                                    <p><strong><i class="fa fa-warning"></i> Insufficient Wallet Balance</strong>
                                                    You do not have enough money in your wallet to make this payment. Please select another payment option
                                                    </p>
                                                </div>
                                           @endif
                                       </div>

                                   </div>
                               </div>
                           </div>

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