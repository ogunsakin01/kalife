@extends('layouts.backend')

@section('tab-title')Home @endsection

@section('title')My Dashboard @endsection

@section('content')

  @role('Super Admin')
  <div class="row">
    <div class="col-md-4">
      <div class="card stats-card">
        <div class="stats-icon">
          <span class="fa fa-plane"></span>
        </div>
        <div class="stats-ctn">
          <div class="stats-counter"><span class="counter">{{$allFlightBookings}}</span></div>
          <span class="desc">All Flight bookings</span>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card stats-card">
        <div class="stats-icon">
          <span class="ti-briefcase"></span>
        </div>
        <div class="stats-ctn">
          <div class="stats-counter"><span class="counter">{{$allPackagesBookings}}</span></div>
          <span class="desc">All Packages bookings</span>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <a href="{{route('backend-wallet-view')}}">
      <div class="card stats-card">
        <div class="stats-icon">
          <span class="ti-wallet"></span>
        </div>
        <div class="stats-ctn">
          <div class="stats-counter">&#x20A6;<span class="counter">{{number_format(($userWalletBalance/100))}}</span></div>
          <span class="desc">My Wallet</span>
        </div>
      </div>
      </a>
    </div>
  </div>
  @endrole

  @role('Agent')
  <div class="row">
    <div class="col-md-4">
      <a href="{{route('my-flight-bookings')}}">
        <div class="card stats-card">
          <div class="stats-icon">
            <span class="fa fa-plane"></span>
          </div>
          <div class="stats-ctn">
            <div class="stats-counter"><span class="counter">{{$userFlightBookings}}</span></div>
            <span class="desc">Flight bookings</span>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4">
      <a href="{{route('my-package-bookings')}}">
      <div class="card stats-card">
        <div class="stats-icon">
          <span class="ti-briefcase"></span>
        </div>
        <div class="stats-ctn">
          <div class="stats-counter"><span class="counter">{{$userPackagesBookings}}</span></div>
          <span class="desc">Packages bookings</span>
        </div>
      </div>
      </a>
    </div>
    <div class="col-md-4">
      <a href="{{route('backend-wallet-view')}}">
      <div class="card stats-card">
        <div class="stats-icon">
          <span class="ti-wallet"></span>
        </div>
        <div class="stats-ctn">
          <div class="stats-counter">&#x20A6;<span class="counter">{{number_format(($userWalletBalance/100))}}</span></div>
          <span class="desc">My Wallet</span>
        </div>
      </div>
      </a>
    </div>
  </div>
  @endrole


  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active trip_type" id="tab-flight-tab" data-toggle="pill" href="#tab-flight" role="tab" aria-controls="tab-flight" aria-expanded="true">One Way</a>
        </li>
        <li class="nav-item">
          <a class="nav-link trip_type" id="tab-hotel-tab" data-toggle="pill" href="#tab-hotel" role="tab" aria-controls="tab-hotel" aria-expanded="true"><i class="fa fa-plane mr-2"></i>Round Trip</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="tab-car-tab" data-toggle="pill" href="#tab-car" role="tab" aria-controls="tab-car" aria-expanded="true"><i class="fa fa-plane mr-2"></i><i class="fa fa-plane mr-2"></i> Multi Destination</a>
        </li>
      </ul>

      <div class="tab-content" id="pills-tabContent">
           <input type="hidden" class="flight_type" value="One Way" />
        <div class="tab-pane fade show active" id="tab-flight" role="tabpanel">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 loader">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h3 class="text-info">Search for cheap flights</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> Departure Airport</label>
                        <input type="text" id="departure_airport_one" class="form-control typeahead" placeholder="airport..., city">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> Arrival Airport</label>
                        <input type="text" id="arrival_airport_one" class="form-control typeahead" placeholder="airport..., city">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label><i class=""></i> Cabin Type</label>
                        <select class="form-control cabin_type_one">
                            <option value="">[SELECT CABIN]</option>
                            @foreach(\App\CabinType::all() as $serial => $cabin)
                            <option value="{{$cabin->cabin_code}}">{{$cabin->cabin_name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label> Departure Date</label>
                        <input type="text" class="datepicker form-control departure_date_one" placeholder="Departure date">
                      </div>
                    </div>


                        <input type="hidden" class="datepicker form-control arrival_date_one" placeholder="Arrival date">

                    <div class="col-md-3">
                      <div class="form-group">
                        <label> Adults <small>12+ yo</small></label>
                        <select class="form-control  adult_passengers_one">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label> Children <small>2 - 11 yo</small></label>
                        <select class="form-control child_passengers_one">
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label> Infants <small> < 2 yo</small></label>
                        <select class="form-control infant_passengers_one">
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>&nbsp; &nbsp;</label>
                        <button class="btn btn-primary search_flight"> <i class="fa fa-search"></i> Search Flight</button>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <div class="tab-pane fade" id="tab-hotel" role="tabpanel">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 loader">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h3 class="text-info">Search for cheap flights</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> Departure Airport</label>
                        <input type="text" id="departure_airport" class="form-control typeahead" placeholder="airport..., city">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> Arrival Airport</label>
                        <input type="text" id="arrival_airport" class="form-control typeahead" placeholder="airport..., city">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label><i class=""></i> Cabin Type</label>
                        <select class="form-control cabin_type">
                          <option value="">[SELECT CABIN]</option>
                          @foreach(\App\CabinType::all() as $serial => $cabin)
                            <option value="{{$cabin->cabin_code}}">{{$cabin->cabin_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label> Departure Date</label>
                        <input type="text" class="datepicker form-control departure_date" placeholder="Departure date">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label> Arrival Date</label>
                        <input type="text" class="datepicker form-control return_date" placeholder="Arrival date">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label> Adults <small>12+ yo</small></label>
                        <select class="form-control  adult_passengers">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label> Children <small>2 - 11 yo</small></label>
                        <select class="form-control child_passengers">
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label> Infants <small> < 2 yo</small></label>
                        <select class="form-control infant_passengers">
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>&nbsp; &nbsp;</label>
                        <button class="btn btn-primary search_flight">Search Flight</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="tab-car" role="tabpanel">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h3>Search for cheap flights</h3>
                  <div class="alert alert-info">
                    <strong><i class="fa fa-info-circle"></i> Important Notice</strong>
                    <p>Search for multi destination is not yet available here. The feature is currently been developed by our team.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection

@section('javascript')
  <script src="{{asset('backend/js/home.js')}}" rel="stylesheet"></script>
@endsection