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
                <h3>Reset Password</h3>
                <form class="booking-item-dates-change mb40"  method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
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
                            <div class="{{ $errors->has('password') ? ' has-error' : '' }}form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-hightlight"></i>
                                <label>Password</label>
                                <input class="form-control" id="password" placeholder="New Password" name="password" type="password" required />
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-hightlight"></i>
                                <label>Confirm Password</label>
                                <input class="form-control" id="password-confirm" placeholder="Confirm Password" name="password_confirmation" type="password" required />
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                          </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
