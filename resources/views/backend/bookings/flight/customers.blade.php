@extends('layouts.backend')

@section('tab-title') Bookings @endsection

@section('title') My Flights Bookings Management @endsection

@section('content')

    @php

        $user = new \App\User();
        $sabreConfig = new \App\Services\SabreConfig();
        $role = new \App\Role();
    @endphp

    <div class="row">
        <div class="col-md-12">

        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    My Package Bookings
                </div>
                <div class="card-body">
                    <div class=" table-responsive dataTables_wrapper">
                        <table class="table dataTable ">
                            <thead>
                            <tr>
                                <th>Reference</th>
                                <th>PNR</th>
                                <th>Flights</th>
                                <th>Passengers</th>
                                <th>Base Price (₦)</th>
                                <th>Taxes (₦)</th>
                                <th>Discount (₦)</th>
                                <th>Amount Paid (₦)</th>
                                <th>Payment Status</th>
                                <th>Ticket Status</th>
                                <th>Actions</th>
                                <th>Booked On</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $serial => $booking)
                                @if($user->getUserProfileById($booking->user_id)['role'] == 'Customer')
                                    <tr>
                                        <td>{{$booking->reference}}</td>
                                        <td>

                                            @if($booking->pnr_status == 1)
                                                @if($booking->payment_status == 1)
                                                    <strong>{{$booking->pnr}}</strong>
                                                @else
                                                    @role('Super Admin')
                                                    <strong>{{$booking->pnr}}</strong>
                                                    @endrole
                                                    @role('Agent')
                                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Incomplete</span>
                                                    @endrole
                                                @endif
                                            @elseif($booking->pnr_status == 0)
                                                <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed / Incomplete</span>
                                            @endif
                                        </td>
                                        <td data-toggle="tooltip" title="View flights information">
                                            <button class="btn btn-info" data-toggle="modal" data-target="#flight_information_{{$booking->reference}}" ><i class="fa fa-plane"></i></button>
                                            <div class="modal fade" id="flight_information_{{$booking->reference}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content modal-lt ">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Flight(s) Information  -  <strong>{{date('Y', strtotime($booking->created_at))}}</strong></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            @if(isset(json_decode($booking->pnr_request_response, true)['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['ItineraryInfo']['ReservationItems']['Item'][0]))

                                                                @foreach(json_decode($booking->pnr_request_response, true)['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['ItineraryInfo']['ReservationItems']['Item'] as $f => $item)

                                                                    @if(isset($item['FlightSegment'][0]))
                                                                        @foreach($item['FlightSegment'] as $g => $ite)
                                                                            <ul class="external-searchlist" style="max-width: 770px;">
                                                                                <li>
                                                                                    <div class="name">
                                                                                        <a href="">{{\App\Airline::getAirline($ite['MarketingAirline']['@attributes']['Code'])}} ({{explode('.',$ite['@attributes']['ElapsedTime'])[0]}} hour(s) {{explode('.',$ite['@attributes']['ElapsedTime'])[1]}} minutes)</a>
                                                                                    </div>
                                                                                    <div class="url">
                                                                                        {{$ite['MarketingAirline']['@attributes']['Code']}}-{{$ite['@attributes']['FlightNumber']}}  ({{\App\Equipment::getEquipment($ite['Equipment']['@attributes']['AirEquipType'])}})
                                                                                    </div>
                                                                                    <div class="name">
                                                                                        <img src="{{\App\Services\SabreFlight::airlineImage($ite['MarketingAirline']['@attributes']['Code'])}}"/>
                                                                                    </div>
                                                                                    <div class="desc">
                                                                                        <table class="table table-striped">
                                                                                            <thead>
                                                                                            <tr>
                                                                                                <th>Departure/ Arrival</th>
                                                                                                <th>Airport/City</th>
                                                                                                <th>Date</th>
                                                                                                <th>Time</th>
                                                                                            </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td>Departure <i class="fa fa-plane"></i></td>
                                                                                                <td>{{\App\Airport::getCity($ite['OriginLocation']['@attributes']['LocationCode'])}}<br><small>{{$ite['OriginLocation']['@attributes']['LocationCode']}}</small></td>
                                                                                                <td>{{date('D, d M',strtotime($ite['@attributes']['DepartureDateTime']))}}</td>
                                                                                                <td>{{date('g:i A',strtotime($ite['@attributes']['DepartureDateTime']))}}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                                                <td>{{\App\Airport::getCity($ite['DestinationLocation']['@attributes']['LocationCode'])}}<br><small>{{$ite['DestinationLocation']['@attributes']['LocationCode']}}</small></td>
                                                                                                <td>{{date('D, d M',strtotime($ite['@attributes']['ArrivalDateTime']))}}</td>
                                                                                                <td>{{date('g:i A',strtotime($ite['@attributes']['ArrivalDateTime']))}}</td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>

                                                                                </li>
                                                                            </ul>

                                                                        @endforeach
                                                                    @else
                                                                        <ul class="external-searchlist" style="max-width: 770px;">
                                                                            <li>
                                                                                <div class="name">
                                                                                    <a href="">{{\App\Airline::getAirline($item['FlightSegment']['MarketingAirline']['@attributes']['Code'])}} ({{explode('.',$item['FlightSegment']['@attributes']['ElapsedTime'])[0]}} hour(s) {{explode('.',$item['FlightSegment']['@attributes']['ElapsedTime'])[1]}} minutes)</a>
                                                                                </div>
                                                                                <div class="url">
                                                                                    {{$item['FlightSegment']['MarketingAirline']['@attributes']['Code']}}-{{$item['FlightSegment']['@attributes']['FlightNumber']}}  ({{\App\Equipment::getEquipment($item['FlightSegment']['Equipment']['@attributes']['AirEquipType'])}})
                                                                                </div>
                                                                                <div class="name">
                                                                                    <img src="{{\App\Services\SabreFlight::airlineImage($item['FlightSegment']['MarketingAirline']['@attributes']['Code'])}}" style="max-height: 70px; max-width: 250px;"/>
                                                                                </div>
                                                                                <div class="desc">
                                                                                    <table class="table table-striped">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th>Departure/ Arrival</th>
                                                                                            <th>Airport/City</th>
                                                                                            <th>Date</th>
                                                                                            <th>Time</th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td>Departure <i class="fa fa-plane"></i></td>
                                                                                            <td>{{\App\Airport::getCity($item['FlightSegment']['OriginLocation']['@attributes']['LocationCode'])}}<br><small>{{$item['FlightSegment']['OriginLocation']['@attributes']['LocationCode']}}</small></td>
                                                                                            <td>{{date('D, d M',strtotime($item['FlightSegment']['@attributes']['DepartureDateTime']))}}</td>
                                                                                            <td>{{date('g:i A',strtotime($item['FlightSegment']['@attributes']['DepartureDateTime']))}}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                                            <td>{{\App\Airport::getCity($item['FlightSegment']['DestinationLocation']['@attributes']['LocationCode'])}}<br><small>{{$item['FlightSegment']['DestinationLocation']['@attributes']['LocationCode']}}</small></td>
                                                                                            <td>{{date('D, d M',strtotime($item['FlightSegment']['@attributes']['ArrivalDateTime']))}}</td>
                                                                                            <td>{{date('g:i A',strtotime($item['FlightSegment']['@attributes']['ArrivalDateTime']))}}</td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>

                                                                            </li>
                                                                        </ul>
                                                                    @endif


                                                                @endforeach
                                                            @else
                                                                @php $item = json_decode($booking->pnr_request_response, true)['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['ItineraryInfo']['ReservationItems']['Item']; @endphp
                                                                @if(isset($item['FlightSegment'][0]))
                                                                    @foreach($item['FlightSegment'] as $g => $ite)
                                                                        <ul class="external-searchlist" style="max-width: 770px;">
                                                                            <li>
                                                                                <div class="name">
                                                                                    <a href="">{{\App\Airline::getAirline($ite['MarketingAirline']['@attributes']['Code'])}} ({{explode('.',$ite['@attributes']['ElapsedTime'])[0]}} hour(s) explode('.',$ite['@attributes']['ElapsedTime'])[1]}} minutes)</a>
                                                                                </div>
                                                                                <div class="url">
                                                                                    {{$ite['MarketingAirline']['@attributes']['Code']}}-{{$ite['@attributes']['FlightNumber']}}  ({{\App\Equipment::getEquipment($ite['Equipment']['@attributes']['AirEquipType'])}})
                                                                                </div>
                                                                                <div class="name">
                                                                                    <img src="{{\App\Services\SabreFlight::airlineImage($ite['MarketingAirline']['@attributes']['Code'])}}" style="max-height: 70px; max-width: 250px;"/>
                                                                                </div>
                                                                                <div class="desc">
                                                                                    <table class="table table-striped">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th>Departure/ Arrival</th>
                                                                                            <th>Airport/City</th>
                                                                                            <th>Date</th>
                                                                                            <th>Time</th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td>Departure <i class="fa fa-plane"></i></td>
                                                                                            <td>{{\App\Airport::getCity($ite['OriginLocation']['@attributes']['LocationCode'])}}<br><small>{{$ite['OriginLocation']['@attributes']['LocationCode']}}</small></td>
                                                                                            <td>{{date('D, d M',strtotime($ite['@attributes']['DepartureDateTime']))}}</td>
                                                                                            <td>{{date('g:i A',strtotime($ite['@attributes']['DepartureDateTime']))}}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                                            <td>{{\App\Airport::getCity($ite['DestinationLocation']['@attributes']['LocationCode'])}}<br><small>{{$ite['DestinationLocation']['@attributes']['LocationCode']}}</small></td>
                                                                                            <td>{{date('D, d M',strtotime($ite['@attributes']['ArrivalDateTime']))}}</td>
                                                                                            <td>{{date('g:i A',strtotime($ite['@attributes']['ArrivalDateTime']))}}</td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>

                                                                            </li>
                                                                        </ul>
                                                                    @endforeach
                                                                @else
                                                                    <ul class="external-searchlist" style="max-width: 770px;">
                                                                        <li>
                                                                            <div class="name">
                                                                                <a href="">{{\App\Airline::getAirline($item['FlightSegment']['MarketingAirline']['@attributes']['Code'])}} ({{explode('.',$item['FlightSegment']['@attributes']['ElapsedTime'])[0]}} hour(s) {{explode('.',$item['FlightSegment']['@attributes']['ElapsedTime'])[1]}} minutes)</a>
                                                                            </div>
                                                                            <div class="url">
                                                                                {{$item['FlightSegment']['MarketingAirline']['@attributes']['Code']}}-{{$item['FlightSegment']['@attributes']['FlightNumber']}}  ({{\App\Equipment::getEquipment($item['FlightSegment']['Equipment']['@attributes']['AirEquipType'])}})
                                                                            </div>
                                                                            <div class="name">
                                                                                <img src="{{\App\Services\SabreFlight::airlineImage($item['FlightSegment']['MarketingAirline']['@attributes']['Code'])}}" style="max-height: 70px; max-width: 250px;"/>
                                                                            </div>
                                                                            <div class="desc">
                                                                                <table class="table table-striped">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>Departure/ Arrival</th>
                                                                                        <th>Airport/City</th>
                                                                                        <th>Date</th>
                                                                                        <th>Time</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td>Departure <i class="fa fa-plane"></i></td>
                                                                                        <td>{{\App\Airport::getCity($item['FlightSegment']['OriginLocation']['@attributes']['LocationCode'])}}<br><small>{{$item['FlightSegment']['OriginLocation']['@attributes']['LocationCode']}}</small></td>
                                                                                        <td>{{date('D, d M',strtotime($item['FlightSegment']['@attributes']['DepartureDateTime']))}}</td>
                                                                                        <td>{{date('g:i A',strtotime($item['FlightSegment']['@attributes']['DepartureDateTime']))}}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                                        <td>{{\App\Airport::getCity($item['FlightSegment']['DestinationLocation']['@attributes']['LocationCode'])}}<br><small>{{$item['FlightSegment']['DestinationLocation']['@attributes']['LocationCode']}}</small></td>
                                                                                        <td>{{date('D, d M',strtotime($item['FlightSegment']['@attributes']['ArrivalDateTime']))}}</td>
                                                                                        <td>{{date('g:i A',strtotime($item['FlightSegment']['@attributes']['ArrivalDateTime']))}}</td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>

                                                                        </li>
                                                                    </ul>
                                                                @endif

                                                            @endif

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-toggle="tooltip" title="View passengers details">
                                            <button class="btn btn-info" data-toggle="modal" data-target="#passenger_information_{{$booking->reference}}" title="view flights information"><i class="fa fa-users"></i></button>
                                            <div class="modal fade" id="passenger_information_{{$booking->reference}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content modal-lt ">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Passenger(s) Information</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if(isset(json_decode($booking->pnr_request_response, true)['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['CustomerInfo']['PersonName'][0]))
                                                                @foreach(json_decode($booking->pnr_request_response, true)['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['CustomerInfo']['PersonName'] as $p => $passengerInfo)
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h5>
                                                                                @if($passengerInfo['@attributes']['PassengerType'] == 'ADT')
                                                                                    ADULT <small>above 12 years old</small>
                                                                                @elseif($passengerInfo['@attributes']['PassengerType'] == 'CNN')
                                                                                    CHILD <small>2 - 12 years old</small>
                                                                                @elseif($passengerInfo['@attributes']['PassengerType'] == 'INF')
                                                                                    INFANT <small>below 2 years old</small>
                                                                                @endif
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <input class="form-control" disabled  value="{{$passengerInfo['Surname']}}"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <input class="form-control" disabled value="{{$passengerInfo['GivenName']}}"/>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <hr/>
                                                                @endforeach
                                                            @else
                                                                @php($passengerInfo = json_decode($booking->pnr_request_response, true)['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['CustomerInfo']['PersonName'])
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h5>
                                                                            @if($passengerInfo['@attributes']['PassengerType'] == 'ADT')
                                                                                ADULT <small>above 12 years old</small>
                                                                            @elseif($passengerInfo['@attributes']['PassengerType'] == 'CNN')
                                                                                CHILD <small>2 - 12 years old</small>
                                                                            @elseif($passengerInfo['@attributes']['PassengerType'] == 'INF')
                                                                                INFANT <small>below 2 years old</small>
                                                                            @endif
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <input class="form-control" disabled  value="{{$passengerInfo['Surname']}}"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <input class="form-control" disabled value="{{$passengerInfo['GivenName']}}"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr/>
                                                            @endif


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{number_format(($booking->itinerary_amount / 100),2)}}
                                        </td>
                                        <td>
                                            @if($booking->airline_markdown == 0)
                                                {{number_format((($booking->admin_markup + $booking->vat)/100), 2)}}
                                            @else
                                                {{number_format(($booking->vat/100),2)}}
                                            @endif
                                        </td>
                                        <td>
                                            {{number_format(($booking->airline_markdown/ 100),2)}}
                                        </td>
                                        <td>
                                            {{number_format(($booking->total_amount/100),2)}}
                                        </td>
                                        <td>
                                            @if($booking->payment_status == 1)
                                                <span class="badge badge-success"><i class="fa fa-success"></i> Success</span>
                                            @elseif($booking->payment_status == 0)
                                                <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed / Incomplete</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($booking->void_ticket_status == 0)
                                                @if($booking->issue_ticket_status == 1)
                                                    <span class="badge badge-success"><i class="fa fa-success"></i> Ticket Issued</span>
                                                @else
                                                    @if($booking->payment_status == 1)
                                                        <span class="badge badge-warning"><i class="fa fa-warning"></i> Pending</span>
                                                    @else
                                                        <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed</span>
                                                    @endif
                                                @endif
                                            @else
                                                @if($booking->cancel_ticket_status == 1)
                                                    <span class="badge badge-danger"><i class="fa fa-times"></i> Ticket Cancelled</span>
                                                @else
                                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Ticket Voided</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            {{--<button class="btn btn-primary" data-toggle="tooltip" title="Issue Ticket"><i class="fa fa-check"></i></button>--}}
                                            {{--<button class="btn btn-danger"  data-toggle="tooltip" title="Cancel Ticket"><i class="fa fa-trash"></i></button>--}}
                                            {{--<button class="btn btn-warning" data-toggle="tooltip" title="Void Ticket"><i class="fa fa-warning"></i></button>--}}
                                        </td>
                                        <td>{{date('d, D M Y, G:i A',strtotime($booking->created_at))}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection