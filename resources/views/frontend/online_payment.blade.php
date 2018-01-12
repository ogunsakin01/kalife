@extends('layouts.app')
@section('title')Interswitch Transaction logs @endsection
@section('content')
    <div class="gap gap-small"></div>
    <div class="container">
        <h1 class="page-title">Transactions Log</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responseive">
                            <table class="table table-bordered table-striped table-booking-history">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Booking Reference</th>
                                    <th>Amount</th>
                                    <th>Transaction Date</th>
                                    <th>Response Code</th>
                                    <th>Response Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\OnlinePayment::getAllInterswitchTransactions() as $i => $transaction)
                                <tr id="{{$transaction->txn_reference}}">
                                    <td>{{\App\User::getUserById($transaction->user_id)->first_name}} {{\App\User::getUserById($transaction->user_id)->last_name}}</td>
                                    <td>{{$transaction->txn_reference}}</td>
                                    <td>{{number_format(($transaction->amount / 100))}}</td>
                                    <td>{{date('Y-m-d H:i:s',strtotime($transaction->created_at))}}</td>
                                    <td class="response_code_{{$transaction->txn_reference}}">{{$transaction->response_code}}</td>
                                    <td class="response_description_{{$transaction->txn_reference}}">{{$transaction->response_description}}</td>
                                    <td>
                                        @if($transaction->payment_status == 0)
                                        <button class="btn btn-primary requery" value="{{$transaction->txn_reference}}"> Requery</button></td>
                                         @endif
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="gap"></div>
@endsection