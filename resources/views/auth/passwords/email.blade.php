@extends('layouts.app')
@section('activeRegisterLogin')  active @endsection
@section('content')
    <div class="container full-center">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h3>Recover Password</h3>
                <form class="booking-item-dates-change mb40"  method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="{{ $errors->has('email') ? ' has-error' : '' }}form-group form-group-icon-left"><i class="fa fa-envelope input-icon input-icon-hightlight"></i>
                                <label>E-mail Address</label>
                                <input class="form-control" value="{{ old('email') }}" placeholder="Email Address" name="email" type="email" required />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
