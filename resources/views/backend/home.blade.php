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

  </div>
@endsection