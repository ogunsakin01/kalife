@extends('layouts.app')
@section('title')Package Booking History @endsection
@section('packageBooking') active @endsection
@section('content')
    <div class="gap gap-small"></div>
    <div class="container">
        <h4 class="page-title">Packages Booking History</h4>
    </div>
    <div class="container">
        <div class="row">
            @include('partials.profileSideBar')
            <div class="col-md-9">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-booking-history data-table well">
                            <thead>
                            <tr>
                                <th>Booking Reference</th>
                                <th>Package Name</th>
                                <th>Contact Number</th>
                                <th>Includes</th>
                                <th>Adults</th>
                                <th>Children</th>
                                <th>Infants</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach(\App\PackageBooking::getUserBookingsById(auth()->user()->id) as $i => $booking)
                                <tr>
                                    <td>{{$booking->reference}}</td>
                                    <td>{{\App\TravelPackage::find($booking->package_id)->name}}</td>
                                    <td>{{\App\TravelPackage::find($booking->package_id)->phone_number}}</td>
                                    <td>
                                        @if(\App\TravelPackage::find($booking->package_id)->flight == 1)     <button class="btn btn-default" data-toggle="title" title="Includes flight"><i class="fa fa-plane"></i></button>            @endif
                                        @if(\App\TravelPackage::find($booking->package_id)->hotel == 1)      <button class="btn btn-default" data-toggle="title" title="Includes hotel"><i class="fa fa-home"></i></button>              @endif
                                        @if(\App\TravelPackage::find($booking->package_id)->attraction == 1) <button class="btn btn-default" data-toggle="title" title="Includes attraction"><i class="fa fa-map-marker"></i></button>   @endif
                                    </td>
                                    <td>{{$booking->adults}}</td>
                                    <td>{{$booking->children}}</td>
                                    <td>{{$booking->infants}}</td>
                                    <td>&#x20A6;{{number_format(($booking->total_amount / 100),2)}}</td>

                                    <td>@if($booking->payment_status == 1)
                                            <label class="label label-success"><i class="fa fa-check"></i> Successful</label>
                                        @else
                                            <label class="label label-danger"> Failed</label>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-default" type="button"><i class="fa fa-cog"></i> More INfo</button>
                                    </td>



                                    {{--<div class="mfp-with-anim mfp-hide mfp-dialog mfp-search-dialog" id="flights-info-{{$booking->id}}">--}}
                                    {{--<div class="booking-item-payment">--}}
                                    {{--<header class="clearfix">--}}
                                    {{--<h5 class="mb0">Flight Origins and Destinations Information</h5>--}}
                                    {{--</header>--}}
                                    {{--<ul class="booking-item-payment-details">--}}
                                    {{--<li>--}}
                                    {{--<h5>Flight Details</h5>--}}
                                    {{--<div class="booking-item-payment-flight">--}}
                                    {{--@if(isset(json_decode($flight->pnr_request_response, true)['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['ItineraryInfo']['ReservationItems']['Item'][0]))--}}
                                    {{--@foreach(json_decode($flight->pnr_request_response, true)['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['ItineraryInfo']['ReservationItems']['Item'] as $f => $item)--}}
                                    {{--@if(isset($item['FlightSegment'][0]))--}}
                                    {{--@foreach($item['FlightSegment'] as $g => $ite)--}}
                                    {{--<div class="row">--}}
                                    {{--<div class="col-md-9">--}}
                                    {{--<div class="booking-item-flight-details">--}}
                                    {{--<div class="booking-item-departure"><i class="fa fa-plane"></i>--}}

                                    {{--<h5>{{date('g:i A',strtotime($ite['@attributes']['DepartureDateTime']))}}</h5>--}}
                                    {{--<p class="booking-item-date">{{date('D, M d',strtotime($ite['@attributes']['DepartureDateTime']))}}</p>--}}
                                    {{--<p class="booking-item-destination">{{\App\Airport::getCity($ite['OriginLocation']['@attributes']['LocationCode'])}}({{$ite['OriginLocation']['@attributes']['LocationCode']}}) {{$ite['OriginLocation']['@attributes']['Terminal']}}</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>--}}
                                    {{--<h5>{{date('g:i A',strtotime($ite['@attributes']['ArrivalDateTime']))}}</h5>--}}
                                    {{--<p class="booking-item-date">{{date('D, M d',strtotime($ite['@attributes']['ArrivalDateTime']))}}</p>--}}
                                    {{--<p class="booking-item-destination">{{\App\Airport::getCity($ite['DestinationLocation']['@attributes']['LocationCode'])}}({{$ite['DestinationLocation']['@attributes']['LocationCode']}}) {{$ite['DestinationLocation']['@attributes']['Terminal']}}</p>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-3">--}}
                                    {{--<div class="booking-item-flight-duration">--}}
                                    {{--<p>Duration</p>--}}
                                    {{--<h5>{{$ite['@attributes']['ElapsedTime']}}</h5>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--@endforeach--}}
                                    {{--@else--}}
                                    {{--<div class="row">--}}
                                    {{--<div class="col-md-9">--}}
                                    {{--<div class="booking-item-flight-details">--}}
                                    {{--<div class="booking-item-departure"><i class="fa fa-plane"></i>--}}

                                    {{--<h5>{{date('g:i A',strtotime($item['FlightSegment']['@attributes']['DepartureDateTime']))}}</h5>--}}
                                    {{--<p class="booking-item-date">{{date('D, M d',strtotime($item['FlightSegment']['@attributes']['DepartureDateTime']))}}</p>--}}
                                    {{--<p class="booking-item-destination">{{\App\Airport::getCity($item['FlightSegment']['OriginLocation']['@attributes']['LocationCode'])}}({{$item['FlightSegment']['OriginLocation']['@attributes']['LocationCode']}}) {{$item['FlightSegment']['OriginLocation']['@attributes']['Terminal']}}</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>--}}
                                    {{--<h5>{{date('g:i A',strtotime($item['FlightSegment']['@attributes']['ArrivalDateTime']))}}</h5>--}}
                                    {{--<p class="booking-item-date">{{date('D, M d',strtotime($item['FlightSegment']['@attributes']['ArrivalDateTime']))}}</p>--}}
                                    {{--<p class="booking-item-destination">{{\App\Airport::getCity($item['FlightSegment']['DestinationLocation']['@attributes']['LocationCode'])}}({{$item['FlightSegment']['DestinationLocation']['@attributes']['LocationCode']}}) {{$item['FlightSegment']['DestinationLocation']['@attributes']['Terminal']}}</p>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-3">--}}
                                    {{--<div class="booking-item-flight-duration">--}}
                                    {{--<p>Duration</p>--}}
                                    {{--<h5>{{$item['FlightSegment']['@attributes']['ElapsedTime']}}</h5>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--@endif--}}

                                    {{--@endforeach--}}

                                    {{--@else--}}

                                    {{--@endif--}}
                                    {{--</div>--}}
                                    {{--</li>--}}
                                    {{--</ul>--}}
                                    {{--</div>--}}

                                    {{--</div>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>

        </div>
    </div>
    <div class="gap"></div>
@endsection