@extends('layouts.app')
@section('title')Booking Payments @endsection
@section('bankPayment') active @endsection
@section('content')
    <div class="gap gap-small"></div>
    <div class="container">
        <div class="row">
            @include('partials.profileSideBar')
            <div class="col-md-9">
                <h4>Bank Payments</h4>
                <div class="table-responsive">
                    <table id="wallet_table" class="table table-bordered">
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
                        @foreach($bank_payments as $serial => $bank_payment)
                            <tr>
                                <td>{{$bank_payment->reference}}</td>
                                <td>{{number_format($bank_payment->amount)}}</td>
                                <td>Bank Name {{ \App\Bank::find(\App\BankDetail::find($bank_payment->bank_detail_id)->bank_id)->bank_name}} <br/>
                                    Account Number {{\App\BankDetail::find($bank_payment->bank_detail_id)->account_number}}
                                </td>
                                <td>
                                    @if($bank_payment->status == 1)
                                        <label class="label label-success"><i class="fa fa-check"></i> Successful</label>
                                    @elseif($bank_payment->status == 2)
                                        <label class="label label-warning"><i class="fa fa-warning"></i> Pending</label>
                                    @elseif($bank_payment->status == 0)
                                        <label class="label label-danger"><i class="fa fa-times"></i> Declined</label>
                                    @endif
                                </td>
                                <td>
                                    <a class="popup-text btn btn-primary" href="#payment_proof_{{$bank_payment->id}}" data-effect="mfp-zoom-out" ><i class="fa fa-eye"></i></a>
                                    <div class="mfp-with-anim mfp-hide mfp-dialog mfp-search-dialog" id="payment_proof_{{$bank_payment->id}}" >

                                                <form method="post" enctype="multipart/form-data" action="{{url('/updatePaymentProof')}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="bank_payment_id" value="{{$bank_payment->id}}"/>
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
                                                        <button type="submit" id="update_payment_proof" class="btn btn-alt-primary">Update</button>
                                                    </div>
                                                </form>

                                    </div>
                                </td>
                                <td>{{date('d m, Y G:i A',strtotime($bank_payment->created_at))}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection