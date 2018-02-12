@extends('layouts.app')
@section('title')Join Us,Create an account and login at Kalife Travels and Tours @endsection
@section('activeRegisterLogin') active @endsection
@section('content')
    <div class="gap gap-small">    </div>
    <div class="container">
        <h1>Login/Register on Kalife Travels and Tours</h1>
    </div>

    <div class="gap"></div>


    <div class="container">
        <div class="row" data-gutter="60">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('message'))
                        <div class="alert alert-success">
                            <i class="fa fa-check"></i>
                    {{session()->get('message')}}
                        </div>
                    @endif
            </div>

            @if(auth()->guest())
            <div class="col-md-4">
                <h3>Welcome to Kalife</h3>
                <p>Ultricies vestibulum egestas ad cras mollis nam dictumst netus leo facilisis justo maecenas molestie ipsum felis mus cubilia hendrerit vestibulum accumsan consectetur convallis vitae nec sapien diam justo lobortis aenean</p>
                <p>Lobortis tristique interdum curae luctus mattis nisl aenean diam suscipit</p>

                <div class="row">
                    <div class="col-md-12">
                        <h3>Login</h3>
                    </div>
                    <form action="{{url('/login')}}" method="post">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon input-icon-show"></i>
                                <label>Email</label>
                                <input class="form-control" name="email" required placeholder="e.g. johndoe@gmail.com" type="email" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                                <label>Password</label>
                                <input class="form-control" name="password" required type="password" placeholder="my secret password" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            Can't remember password ? <a href="{{url('/password/reset')}}">Recover Here</a>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary">Log In <i class="fa fa-sign-in"></i></button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data" action="{{ url('/register') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12" >
                                    <h3> Join Us</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-user-secret input-icon input-icon-show"></i>
                                        <label>Title *</label>
                                        <select name="title" required class="form-control">
                                            <option value="1">Mr.</option>
                                            <option value="2">Mrs.</option>
                                            <option value="3">MISS</option>
                                            <option value="4">MASTER</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                        <label>First Name *</label>
                                        <input class="form-control" name="first_name" required placeholder="e.g. John" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                        <label>Last Name *</label>
                                        <input class="form-control" name="last_name" required placeholder="e.g. Doe" type="text" />
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                        <label>Other Name</label>
                                        <input class="form-control" name="other_name" placeholder="e.g. Smith" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-icon-left">
                                        <i class="fa fa-envelope input-icon input-icon-show"></i>
                                        <label>Email *</label>
                                        <input class="form-control" name="email" required placeholder="e.g. johndoe@gmail.com" type="email" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-icon-left">
                                        <i class="fa fa-phone input-icon input-icon-show"></i>
                                        <label>Phone Number *</label>
                                        <input class="form-control" name="phone_number" required placeholder="e.g. 08012345678" type="number" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-icon-left">
                                        <i class="fa fa-calendar input-icon input-icon-show"></i>
                                        <label>Date of Birth *</label>
                                        <input class="date-pick-adult form-control" name="date_of_birth" required type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Gender *</label>
                                    <div class="radio-inline radio-small">
                                        <label>
                                            <input class="i-radio" type="radio" value="1" name="gender" required />Male</label>
                                    </div>
                                    <div class="radio-inline radio-small">
                                        <label>
                                            <input class="i-radio" type="radio" value="2" name="gender" required />Female</label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <i class="fa fa-home input-icon input-icon-show"></i>
                                        <label> Address *</label>
                                        <textarea required name="address" class="form-control">

                                     </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                                        <label>Password *</label>
                                        <input class="form-control" type="password" name="password" required placeholder="my secret password" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                                        <label>Confirm Password *</label>
                                        <input class="form-control" type="password" name="password_confirmation" required placeholder="my secret password confirmation" />
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit"> Join Us <i class="fa fa-plus"></i></button>
                        </form>
                    </div>
                </div>
                </div>
             @else
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <strong><i class="fa fa-info"></i> You are logged in as {{auth()->user()->first_name}}&nbsp;{{auth()->user()->last_name}}</strong>
                        <p>You can access your bookings and other information by clicking the bookings button above</p>
                    </div>
                </div>
            @endif
            </div>

        </div>

    <div class="gap"></div>

@endsection