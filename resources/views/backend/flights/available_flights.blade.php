@extends('layouts.backend')
@section('tab-title')Flights @endsection

@section('title')Available Flights @endsection
@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Stopovers   <small class="pull-right">Prices from</small>
                </div>
                <div class="card-body">
                    <div class="form-check selected_airline">
                        <label class="form-check-label">
                                  <span>
                                    <input class="form-check-input all_check stops" type="checkbox" value="0">
                                     No stopover ({{\App\Services\SabreFlight::minimumPrice('stops','0',$flightsResult)['number']}})
                                  </span>
                        </label>
                        <small class="pull-right">&#x20A6; {{number_format(\App\Services\SabreFlight::minimumPrice('stops','0',$flightsResult)['minimumPrice'])}}</small>
                    </div>
                    <div class="form-check selected_airline">
                        <label class="form-check-label">
                                  <span>
                                    <input class="form-check-input all_check stops" type="checkbox" value="1">
                                     1 stopover ({{\App\Services\SabreFlight::minimumPrice('stops','1',$flightsResult)['number']}})
                                  </span>
                        </label>
                        <small class="pull-right">&#x20A6; {{number_format(\App\Services\SabreFlight::minimumPrice('stops','1',$flightsResult)['minimumPrice'])}}</small>
                    </div>
                    <div class="form-check selected_airline">
                        <label class="form-check-label">
                                  <span>
                                    <input class="form-check-input all_check stops" type="checkbox" value="2">
                                     2 stopovers ({{\App\Services\SabreFlight::minimumPrice('stops','2',$flightsResult)['number']}})
                                  </span>
                        </label>
                        <small class="pull-right">&#x20A6; {{number_format(\App\Services\SabreFlight::minimumPrice('stops','2',$flightsResult)['minimumPrice'])}}</small>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                  Airlines <i class="to_spin"></i>  <small class="pull-right">Prices from</small>
                </div>
                <div class="card-body">
                    <div class="form-check selected_airline">
                        <label class="form-check-label">
                                  <span>
                                    <input class="form-check-input all_check all_flights" type="checkbox" checked value="">
                                     All Airlines Found ({{count($flightsResult)}})

                                  </span>
                        </label>
                    </div>
                     @foreach($airlines as $i => $airline)
                            <div class="form-check selected_airline">
                                <label class="form-check-label">
                                  <span>
                                    <input class="form-check-input all_check selected_airline" type="checkbox" value="{{$airline}}">
                                    {{\App\Airline::getAirline($airline)}} ({{\App\Services\SabreFlight::minimumPrice('airline',$airline,$flightsResult)['number']}})

                                  </span>
                                </label>
                                <small class="pull-right">&#x20A6; {{number_format(\App\Services\SabreFlight::minimumPrice('airline',$airline,$flightsResult)['minimumPrice'])}}</small>

                            </div>
                            @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <strong><i class="fa fa-plane"></i> {{count($flightsResult)}} flights found</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($flightsResult as $serial => $flight)
                            <div class="card flights_{{$flight[0]['airline']}} {{"flights_".$flight[0]['totalPrice']}} {{"flights_".$flight[0]['stops']}} flights flight_{{$serial}}">
                                <div class="card-header">
                                    <div class="loader_{{$serial}}"></div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="{{\App\Services\SabreFlight::airlineImage($flight[0]['airline'])}}" style="max-height: 85px;" class="img-responsive" alt="{{$flight[0]['airline']}}" title="{{$flight[0]['airline']}}" />
                                            <p>{{\App\Airline::getAirline($flight[0]['airline'])}}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="text">
                                                <h6 class="bolded">
                                                    <i class="fa fa-plane"></i> {{date('g:i A',strtotime($flight[1][0][0]['departureDateTime']))}}<br/>
                                                    <small>{{date('D, M d',strtotime($flight[1][0][0]['departureDateTime']))}}</small>
                                                </h6>
                                                <h6>{{\App\Airport::getCity($flight[1][0][0]['departureAirport'])}}({{$flight[1][0][0]['departureAirport']}})</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="text">
                                                <h6 class="bolded">
                                                    <i class="fa fa-plane fa-flip-vertical"></i> {{date('g:i A',strtotime($flight[1][0][0]['arrivalDateTime']))}} <br/>
                                                    <small>{{date('D, M d',strtotime($flight[1][0][0]['arrivalDateTime']))}}</small>
                                                </h6>
                                                <h6>{{\App\Airport::getCity($flight[1][0][0]['arrivalAirport'])}}({{$flight[1][0][0]['arrivalAirport']}})</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="text">
                                                <h5 class="bolded"><i class="fa fa-clock-o"></i> {{$flight[1][0][0]['timeDuration']}}</h5>
                                                <h6>{{$flight[0]['stops']}} stop(s)</h6>

                                                <h3 style="color: #1a5ae4;">&#x20A6;
                                                    @role('Agent')
                                                    {{number_format($flight[0]['adminToAgentSumTotal'])}}
                                                    @endrole
                                                    @role('Super Admin')
                                                    {{number_format($flight[0]['adminToAdminSumTotal'])}}
                                                    @endrole
                                                    <br>
                                                    <small>Cabin : {{\App\Services\SabreFlight::cabinType(session()->get('flightSearchParam')['cabin_type'])}}</small>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <button class="btn btn-block btn-info collapsed" type="button" data-toggle="collapse" data-target="#flight_{{$serial}}" aria-expanded="false" aria-controls="collapseExample">
                                                More Info
                                            </button>
                                        </div>
                                        <div class="col-sm-4">
                                        <button value="{{$serial}}" class="btn btn-primary btn-block itinerary_select">Proceed <i class="fa fa-arrow-right"></i></button>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="collapse" id="flight_{{$serial}}">
                                                <div class="card card-body">
                                                    <div class="row">
                                                        @foreach($flight[1] as $originDestination => $originDest)
                                                            @foreach($originDest as $segmentInfo => $segment)
                                                        <div class="col-md-6">
                                                            <ul class="external-searchlist">
                                                                <li>
                                                                    <div class="name">
                                                                        <a href="#">{{$segment['operatingAirline']}} - {{$segment['flightNumber']}}  </a>
                                                                    </div>
                                                                    <div class="url">
                                                                        {{\App\Airline::getAirline($segment['operatingAirline'])}}
                                                                       <br/> <small>Duration :  ({{$segment['timeDuration']}}) </small>
                                                                    </div>
                                                                    <div class="name">
                                                                        {{\App\Services\SabreFlight::cabinType(session()->get('flightSearchParam')['cabin_type'])}}
                                                                        ({{session()->get('flightSearchParam')['cabin_type']}}),
                                                                        {{\App\Equipment::getEquipment($segment['equipment'])}}
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
                                                                                <td>{{\App\Airport::getCity($segment['departureAirport'])}} ({{$segment['departureAirport']}})</td>
                                                                                <td>{{date('D, d M',strtotime($segment['departureDateTime']))}}</td>
                                                                                <td>{{date('g:i A',strtotime($segment['departureDateTime']))}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                                <td> {{\App\Airport::getCity($segment['arrivalAirport'])}} ({{$segment['arrivalAirport']}})</td>
                                                                                <td>{{date('D, d M',strtotime($segment['arrivalDateTime']))}}</td>
                                                                                <td>{{date('g:i A',strtotime($segment['arrivalDateTime']))}}</td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>

                                                                </li>
                                                            </ul>
                                                        </div>
                                                             @endforeach
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script src="{{asset('backend/js/home.js')}}"></script>
@endsection