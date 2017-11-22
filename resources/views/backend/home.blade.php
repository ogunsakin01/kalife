@extends('layouts.backend')

@section('tab-title')Home @endsection

@section('title')My Dashboard @endsection


@section('content')
  <div class="row">
    <div class="col-md-3">
      <div class="card stats-card">
        <div class="stats-icon">
          <span class="ti-arrow-top-right"></span>
        </div>
        <div class="stats-ctn">
          <div class="stats-counter"><span class="counter">87</span></div>
          <span class="desc">flight bookings</span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card stats-card">
        <div class="stats-icon">
          <span class="ti-home"></span>
        </div>
        <div class="stats-ctn">
          <div class="stats-counter"><span class="counter">100</span></div>
          <span class="desc">hotel bookings</span>
        </div>
      </div>

    </div>
    <div class="col-md-3">
      <div class="card stats-card">
        <div class="stats-icon">
          <span class="ti-car"></span>
        </div>
        <div class="stats-ctn">
          <div class="stats-counter"><span class="counter">31</span></div>
          <span class="desc">car bookings</span>
        </div>
      </div>

    </div>
    <div class="col-md-3">
        <div class="card stats-card">
          <div class="stats-icon">
            <span class="ti-wallet"></span>
          </div>
          <div class="stats-ctn">
            <div class="stats-counter">&#x20A6;<span class="counter">22,000</span></div>
            <span class="desc">wallet</span>
          </div>
        </div>
      </div>
  </div>

  <div class="row">
    <div class="col-md-9">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="tab-flight-tab" data-toggle="pill" href="#tab-flight" role="tab" aria-controls="tab-flight" aria-expanded="true"><i class="fa fa-plane mr-2"></i>Flight</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="tab-hotel-tab" data-toggle="pill" href="#tab-hotel" role="tab" aria-controls="tab-hotel" aria-expanded="true"><i class="fa fa-hotel mr-2"></i>Hotel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="tab-car-tab" data-toggle="pill" href="#tab-car" role="tab" aria-controls="tab-car" aria-expanded="true"><i class="fa fa-car mr-2"></i> Car</a>
        </li>
      </ul>

      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="tab-flight" role="tabpanel">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <h3 class="text-info">Search for cheap flights</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      {!! Form::label('from_loc', 'From') !!}
                      {!! Form::text('from_loc', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6">
                      {!! Form::label('to_loc', 'To') !!}
                      {!! Form::text('to_loc', null, ['class' => 'form-control']) !!}
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
                  s
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              s
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              s
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection