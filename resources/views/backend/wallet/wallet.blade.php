@extends('layouts.backend')

@section('tab-title')Wallet @endsection

@section('title')Wallet Management
<button class="btn btn-alt-primary btn-sm pull-right" data-toggle="modal" data-target="#fund_wallet">Fund Wallet</button>

@endsection

@section('css')
  <link type="text/css" href="{{asset('backend/css/rig-sidebar.css')}}" rel="stylesheet"/>
@endsection
@section('content')

  @php
  $InterswitchConfig = new \App\Services\InterswitchConfig();
  @endphp
  <div class="row">
    <div class="col-md-12">
      @if(session()->has('errorMessage'))
        <div class="alert alert-danger">
          <strong><i class="fa fa-warning"></i> Important Info</strong>
          <p>{{session()->get('errorMessage')}}</p>
        </div>
      @endif
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="col-md-12">
        <div class="card stats-card">
          <div class="stats-icon">
            <span class="ti-wallet"></span>
          </div>
          <div class="stats-ctn">
            <div class="stats-counter">&#x20A6;<span class="counter">{{number_format(($balance / 100))}}</span></div>
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
            <div class="stats-counter">&#x20A6;<span class="counter">{{number_format($log_total_debit / 100)}}</span></div>
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
            <div class="stats-counter">&#x20A6;<span class="counter">{{number_format($log_total_credit / 100)}}</span></div>
            <span class="desc">Total Credit</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="card">
        <ul class="nav nav-tabs card-header" id="profile" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="wallet-log-tab" data-toggle="tab" href="#wallet_log" aria-expanded="true">Wallet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="deposits-tab" data-toggle="tab" href="#deposits_tab" aria-expanded="false">Bank Deposits</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="deposits-tab" data-toggle="tab" href="#online_deposits_tab" aria-expanded="false">Online Deposits</a>
          </li>

        </ul>

        <div class="card-body">

          <div class="tab-content profile-content" id="profileContent">

            <div class="tab-pane fade active show" id="wallet_log" aria-expanded="true">
              <div class="card">
                <div class="card-header">
                  Wallet Log
                </div>
                <div class="card-body">
                  <div id="example1_wrapper" class="table-responsive dataTables_wrapper">
                    <table id="wallet_table" class="table table-striped dataTable">
                      <thead>
                      <tr>
                      <th>#</th>
                      <th>Amount (&#x20A6;)</th>
                      <th>Transaction Type</th>
                      <th>Performed On</th>
                      </tr>
                      </thead>
                      <tbody id="wallet_table_body">
                      @foreach($logs as $serial => $log)
                        <tr>
                          <td>{{$serial+1}}</td>
                          <td>{{number_format(($log->amount / 100))}}</td>
                          <td>
                            @if($log->transaction_type == 1)
                             <span class="badge badge-success">Credit</span>
                            @elseif($log->transaction_type == 0)
                            <span class="badge badge-danger">Debit</span>
                            @endif
                          </td>
                          <td>{{date('d, m Y G:i A',strtotime($log->created_at))}}</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="deposits_tab" aria-expanded="false">
              <div class="card">
                <div class="card-header">
                  Wallet Bank Deposits
                </div>
                <div class="card-body">
                  <div id="example1_wrapper" class=" table-responsive" style="max-height: 600px; overflow: scroll;">
                    <table id="wallet_table" class="table table-striped ">
                      <thead>
                      <tr>
                      <th> Reference           </th>
                      <th> Amount (&#x20A6;)   </th>
                      <th> Selected Bank Info  </th>
                      <th> Status              </th>
                      <th> Payment Proof       </th>
                      <th> Performed On        </th>
                      </tr>
                      </thead>
                      <tbody id="wallet_table_body">
                      @foreach($wallet_deposits as $serial => $wallet_deposit)
                        <tr>
                          <td>{{$wallet_deposit->reference}}</td>
                          <td>{{number_format(($wallet_deposit->amount/100))}}</td>
                          <td>Bank Name {{ \App\Bank::find(\App\BankDetail::find($wallet_deposit->bank_detail_id)->bank_id)->bank_name}} <br/>
                              Account Number {{\App\BankDetail::find($wallet_deposit->bank_detail_id)->account_number}}
                          </td>
                          <td>
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
                                        <form method="post" enctype="multipart/form-data" action="{{url('backend/wallet/updatePaymentProof')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="deposit_id" value="{{$wallet_deposit->id}}"/>
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
                                                        <blockquote>No proof of payment uploaded. Select a payment proof image and upload</blockquote>
                                                    @endif
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Payment Proof (New or Update)</label><br>
                                                        <input type="file" required name="slip_photo" class="form-control" style="max-width: 300px;"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" id="update_payment_proof" class="btn btn-alt-primary">Update</button>
                                        </div>
                                        </form>
                                    </div>
                                  </div>
                              </div>
                          </td>
                          <td>{{date('d m, Y G:i A',strtotime($wallet_deposit->created_at))}}</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="online_deposits_tab" aria-expanded="false">
              <div class="card">
                <div class="card-header">
                 Wallet Online Deposits
                </div>
                <div class="card-body">
                  <div id="example1_wrapper" class=" table-responsive" style="max-height: 600px; overflow: scroll;">
                    <table id="wallet_table" class="table table-striped ">
                      <thead>
                      <tr>
                      <th>Reference</th>
                      <th>Amount (&#x20A6;)</th>
                      <th>Status</th>
                      <th>Performed On</th>
                      <th>Action</th>
                      </tr>
                      </thead>
                      <tbody id="wallet_table_body">
                      @foreach($online_payments as $serial => $online_payment)
                        @if(substr($online_payment->txn_reference,0,3) == "WDR")
                        <tr id="online_payment_{{$online_payment->txn_reference}}">
                          <td>{{$online_payment->txn_reference}}</td>
                          <td>{{number_format($online_payment->amount/100)}}</td>
                          <td id="status_{{$online_payment->txn_reference}}">
                            @if($online_payment->payment_status == "1")
                              <span class="badge badge-success"><i class="fa fa-check"></i>&nbsp; Success</span>
                              @else
                              <span class="badge badge-danger"><i class="fa fa-times"></i>&nbsp; Failed</span>
                            @endif
                          </td>
                          <td>{{date('m d ,Y  G:i A',strtotime($online_payment->created_at))}}</td>
                          <td>
                            @if($online_payment->payment_status == "1")
                            @else
                              <button class="btn btn-alt-primary requery-wallet-online-payment" value="{{$online_payment->txn_reference}}"> Requery</button>
                            @endif
                          </td>
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
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="fund_wallet" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Choose Payment Option</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-4 col-md-4">
              <button class="btn btn-outline-secondary" id="interswitch_option"><img src="{{asset('backend/images/payment/interswitch-New.png')}}" style="width: 100px; height: 28px; " /></button>
            </div>
            <div class="col-xs-4 col-md-4">
              <button class="btn btn-outline-secondary" id="paystack_option"><img src="{{asset('backend/images/payment/paystack_new_logo.png')}}" style="width: 100px;" /></button>
            </div>
            <div class="col-xs-4 col-md-4">
              <button class="btn btn-outline-secondary" id="bank_option"><img src="{{asset('backend/images/payment/bank_transfer.png')}}" style="width: 100px; height:28px;" /></button>
            </div>

          </div>
          <br>
          <div class="row hidden" id="webpay_amount_row">
            <div class="col-md-12">
              <div class="card" id="webpay_build" >
                <div class="card-header">
                  Input Amount
                </div>
                <div class="card-body">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="number" id="webpay_amount" class="form-control" placeholder="enter amount. e.g 10000"/>
                    </div>
                  </div>
                </div>
                <div class="card-footer" id="build_transaction_footer">
                  <button type="button" id="build_transaction" class="btn btn-alt-primary pull-right">Build Transaction</button>
                </div>
              </div>
              <form action="{{$InterswitchConfig->requestActionUrl}}" class="hidden" id="webpay_info" method="post">
              <div class="card" >
                <div class="card-header">
                 Transaction Details
                </div>
                <div class="card-body">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Reference</label>
                      <input type="text" disabled id="transaction_reference" class="form-control" value=""/>
                      <label>Amount </label>
                      <input type="text" disabled id="transaction_amount" class="form-control" value=""/>

                      <input type="hidden" class="reference_1" name="txn_ref" value=""/>
                      <input type="hidden" class="amount_1" name="amount" value=""/>
                      <input type="hidden" name="currency" value="566"/>
                      <input type="hidden" name="pay_item_id" class="pay_item_id" value=""/>
                      <input type="hidden" name="site_redirect_url" class="site_redirect_url" value=""/>
                      <input type="hidden" name="product_id" class="product_id" value=""/>
                      <input type="hidden" class="cust_id_1" name="cust_id" value="{{auth()->user()->id}}"/>
                      <input type="hidden" name="cust_name" value="{{auth()->user()->first_name}} {{auth()->user()->last_name}}"/>
                      <input type="hidden" name="hash" class="hash" value=""/>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-alt-primary"><i class="fa fa-credit-card"></i> PAY NOW</button>
                </div>
              </div>
              </form>
            </div>
          </div>

          <div class="row hidden" id="paystack_amount_row">
            <div class="col-md-12">
              <form action="{{url('/backend/wallet/initiatePaystackTransaction')}}" method="post">
                {{csrf_field()}}
              <div class="card" >
                <div class="card-header">
                  Input Amount
                </div>
                <div class="card-body">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="number" name="amount" class="form-control" placeholder="enter amount. e.g 10000"/>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" id="build_transaction" class="btn btn-alt-primary pull-right"><i class="fa fa-credit-card"></i> PAY NOW</button>
                </div>
              </div>
              </form>
            </div>
          </div>

          <div class="row hidden" id="bank_form_row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  Deposit Information
                </div>
                {!! Form::open(['route' => 'backend-save-wallet-deposit', 'files' => 'true']) !!}
                @php
                $SabreConfig = new \App\Services\SabreConfig();
                @endphp

                  <div class="card-body">
                  <div class="col-md-12">
                    <div class="form-group">
                      {!! Form::select('bank_detail_id', $bank_details, null, ['class' => 'form-control form-control-sm', 'id' => 'bank_detail_id', 'placeholder' => 'choose account number']) !!}
                    </div>
                  </div>
                    <input type="hidden" value="{{auth()->user()->id}}" name="user_id" />
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea class="form-control" id="bank_details"  rows="3" disabled="disabled" placeholder="Account Name & Bank Name"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      {!! Form::number('amount', null, ['class' => 'form-control form-control', 'id' => 'amount', 'placeholder' => 'enter amount e.g. 10000']) !!}
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="file" name="slip_photo" class="form-control-file" id="slip_photo">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        {!! Form::submit('Submit', ['class' => 'btn btn-alt-primary hidden pull-right', 'id' => 'submit_deposit']) !!}
                      </div>
                    </div>
                  </div>
                </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="submit_deposit" class="btn btn-alt-primary hidden">Submit</button>
          {{--<button type="button" id="proceed_with_paystack" class="btn btn-alt-primary hidden">Proceed</button>--}}
        </div><!-- .modal-footer -->
      </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
  </div><!-- .modal -->
  <!-- /End Normal Modal -->
@endsection

@section('javascript')
  <script type="text/javascript" src="{{asset('backend/js/wallet.js')}}"></script>
@endsection