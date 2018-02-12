@extends('layouts.backend')

@section('tab-title')Wallet @endsection

@section('title')Online Transactions  (Paystack / Interswitch)

{{--<button class="btn btn-alt-primary btn-sm pull-right" data-toggle="modal" data-target="#fund_wallet">Fund Wallet</button>--}}

@endsection

@section('css')
    <link type="text/css" href="{{asset('backend/css/rig-sidebar.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    @php
        $role = new \App\Role();
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>PayStack Payments Log</h3>

                </div>
                <div class="card-body">
                    <div class="table-responsive dataTables_wrapper">
                        <table class="table table-striped dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Reference</th>
                                <th>Customer Name</th>
                                <th>Customer Type</th>
                                <th>Amount (&#x20A6;)</th>
                                <th>Transaction Date/ Time</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paystackTransactions as $i => $paystackTransaction)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$paystackTransaction->txn_reference}}</td>
                                <td>{{\App\User::find($paystackTransaction->user_id)->first_name}} {{\App\User::find($paystackTransaction->user_id)->last_name}}</td>
                                <td>
                                    {{$role->role($paystackTransaction->user_id)}}
                                </td>
                                <td>{{number_format(($paystackTransaction->amount / 100),2)}}</td>
                                <td>{{date('D d,M Y. g:i A',strtotime($paystackTransaction->created_at))}}</td>
                                <td>
                                    @if($paystackTransaction->payment_status == 1)
                                      <span class="badge badge-success"><i class="fa fa-check"></i> Success</span>
                                    @else
                                        <span class="badge badge-danger"><i class="fa fa-times"></i> Failed</span>
                                    @endif
                                </td>
                            </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Interswitch Payments Log</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive" >
                        <table class="table table-bordered" style="height: 700px;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Reference</th>
                                <th>Customer Name</th>
                                <th>Customer Type</th>
                                <th>Amount (&#x20A6;)</th>
                                <th>Transaction Date/Time</th>
                                <th>Response Code</th>
                                <th>Response Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($interswitchTransactions as $i => $interswitchTransaction)
                            <tr id="{{$interswitchTransaction->txn_reference}}">
                                <td>{{$i+1}}</td>
                                <td>{{$interswitchTransaction->txn_reference}}</td>
                                <td>{{\App\User::find($interswitchTransaction->user_id)->first_name}} {{\App\User::find($interswitchTransaction->user_id)->last_name}}</td>
                                <td>{{$role->role($interswitchTransaction->user_id)}}</td>
                                <td>{{number_format(($interswitchTransaction->amount / 100),2)}}</td>
                                <td>{{date('D d,M Y. g:i A',strtotime($interswitchTransaction->created_at))}}</td>
                                <td class="response_code_{{$interswitchTransaction->txn_reference}}">{{$interswitchTransaction->response_code}}</td>
                                <td class="response_description_{{$interswitchTransaction->txn_reference}}">{{$interswitchTransaction->response_description}}</td>
                                <td>
                                    @if($interswitchTransaction->payment_status == 1)
                                        <span class="badge badge-success"><i class="fa fa-check"></i> Success</span>
                                    @else
                                        <span class="badge badge-danger"><i class="fa fa-times"></i> Failed</span>
                                    @endif
                                </td>
                                <td>
                                    @if($interswitchTransaction->payment_status == 1)
                                    @else
                                        <button type="button" class="btn btn-alt-primary requery" value="{{$interswitchTransaction->txn_reference}}">
                                            <i class="fa fa-refresh"></i> Requery
                                        </button>
                                    @endif
                                </td>
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
@section('javascript')
    <script type="text/javascript" src="{{url('backend/js/wallet.js')}}"></script>
@endsection