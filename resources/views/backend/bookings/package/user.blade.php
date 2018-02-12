@extends('layouts.backend')

@section('tab-title') Bookings @endsection

@section('title') My Package Bookings Management @endsection

@section('content')

    @php

    $user = new \App\User();
    $sabreConfig = new \App\Services\SabreConfig();
    $role = new \App\Role();

    @endphp

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   My Package Bookings
                </div>
                <div class="card-body">
                    <div class=" table-responsive  dataTables_wrapper">
                        <table class="table dataTable ">
                            <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Package Name</th>
                                <th>Contact Number</th>
                                <th>Includes</th>
                                <th>Adults</th>
                                <th>Children</th>
                                <th>Infants</th>
                                <th>Price (₦)</th>
                                <th>Status</th>
                                <th>Booked on</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $serial => $booking)
                                @if($booking->user_id === auth()->user()->id)
                                    <tr>
                                        <td>{{$booking->reference}}</td>
                                        <td>{{ \App\TravelPackage::find($booking->package_id)->name}}</td>
                                        <td>{{ \App\TravelPackage::find($booking->package_id)->phone_number}}</td>
                                        <td>
                                            @if(\App\TravelPackage::find($booking->package_id)->flight == 1)
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#flight_{{$booking->id}}" type="button"><i class="fa fa-plane"></i></button>
                                                <div class="modal fade" id="flight_{{$booking->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content modal-lt ">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Flight Information</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <img class="img-responsive" src="{{$sabreConfig::cityImage($sabreConfig::iataCode(\App\FlightDeal::getByPackageId($booking->package_id)->destination))}}" style="max-width: 300px; max-height: 250px;" alt="Generic placeholder image">
                                                                    </div>
                                                                    <div class="col-md-12">

                                                                        <h5>{{\App\TravelPackage::find($booking->package_id)->name}}</h5>
                                                                        <div class="text-muted "><small>{{date('d,D M Y G:i A',strtotime(\App\FlightDeal::getByPackageId($booking->package_id)->date))}} - by <strong>{{\App\FlightDeal::getByPackageId($booking->package_id)->airline}}</strong></small></div>
                                                                        <p><strong>From :</strong> {{\App\FlightDeal::getByPackageId($booking->package_id)->origin}}</p>
                                                                        <p><strong>To :</strong>{{\App\FlightDeal::getByPackageId($booking->package_id)->destination}}</p>
                                                                        <p>{{\App\FlightDeal::getByPackageId($booking->package_id)->information}}</p>
                                                                        <p>{{$booking->info}}</p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(\App\TravelPackage::find($booking->package_id)->hotel == 1)
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#hotel_{{$booking->id}}" type="button"><i class="fa fa-hotel"></i></button>
                                                <div class="modal fade" id="hotel_{{$booking->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content modal-lt ">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Hotel Information</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        @if(isset(App\Gallery::getGalleryByPackageId($booking->package_id)[0]))

                                                                            <img src="{{asset(App\Gallery::getGalleryByPackageId($booking->package_id)[0]['image_path'])}}" style="max-width: 300px; max-height: 250px;" alt="{{\App\TravelPackage::find($booking->package_id)->name}}" title="{{\App\TravelPackage::find($booking->package_id)->name}}" />
                                                                        @else
                                                                            <img src="{{$sabreConfig::cityImage($sabreConfig::iataCode(\App\HotelDeal::getByPackageId($booking->package_id)->city))}}" style="max-width: 300px; max-height: 250px;" alt="{{\App\TravelPackage::find($booking->package_id)->name}}" title="{{\App\TravelPackage::find($booking->package_id)->name}}" />
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-12">

                                                                        <h5>{{\App\TravelPackage::find($booking->package_id)->name}}
                                                                            <small>{{\App\HotelDeal::getByPackageId($booking->package_id)->name}} - with <strong>{{\App\HotelDeal::getByPackageId($booking->package_id)->star_rating}} star rating</strong></small>
                                                                        </h5>
                                                                        <p><strong>Check In :</strong> {{date('d,D M Y G:i A',strtotime(\App\HotelDeal::getByPackageId($booking->package_id)->stay_start_date))}}</p>
                                                                        <p><strong>Check Out :</strong> {{date('d,D M Y G:i A',strtotime(\App\HotelDeal::getByPackageId($booking->package_id)->stay_end_date))}}</p>
                                                                        <p><strong>Address :</strong> {{\App\HotelDeal::getByPackageId($booking->package_id)->address}}</p>
                                                                        <p><strong>Information :</strong>{{\App\HotelDeal::getByPackageId($booking->package_id)->information}}</p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(\App\TravelPackage::find($booking->package_id)->attraction == 1)
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#attraction_{{$booking->id}}" type="button"><i class="fa fa-suitcase"></i></button>
                                                <div class="modal fade" id="attraction_{{$booking->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content modal-lt ">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Attraction Information</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <img class="img-responsive" src="{{$sabreConfig::cityImage($sabreConfig::iataCode(\App\Attraction::getByPackageId($booking->package_id)->city))}}" style="max-width: 300px; max-height: 250px;" alt="{{\App\Attraction::getByPackageId($booking->package_id)->name}}">
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <h5>{{\App\TravelPackage::find($booking->package_id)->name}} - <small>{{\App\Attraction::getByPackageId($booking->package_id)->name}}</small></h5>
                                                                       @foreach(\App\SightSeeing::getSightseeingByPackageId($booking->package_id) as $serial => $sightSeeing)
                                                                            <hr/>
                                                                            <h6>Sight Seeings</h6>
                                                                            <strong>{{$sightSeeing->title}}</strong>
                                                                            <p style="">{{$sightSeeing->description}}</p>
                                                                        @endforeach
                                                                        <hr/>
                                                                        <strong>Attraction Information</strong>
                                                                        <p>{{\App\Attraction::getByPackageId($booking->package_id)->information}}</p>
                                                                        <hr/>
                                                                        <strong>Package Information</strong>
                                                                        <p>{{$booking->info}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                        </td>
                                        <td>{{$booking->adults}}</td>
                                        <td>{{$booking->children}}</td>
                                        <td>{{$booking->infants}}</td>
                                        <td>{{number_format(($booking->total_amount / 100))}}</td>
                                        <td>
                                            @if($booking->payment_status == 1)
                                                <span class="badge badge-success"><i class="fa fa-check"></i> successful</span>
                                            @else
                                                <span class="badge badge-danger"><i class="fa fa-times"></i> failed</span>
                                            @endif
                                        </td>
                                        <td>{{date('d,m Y G:i A',strtotime($booking->created_at))}}</td>
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