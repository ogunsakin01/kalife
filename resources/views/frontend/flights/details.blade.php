@extends('layouts.app')
@section('title') Flight Details @endsection
@section('activeFlight') active @endsection
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a>
            </li>
            <li><a href="{{url('/flights')}}">Flight Deals</a>
            </li>
            <li class="active"><a>{{$name}}</a>
            </li>
        </ul>
        <div class="booking-item-details">
            <header class="booking-item-header">
                <div class="row">
                    <div class="col-md-9">
                        <h2 class="lh1em">{{$name}}</h2>
                        {{--<p class="lh1em text-small"><i class="fa fa-map-marker"></i>{{$flight_info->info}}</p>--}}
                        <ul class="list list-inline text-small">
                            {{--<li><a href="#"><i class="fa fa-envelope"></i> Owner E-mail</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="#"><i class="fa fa-home"></i> Owner Website</a>--}}
                            {{--</li>--}}
                            <li><i class="fa fa-phone"></i> {{$flight_info->phone_number}}</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p class="booking-item-header-price"><small>price from</small>  <span class="text-lg"> &#x20A6;{{number_format($flight_info->adult_price)}}</span>
                        </p>
                    </div>
                </div>
            </header>
            <div class="row">
                <div class="col-md-7">
                    <ul class="booking-list">
                        <li>
                            <div class="booking-item-container">
                                <div class="booking-item">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="booking-item-airline-logo">
                                                @if(!empty(\App\Airline::getAirlineCodeByName($flight->airline)->IATA) || !is_null(\App\Airline::getAirlineCodeByName($flight->airline)->IATA))
                                                    <img src=" {{\App\Services\SabreFlight::airlineImage(\App\Airline::getAirlineCodeByName($flight->airline)->IATA)}}" class="img-responsive" alt="{{$flight->name}}" title="{{$flight->name}}" />
                                                @else
                                                    <img src="{{asset('images/gallery/packages/no-image.jpg')}}" alt="{{$flight->name}}" class="img-responsive" title="{{$flight->name}}" />
                                                @endif
                                                <h5>{{$flight->airline}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <table class="table">
                                               <tbody>
                                               <tr>
                                                   <th>Departure Airport </th>
                                                   <td>: {{$flight->origin}}</td>
                                               </tr>
                                               <tr>
                                                   <th>Departure Date</th>
                                                   <td>: {{date('D d, M Y  g:i A',strtotime($flight->date))}}</td>
                                               </tr>
                                               <tr>
                                                   <th>Destination Airport</th>
                                                   <td>: {{$flight->destination}}</td>
                                               </tr>
                                               <tr>
                                                   <th>Cabin </th>
                                                   <td>: {{\App\CabinType::getCabinByCode($flight->cabin)->cabin_name}}</td>
                                               </tr>

                                               </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    </p>
                </div>

                <div class="col-md-5">
                    <div class="booking-item-meta">
                        <h2 class="lh1em mt40">{{\App\PackageCategory::find($flight_info->category_id)->category}}</h2>
                        <h3>Kalife <small > recommends</small></h3>
                        <div class="booking-item-rating">
                            <ul class="icon-list icon-group booking-item-rating-stars">
                                <li><i class="fa fa-star-half-empty"></i>
                                </li>
                                <li><i class="fa fa-star-half-empty"></i>
                                </li>
                                <li><i class="fa fa-star-half-empty"></i>
                                </li>
                                <li><i class="fa fa-star-half-empty"></i>
                                </li>
                                <li><i class="fa fa-star-half-empty"></i>
                                </li>
                            </ul>
                            <span class="booking-item-rating-number">
                                <b >none</b> of none
                                <small class="text-smaller"></small>
                            </span>
                            <p><a class="text-default" href="#"></a>
                            </p>
                        </div>
                    </div>

                    <a href="{{url('/book-package/'.$id.'/'.$name)}}" class="btn btn-primary btn-lg">Book flight</a>
                </div>
            </div>
        </div>
        <div class="gap"></div>

        <div class="row">
            <div class="col-md-12">

                    <h3>Flight Information</h3>
                    <p> {{$flight->information}}</p>

            </div>
            <div class="col-md-12">
                <h3>Travel Package Information</h3>
                <p class="text text-darken">
                    {{$flight_info->information}}
                </p>
            </div>
            <div class="col-md-12">
                <p class="text-right">Want a search of your choice ? <a class="popup-text" href="#flight-search-dialog" data-effect="mfp-zoom-out">Click Here</a></p>
            </div>
        </div>
        <div class="gap gap-small"></div>

    </div>
    <script>
        var customLatitude = '6.45407';
        var customLongitude = '3.39467';
    </script>
@endsection