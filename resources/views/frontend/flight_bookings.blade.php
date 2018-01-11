@extends('layouts.app')
@section('title')Flight Booking History @endsection
@section('content')
    <div class="gap gap-small"></div>
    <div class="container">
        <h1 class="page-title">Flights History</h1>
    </div>
    <div class="container">
        <div class="row">
            @include('partials.profileSideBar')
            <div class="col-md-9">
             <div style="overflow-x: scroll;">
                 <table class="table table-bordered table-striped table-booking-history data-table">
                     <thead>
                     <tr>
                         <th>Booking Reference</th>
                         <th>PNR Code</th>
                         <th>Base Amount</th>
                         <th>Tax and Fees</th>
                         <th>Discount</th>
                         <th>Total Amount</th>
                         <th>Payment Status</th>
                         <th>Ticket Status</th>
                         <th>Created Date</th>
                         <th>Starting Date / Time</th>
                         <th>Deadline</th>
                         <th>Flight Info</th>
                         <th>Passenger Info</th>
                         <th>Action</th>
                         <th>Setting</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach(\App\FlightBooking::getAllBookingsByUserId(auth()->user()->id) as $i => $flight)
                         <tr>
                             <td>{{$flight->reference}}</td>
                             <td>@if($flight->payment_status == 1) {{$flight->pnr}} @else <label class="label label-danger">Incomplete</label> @endif </td>
                             <td>&#x20A6;{{number_format($flight->itinerary_amount)}} </td>
                             <td>&#x20A6;{{number_format(($flight->admin_markup + $flight->vat))}}</td>
                             <td>&#x20A6;{{number_format($flight->airline_markdown)}} </td>
                             <td>&#x20A6; {{number_format($flight->total_amount)}}</td>
                             <td class="text-center">@if($flight->payment_status == 1) <i class="fa fa-check"></i> @else <i class="fa fa-times"></i> @endif </td>
                             <td class="text-center">   @if($flight->issue_ticket_status == 1) <i class="fa fa-check"></i> @else <i class="fa fa-times"></i> @endif </td>
                             <td>{{date('M d, Y',strtotime($flight->created_at))}}</td>
                             <td>Jan 17 2017, 10 am</td>
                             <td>Jan 17 2017, 10 am</td>
                             <td>
                                 @if($flight->payment_status == 1)  <a class="btn btn-default popup-text" href="#flights-info-{{$flight->id}}" data-effect="mfp-zoom-out"  title="Flights"> <i class="fa fa-plane"></i> <i class="fa fa-plane fa-flip-vertical"></i></a> @else <label class="label label-danger">Incomplete</label> @endif
                             </td>
                             <td>
                                 @if($flight->payment_status == 1)  <a class="btn btn-default popup-text" href="#passengers-info-{{$flight->id}}" data-effect="mfp-zoom-out" title="Passengers"> <i class="fa fa-users"></i></a> @else <label class="label label-danger">Incomplete</label> @endif
                             </td>
                             <td>
                                 @if($flight->payment_status == 1)  <button class="btn btn-default" type="button"><i class="fa fa-plane"></i> Ticket</button>@else <label class="label label-danger">Incomplete</label> @endif
                             </td>
                             <td>
                                 @if($flight->payment_status == 1)  <button class="btn btn-default" type="button"><i class="fa fa-cog"></i> Edit</button>@else <label class="label label-danger">Incomplete</label> @endif
                             </td>
                             <div class="mfp-with-anim mfp-hide mfp-dialog mfp-search-dialog" id="flights-info-{{$flight->id}}">
                                 <div class="booking-item-payment">
                                     <header class="clearfix">
                                         <h5 class="mb0">Flight Origins and Destinations Information</h5>
                                     </header>
                                     <ul class="booking-item-payment-details">
                                         <li>
                                             <h5>Flight Details</h5>
                                             <div class="booking-item-payment-flight">
                                                 @if(isset(json_decode($flight->pnr_request_response, true)['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['ItineraryInfo']['ReservationItems']['Item'][0]))
                                                     @foreach(json_decode($flight->pnr_request_response, true)['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['ItineraryInfo']['ReservationItems']['Item'] as $f => $item)
                                                         @if(isset($item['FlightSegment'][0]))
                                                             @foreach($item['FlightSegment'] as $g => $ite)
                                                                 <div class="row">
                                                                 <div class="col-md-9">
                                                                 <div class="booking-item-flight-details">
                                                                 <div class="booking-item-departure"><i class="fa fa-plane"></i>

                                                                 <h5>{{date('g:i A',strtotime($ite['@attributes']['DepartureDateTime']))}}</h5>
                                                                 <p class="booking-item-date">{{date('D, M d',strtotime($ite['@attributes']['DepartureDateTime']))}}</p>
                                                                 <p class="booking-item-destination">{{\App\Airport::getCity($ite['OriginLocation']['@attributes']['LocationCode'])}}({{$ite['OriginLocation']['@attributes']['LocationCode']}}) {{--{{$ite['OriginLocation']['@attributes']['Terminal']}}--}}</p>
                                                                 </div>
                                                                 <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                                 <h5>{{date('g:i A',strtotime($ite['@attributes']['ArrivalDateTime']))}}</h5>
                                                                 <p class="booking-item-date">{{date('D, M d',strtotime($ite['@attributes']['ArrivalDateTime']))}}</p>
                                                                 <p class="booking-item-destination">{{\App\Airport::getCity($ite['DestinationLocation']['@attributes']['LocationCode'])}}({{$ite['DestinationLocation']['@attributes']['LocationCode']}}) {{--{{$ite['DestinationLocation']['@attributes']['Terminal']}}--}}</p>
                                                                 </div>
                                                                 </div>
                                                                 </div>
                                                                 <div class="col-md-3">
                                                                 <div class="booking-item-flight-duration">
                                                                 <p>Duration</p>
                                                                 <h5>{{$ite['@attributes']['ElapsedTime']}}</h5>
                                                                 </div>
                                                                 </div>
                                                                 </div>
                                                             @endforeach
                                                             @else
                                                                     <div class="row">
                                                                     <div class="col-md-9">
                                                                     <div class="booking-item-flight-details">
                                                                     <div class="booking-item-departure"><i class="fa fa-plane"></i>

                                                                     <h5>{{date('g:i A',strtotime($item['FlightSegment']['@attributes']['DepartureDateTime']))}}</h5>
                                                                     <p class="booking-item-date">{{date('D, M d',strtotime($item['FlightSegment']['@attributes']['DepartureDateTime']))}}</p>
                                                                     <p class="booking-item-destination">{{\App\Airport::getCity($item['FlightSegment']['OriginLocation']['@attributes']['LocationCode'])}}({{$item['FlightSegment']['OriginLocation']['@attributes']['LocationCode']}}) {{--{{$item['FlightSegment']['OriginLocation']['@attributes']['Terminal']}}--}}</p>
                                                                     </div>
                                                                     <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                                     <h5>{{date('g:i A',strtotime($item['FlightSegment']['@attributes']['ArrivalDateTime']))}}</h5>
                                                                     <p class="booking-item-date">{{date('D, M d',strtotime($item['FlightSegment']['@attributes']['ArrivalDateTime']))}}</p>
                                                                     <p class="booking-item-destination">{{\App\Airport::getCity($item['FlightSegment']['DestinationLocation']['@attributes']['LocationCode'])}}({{$item['FlightSegment']['DestinationLocation']['@attributes']['LocationCode']}}) {{--{{$item['FlightSegment']['DestinationLocation']['@attributes']['Terminal']}}--}}</p>
                                                                     </div>
                                                                     </div>
                                                                     </div>
                                                                     <div class="col-md-3">
                                                                     <div class="booking-item-flight-duration">
                                                                     <p>Duration</p>
                                                                     <h5>{{$item['FlightSegment']['@attributes']['ElapsedTime']}}</h5>
                                                                     </div>
                                                                     </div>
                                                                     </div>
                                                             @endif

                                                         @endforeach

                                                 @else

                                                     @endif
                                             </div>
                                         </li>
                                     </ul>
                                 </div>

                             </div>
                             <div class="mfp-with-anim mfp-hide mfp-dialog mfp-search-dialog" id="passengers-info-{{$flight->id}}">
                                 <h3>Passenger Information</h3>
                                 <ul class="list booking-item-passengers">
                                     @if(isset(json_decode($flight->pnr_request_response, true)['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['CustomerInfo']['PersonName'][0]))
                                     @foreach(json_decode($flight->pnr_request_response, true)['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['CustomerInfo']['PersonName'] as $p => $passengerInfo)
                                         <li>
                                             <div class="row">
                                                 <div class="col-md-12">
                                                     <p class="text-bigger"> @if($passengerInfo['@attributes']['PassengerType'] == 'ADT') ADULT <small>above 12 years old</small> @elseif($passengerInfo['@attributes']['PassengerType'] == 'CNN')CHILD <small>2 - 12 years old</small> @elseif($passengerInfo['@attributes']['PassengerType'] == 'INF') INFANT <small>below 2 years old</small> @endif </p>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                         <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                                             <label>Surname</label>
                                                             <input class="form-control" disabled required value="{{$passengerInfo['Surname']}}" type="text" />
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                         <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                                             <label>Given name</label>
                                                             <input class="form-control" disabled required value="{{$passengerInfo['GivenName']}}" type="text" />
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </li>
                                         @endforeach
                                         @else
                                         @php($passengerInfo = json_decode($flight->pnr_request_response, true)['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['CustomerInfo']['PersonName'])
                                         <li>
                                             <div class="row">
                                                 <div class="col-md-12">
                                                     <p class="text-bigger"> @if($passengerInfo['@attributes']['PassengerType'] == 'ADT') ADULT <small>above 12 years old</small> @elseif($passengerInfo['@attributes']['PassengerType'] == 'CNN')CHILD <small>2 - 12 years old</small> @elseif($passengerInfo['@attributes']['PassengerType'] == 'INF') INFANT <small>below 2 years old</small> @endif </p>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                         <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                                             <label>Surname</label>
                                                             <input class="form-control" disabled required value="{{$passengerInfo['Surname']}}" type="text" />
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                         <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                                             <label>Given name</label>
                                                             <input class="form-control" disabled required value="{{$passengerInfo['GivenName']}}" type="text" />
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </li>
                                         @endif


                                 </ul>

                             </div>
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