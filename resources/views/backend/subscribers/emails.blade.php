@extends('layouts.backend')

@section('tab-title')Email Subscriptions @endsection

@section('title')All email subscriptions @endsection

@section('content')
    <div class="row">
<div class="col-md-3">
    <div class="card stats-card">
        <div class="stats-icon">
            <span class="ti-email"></span>
        </div>
        <div class="stats-ctn">
            <div class="stats-counter"><span class="counter">{{count($emails)}}</span></div>
            <span class="desc">Subscribers</span>
        </div>
    </div>

            <div class="card stats-card">
                <div class="stats-icon">
                    <span class="fa fa-check-circle"></span>
                </div>
                <div class="stats-ctn">
                    <div class="stats-counter"><span class="counter">{{count(\App\Email::where('status',1)->get())}}</span></div>
                    <span class="desc">Active Subscribers <span class="badge badge-success">Active</span></span>
                </div>
            </div>
            <div class="card stats-card">
                <div class="stats-icon">
                    <span class="fa fa-warning"></span>
                </div>
                <div class="stats-ctn">
                    <div class="stats-counter"><span class="counter">{{count(\App\Email::where('status',0)->get())}}</span></div>
                    <span class="desc">Inactive Subscribers <span class="badge badge-danger">Inactive</span></span>
                </div>
            </div>
        </div>
        <div class="col-md-9">

            <!-- Main Profile card -->
            <div class="card">
                <div class="card-body table-responsive">
                   <table class="table dataTable">
                       <thead>
                       <tr>
                           <th>#</th>
                           <th>Email</th>
                           <th>Ip Address</th>
                           <th>Subscription Date / Time</th>
                           <th>Status</th>
                           <th>Action</th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach($emails as $serial => $email)
                           <tr>
                               <td>{{$serial+1}}</td>
                               <td>{{$email->email}}</td>
                               <td>{{$email->visitor}}</td>
                               <td>{{date('d, D M. Y G:i A',strtotime($email->created_at))}}</td>
                               <td id="status_{{$email->id}}">
                                   @if($email->status == 1)
                                       <span class="badge badge-success"><i class="fa fa-check"></i> Active</span>
                                       @elseif($email->status == 0)
                                       <span class="badge badge-danger"><i class="fa fa-warning"></i> Disabled</span>
                                   @endif
                               </td>
                               <td>
                                   <button class="btn btn-primary activate" data-toggle="tooltip" title="Activate email to receive notifications from you" value="{{$email->id}}"> <i class="fa fa-check"></i></button>
                                   <button class="btn btn-danger deActivate" data-toggle="tooltip" title="Deactivate email from receiving notification from you" value="{{$email->id}}"> <i class="fa fa-warning"></i></button>
                               </td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                </div><!-- .card-body -->
            </div><!-- .card -->
            <!-- /End Main Profile card -->

        </div><!-- .col -->
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{asset('backend/js/emails.js')}}"></script>
@endsection