@extends('layouts.backend')

@section('tab-title')Log Management @endsection

@section('title')All Wallets Transaction Log @endsection

@section('content')
    @php
    $user = new \App\User();
    $role = new \App\Role();
    @endphp
   <div class="row">
       <div class="col-md-3">
           <div class="row">
               <div class="col-md-12">
                   <div class="card stats-card">
                       <div class="stats-icon">
                           <span class="ti-wallet"></span>
                       </div>
                       <div class="stats-ctn">
                           <div class="stats-counter"><span class="counter">&#x20A6;{{number_format(($total_log_amount / 100),2)}}</span></div>
                           <span class="desc">Total Transaction</span>
                       </div>
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="card stats-card ">
                       <div class="stats-icon">
                           <span class="fa fa-money"></span>
                       </div>
                       <div class="stats-ctn">
                           <div class="stats-counter"><span class="counter">&#x20A6;{{number_format(($total_credit_amount / 100),2)}}</span></div>
                           <span class="desc">Total Credits <span class="badge badge-success">Credits</span></span>
                       </div>
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="card stats-card">
                       <div class="stats-icon">
                          <span class="fa fa-money"></span>
                       </div>
                       <div class="stats-ctn">
                           <div class="stats-counter"><span class="counter">&#x20A6;{{number_format(($total_debit_amount / 100),2)}}</span></div>
                           <span class="desc">Total Debits <span class="badge badge-danger">Debits</span></span>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="col-md-9">
           <div class="card">
               <div class="card-header">
                  All Wallets Transactions Log
               </div>
               <div class="card-body">
                   <div class="table-responsive dataTables_wrapper">
                       <table class="table dataTable">
                           <thead>
                           <tr>
                               <td>#</td>
                               <td>User Name</td>
                               <td>User Type</td>
                               <td>Amount(&#x20A6;)</td>
                               <td>Type</td>
                               <td>Performed On</td>
                           </tr>
                           </thead>
                           <tbody>
                             @foreach($logs as $serial => $log)
                             <tr>
                                 <td>{{$serial + 1}}</td>
                                 <td>{{$user::find($log->user_id)->first_name}} {{$user::find($log->user_id)->last_name}}</td>
                                 <td>{{$user->getUserProfileById($log->user_id)['role']}}</td>
                                 <td>{{number_format(($log->amount / 100),2)}}</td>
                                 <td>
                                     @if($log->transaction_type == 0)
                                         <span class="badge badge-danger">Debit</span>
                                         @else
                                         <span class="badge badge-success">Credit</span>
                                     @endif
                                 </td>
                                 <td>{{date('d,m Y G:i A',strtotime($log->created_at))}}</td>
                             </tr>
                             @endforeach
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection