@extends('layouts.backend')

@section('tab-title')Wallet @endsection

@section('title')Wallet Management
<button class="btn btn-alt-primary btn-sm pull-right" data-toggle="modal" data-target="#fund_wallet">Fund Wallet</button>

@endsection

@section('css')
  <link type="text/css" href="{{asset('backend/css/rig-sidebar.css')}}" rel="stylesheet"/>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-9">
      <div class="card">
        <div class="row">

        </div>
        <ul class="nav nav-tabs card-header" id="profile" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="wallet-log-tab" data-toggle="tab" href="#wallet_log" aria-expanded="true">Wallet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="deposits-tab" data-toggle="tab" href="#deposits_tab" aria-expanded="false">Deposits</a>
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
                  <div id="example1_wrapper" class="dataTables_wrapper">
                    <table id="wallet_table" class="table table-striped dataTable">
                      <thead>
                      <th>#</th>
                      <th>Amount (&#x20A6;)</th>
                      <th>Transaction Type</th>
                      <th>Performed On</th>
                      </thead>
                      <tbody id="wallet_table_body">
                      @foreach($logs as $serial => $log)
                        <tr>
                          <td>{{$serial+1}}</td>
                          <td>{{$log['amount']}}</td>
                          <td> @php echo $log['transaction_type'] @endphp</td>
                          <td>{{$log['performed_on']}}</td>
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
                  Wallet Log
                </div>
                <div class="card-body">
                  <div id="example1_wrapper" class="dataTables_wrapper">
                    <table id="wallet_table" class="table table-striped dataTable">
                      <thead>
                      <th>#</th>
                      <th>Amount (&#x20A6;)</th>
                      <th>Transaction Type</th>
                      <th>Performed On</th>
                      </thead>
                      <tbody id="wallet_table_body">
                      @foreach($logs as $serial => $log)
                        <tr>
                          <td>{{$serial+1}}</td>
                          <td>{{$log['amount']}}</td>
                          <td> @php echo $log['transaction_type'] @endphp</td>
                          <td>{{$log['performed_on']}}</td>
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
    <div class="col-md-3">
      <div class="col-md-12">
        <div class="card stats-card">
          <div class="stats-icon">
            <span class="ti-wallet"></span>
          </div>
          <div class="stats-ctn">
            <div class="stats-counter">&#x20A6;<span class="counter">{{$balance}}</span></div>
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
            <div class="col-md-4">
              <button class="btn btn-outline-secondary" id="interswitch_option"><img src="{{asset('backend/images/payment/interswitch-New.png')}}" style="width: 100px; height: 28px; " /></button>
            </div>
            <div class="col-md-4">
              <button class="btn btn-outline-secondary" id="paystack_option"><img src="{{asset('backend/images/payment/paystack_new_logo.png')}}" style="width: 100px;" /></button>
            </div>
            <div class="col-md-4">
              <button class="btn btn-outline-secondary" id="bank_option"><img src="{{asset('backend/images/payment/bank_transfer.png')}}" style="width: 100px; height:28px;" /></button>
            </div>

          </div>
          <br>
          <div class="row hidden" id="webpay_amount_row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  Input Amount
                </div>
                <div class="card-body">
                  <div class="col-md-12">
                    <div class="form-group">
                      {!! Form::text('webpay_amount', null, ['class' => 'form-control', 'id' => 'webpay_amount', 'placeholder' => 'enter amount. e.g. 10000']) !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row hidden" id="bank_form_row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  Deposit Information
                </div>
                {!! Form::open(['route' => 'backend-save-wallet-deposit', 'files' => 'true']) !!}
                  <div class="card-body">
                  <div class="col-md-12">
                    <div class="form-group">
                      {!! Form::select('bank_detail_id', $bank_details, null, ['class' => 'form-control form-control-sm', 'id' => 'bank_detail_id', 'placeholder' => 'choose account number']) !!}
                    </div>
                  </div>

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
          <button type="button" id="proceed_with_paystack" class="btn btn-alt-primary hidden">Proceed</button>
          <button type="button" id="proceed_with_interswitch" class="btn btn-alt-primary hidden">Proceed</button>

        </div><!-- .modal-footer -->
      </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
  </div><!-- .modal -->
  <!-- /End Normal Modal -->
@endsection

@section('javascript')
  <script type="text/javascript" src="{{asset('backend/js/wallet.js')}}"></script>
@endsection