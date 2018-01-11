@extends('layouts.backend')

@section('tab-title')Wallet @endsection

@section('title')Wallet Management @endsection

@section('content')
  <div class="row">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header">
          Wallet Log
        </div>
        <div class="card-body">


        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="col-md-12">
        <div class="card stats-card">
          <div class="stats-icon">
            <span class="ti-wallet"></span>
          </div>
          <div class="stats-ctn">
            <div class="stats-counter">&#x20A6;<span class="counter">22,000</span></div>
            <span class="desc">Current Wallet</span>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card stats-card">
          <div class="stats-icon">
            <span class="ti-wallet"></span>
          </div>
          <div class="stats-ctn">
            <div class="stats-counter">&#x20A6;<span class="counter">22,000</span></div>
            <span class="desc">Total Debit</span>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card stats-card">
          <div class="stats-icon">
            <span class="ti-wallet"></span>
          </div>
          <div class="stats-ctn">
            <div class="stats-counter">&#x20A6;<span class="counter">22,000</span></div>
            <span class="desc">Total Credit</span>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
  {{--<script type="text/javascript" src="{{asset('backend/js/markups.js')}}"></script>--}}
@endsection