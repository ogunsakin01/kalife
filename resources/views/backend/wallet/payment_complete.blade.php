@extends('layouts.backend')

@section('tab-title')Wallet @endsection

@section('title')Payment Confirmation Page @endsection

@section('content')

    <div class="row" align="center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            @if($transactionStatus['status'] == 1)
            <div class="card text-white bg-success mb-3">
                <div class="card-header text-white"><i class="fa fa-check-circle"></i> {{$transactionStatus['responseDescription']}}</div>
                <div class="card-body">
                    <h4 class="card-title">Your wallet has been credited with the sum of &#x20A6; {{number_format($transactionStatus['amount'] / 100,2)}}<br/> {{$transactionStatus['reference']}}</h4>
                    <p class="card-text">Proceed to you wallet management page and confirm your wallet has been credited according to the amount paid.</p>
                </div><!-- .card-body -->
            </div>
            @elseif($transactionStatus['status'] == 0)
            <div class="card text-white bg-danger mb-3">
                <div class="card-header text-white"><i class="fa fa-times-circle"></i> Payment Failed</div>
                <div class="card-body">
                    <h4 class="card-title">{{$transactionStatus['responseDescription']}}<br/> {{$transactionStatus['reference']}}</h4>
                    <p class="card-text">Go back to your wallet management page and try again.<br/> If your account has been debited but could not confirm the payment due to internet connection. Kindly go to your wallets log and click on the requery button to confirm the transaction</p>
                </div><!-- .card-body -->
            </div>
            @endif
        </div>
    </div>
@endsection