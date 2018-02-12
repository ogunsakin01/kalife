@extends('layouts.backend')

@section('tab-title')Log Management @endsection

@section('title')All Banks Transactions Log / Manage Bank Payment @endsection

@section('content')
    @php
        $user = new \App\User();
    @endphp

    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <strong><i class="fa fa-info-circle"></i> Important Notice !!!</strong>
                        <p>Ensure you have properly confirmed the bank payment before clicking the approve button. Clicking on the approve button also update any booking or deposit attached to the transaction.</p>
                    </div>
                </div>
                <div class="col-md-12">
                        <div class="card stats-card">
                            <div class="stats-icon">
                                <span class="fa fa-bank"></span>
                            </div>
                            <div class="stats-ctn">
                                <div class="stats-counter"><span class="counter">{{count($bank_payments)}}</span></div>
                                <span class="desc">Direct Bank Deposits</span>
                            </div>
                        </div>
                </div>
                <div class="col-md-12">
                        <div class="card stats-card">
                            <div class="stats-icon">
                                <span class="fa fa-bank"></span>
                            </div>
                            <div class="stats-ctn">
                                <div class="stats-counter"><span class="counter">{{count($wallet_deposits)}}</span></div>
                                <span class="desc">Wallet Bank Deposits</span>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <ul class="nav nav-tabs card-header" id="profile" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="wallet-log-tab" data-toggle="tab" href="#tab1" aria-expanded="true">Direct Bank Deposits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="deposits-tab" data-toggle="tab" href="#tab2" aria-expanded="false">Wallet Bank Deposits</a>
                    </li>
                </ul>
                <div class="card-body">

                    <div class="tab-content profile-content" id="profileContent">

                        <div class="tab-pane fade active show" id="tab1" aria-expanded="true">
                            <div class="card" id="new_bank_payments">
                                <div class="card-header" >
                                    Direct Bank Deposits
                                </div>
                                <div class="card-body">
                                    <div id="example1_wrapper" class="table-responsive" style="max-height: 600px; overflow: scroll;">
                                        <table id="wallet_table" class="table table-striped ">
                                            <thead>
                                            <tr>
                                                <th> Reference           </th>
                                                <th> User                </th>
                                                <th> User Type           </th>
                                                <th> Amount (&#x20A6;)   </th>
                                                <th> Selected Bank Info  </th>
                                                <th> Status              </th>
                                                <th> Payment Proof       </th>
                                                <th> Performed On        </th>
                                                <th> Action              </th>
                                            </tr>
                                            </thead>
                                            <tbody id="wallet_table_body">
                                            @foreach($bank_payments as $serial => $bank_payment)
                                                <tr id="{{$bank_payment->reference}}">
                                                    <td>{{$bank_payment->reference}}</td>
                                                    <td>{{$user::find($bank_payment->user_id)->first_name}} {{$user::find($bank_payment->user_id)->last_name}}</td>
                                                    <td>{{$user->getUserProfileById($bank_payment->user_id)['role']}}</td>
                                                    <td>{{number_format($bank_payment->amount)}}</td>
                                                    <td>Bank Name {{ \App\Bank::find(\App\BankDetail::find($bank_payment->bank_detail_id)->bank_id)->bank_name}} <br/>
                                                        Account Number {{\App\BankDetail::find($bank_payment->bank_detail_id)->account_number}}
                                                    </td>
                                                    <td id="status_{{$bank_payment->reference}}">
                                                        @if($bank_payment->status == 1)
                                                            <span class="badge badge-success"><i class="fa fa-check"></i> Successful</span>
                                                        @elseif($bank_payment->status == 2)
                                                            <span class="badge badge-warning"><i class="fa fa-warning"></i> Pending</span>
                                                        @elseif($bank_payment->status == 0)
                                                            <span class="badge badge-danger"><i class="fa fa-times"></i> Declined</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#payment_proof_{{$bank_payment->id}}" title="View payment proof image"><i class="fa fa-eye"></i></button>
                                                        <div class="modal fade" id="payment_proof_{{$bank_payment->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Payment Proof</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    @if(!is_null($bank_payment->slip_photo) && !empty($bank_payment->slip_photo))
                                                                                        <img src="{{asset($bank_payment->slip_photo)}}" style="max-height: 300px; max-width: 350px;"/>
                                                                                    @else
                                                                                        <blockquote>No proof of payment uploaded.  Ensure you have verified the payment before approving</blockquote>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{date('d m, Y G:i A',strtotime($bank_payment->created_at))}}</td>
                                                    <td id="action_{{$bank_payment->reference}}">
                                                        @if($bank_payment->status == 0)
                                                          <button class="btn btn-primary approve_bank_payment" value="{{$bank_payment->reference}}" data-toggle="tooltip" title="approve bank deposit proof"><i class="fa fa-check-circle"></i></button>
                                                        @elseif($bank_payment->status == 1)
                                                          <span class="badge badge-success"><i class="fa fa-check"></i> Approved</span>
                                                        @elseif($bank_payment->status == 2)
                                                            <button class="btn btn-primary approve_bank_payment" data-toggle="tooltip" value="{{$bank_payment->reference}}" title="approve bank deposit proof"><i class="fa fa-check-circle"></i></button>
                                                            <button class="btn btn-danger decline_bank_payment" data-toggle="tooltip" value="{{$bank_payment->reference}}" title="decline bank deposit"><i class="fa fa-times"></i></button>
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

                        <div class="tab-pane fade" id="tab2" aria-expanded="false">
                            <div class="card" id="new_wallet_deposits">
                                <div class="card-header">
                                    Wallet Bank Deposits
                                </div>
                                <div class="card-body">
                                    <div id="example1_wrapper" class="table-responsive" style="max-height: 600px; overflow: scroll;">
                                        <table id="wallet_table" class="table table-striped ">
                                            <thead>
                                            <tr>
                                                <th> Reference           </th>
                                                <th> User                </th>
                                                <th> User Type           </th>
                                                <th> Amount (&#x20A6;)   </th>
                                                <th> Selected Bank Info  </th>
                                                <th> Status              </th>
                                                <th> Payment Proof       </th>
                                                <th> Performed On        </th>
                                                <th> Action              </th>
                                            </tr>
                                            </thead>
                                            <tbody id="wallet_table_body">
                                            @foreach($wallet_deposits as $serial => $wallet_deposit)
                                                <tr id="{{$wallet_deposit->reference}}">
                                                    <td>{{$wallet_deposit->reference}}</td>
                                                    <td>{{$user::find($wallet_deposit->user_id)->first_name}} {{$user::find($wallet_deposit->user_id)->last_name}}</td>
                                                    <td>{{$user->getUserProfileById($wallet_deposit->user_id)['role']}}</td>
                                                    <td>{{number_format($wallet_deposit->amount/100)}}</td>
                                                    <td>Bank Name {{ \App\Bank::find(\App\BankDetail::find($wallet_deposit->bank_detail_id)->bank_id)->bank_name}} <br/>
                                                        Account Number {{\App\BankDetail::find($wallet_deposit->bank_detail_id)->account_number}}
                                                    </td>
                                                    <td id="status_{{$wallet_deposit->reference}}">
                                                        @if($wallet_deposit->status == 1)
                                                            <span class="badge badge-success"><i class="fa fa-check"></i> Successful</span>
                                                        @elseif($wallet_deposit->status == 2)
                                                            <span class="badge badge-warning"><i class="fa fa-warning"></i> Pending</span>
                                                        @elseif($wallet_deposit->status == 0)
                                                            <span class="badge badge-danger"><i class="fa fa-times"></i> Declined</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#payment_proof_{{$wallet_deposit->id}}" title="View payment proof image"><i class="fa fa-eye"></i></button>
                                                        <div class="modal fade" id="payment_proof_{{$wallet_deposit->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Payment Proof</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    @if(!is_null($wallet_deposit->slip_photo) && !empty($wallet_deposit->slip_photo))
                                                                                        <img src="{{asset($wallet_deposit->slip_photo)}}" style="max-height: 300px; max-width: 350px;"/>
                                                                                    @else
                                                                                        <blockquote>No proof of payment uploaded. Ensure you have verified the payment before approving</blockquote>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{date('d m, Y G:i A',strtotime($wallet_deposit->created_at))}}</td>
                                                    <td id="action_{{$wallet_deposit->reference}}">
                                                        @if($wallet_deposit->status == 0)
                                                            <button class="btn btn-primary approve_wallet_deposit" value="{{$wallet_deposit->reference}}" data-toggle="tooltip" title="approve bank deposit proof"><i class="fa fa-check-circle"></i></button>
                                                        @elseif($wallet_deposit->status == 1)
                                                            <span class="badge badge-success"><i class="fa fa-check"></i> Approved</span>
                                                        @elseif($wallet_deposit->status == 2)
                                                            <button class="btn btn-primary approve_wallet_deposit" value="{{$wallet_deposit->reference}}" data-toggle="tooltip" title="approve bank deposit proof"><i class="fa fa-check-circle"></i></button>
                                                            <button class="btn btn-danger decline_wallet_deposit" value="{{$wallet_deposit->reference}}" data-toggle="tooltip" title="decline bank deposit"><i class="fa fa-times"></i></button>
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
            </div>


        </div>
    </div>

@endsection

@section('javascript')
    <script src="{{asset('backend/js/bank_transactions.js')}}"></script>
@endsection