@extends('layouts.app')
@section('title') {{$name}} Booking @endsection
@section('activeAttraction')  active @endsection
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a>
            </li>
            <li><a href="{{url('/attractions')}}">Attractions</a>
            </li>
            <li><a href="#">{{\App\PackageCategory::find($attraction_info->category_id)->category}}</a>
            </li>
            <li class="active"><a>{{$name}}</a>
            </li>
        </ul>
        <div class="gap gap-small"></div>
        <div class="row">
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
            @if(session()->has('errorMessage'))
                <div class="alert alert-warning">
                    <i class="fa fa-warning"></i>
                    {{session()->get('errorMessage')}}
                </div>
            @endif
            <div class="col-md-8">

                @if(auth()->guest())
                    <p class="well">Existing customers, kindly <button class="btn btn-default btn-sm login-button">login <i class="fa fa-sign-in"></i></button> to continue </p>
                    <form method="post" action="{{url('/login')}}" class="login-form hidden">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon input-icon-show"></i>
                                        <label> Email</label>
                                        <input class="form-control" name="email" required type="email" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                                        <label> Password</label>
                                        <input class="form-control" name="password" required type="password" value=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary"> Login <i class="fa fa-sign-in"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="checkbox">
                            <label>
                                Can't remember password ? <a href="{{url('/password/reset')}}">Recover Here</a>
                            </label>
                        </div>
                    </form>
                    <p class="well">   New customers, kindly provide us with this few information</p>
                    <form method="post" class="panel" enctype="multipart/form-data" action="{{ url('/register') }}">
                        {{ csrf_field() }}
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
                        {{--<div class="row">
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
                                    <label> Address</label>
                                    <textarea required name="address" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>--}}
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
                        <button class="btn btn-primary" type="submit"> Join Us <i class="fa fa-user-plus"></i></button>
                    </form>

                    <div class="gap gap-small"></div>
                @else
                    <hr>
                    <div class="row">
                        <form method="post" action="{{url('/package-booking')}}">
                            {{csrf_field()}}
                            <ul class="list booking-item-passengers">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <i class="fa fa-info"></i>
                                            Your are logged in, select number of guests and proceed to payment.
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Of Adults</label>
                                            <select name="adults" class="form-control package_guests num_of_adults" required>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                <input type="hidden" name="total_amount" class="total_amount" value="0"/>
                                <input type="hidden" name="package_id" value="{{$id}}"/>
                                <input type="hidden" name="name" value="{{$name}}"/>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Of Kids</label>
                                            <select name="children" class="form-control package_guests num_of_children" required>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No Of infants</label>
                                        <select name="infants" class="form-control package_guests num_of_infants" required>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="col-md-12">
                                <img class="pp-img" src="{{url("img/payment/interswitch-New.png")}}" alt="Image Alternative text" title="Image Title" />
                                <img class="pp-img" src="{{url("img/payment/paystack_new_logo.png")}}" alt="Image Alternative text" title="Image Title" />
                                <p class="text-darken text-bigger">Important: Your information as registered with us will be used to book this room. You will be redirected to out payment page to securely make your payment and complete your reservation.</p>
                                <button class="btn btn-primary" id="package_payment" type="submit">Proceed to payment</button>
                            </div>
                            </ul>
                        </form>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="booking-item-payment">
                    <header class="clearfix">
                        <a class="booking-item-payment-img" href="#">
                            @if(isset($images[0]))

                                    <img src="{{asset($images[0]['image_path'])}}" alt="{{$name}}" style="width:100%; height: 100%" title="{{$name}}"/>
                            @else
                                <img src="{{asset('images/gallery/packages/no-image.jpg')}}"  alt="No image available for this attraction" title="No image available for this attraction" />
                            @endif
                        </a>
                        <h5 class="booking-item-payment-title"><a href="#">{{$name}}</a></h5>
                    </header>
                    <ul class="booking-item-payment-details">
                        <li>
                            {{--<h5>April, 27 Saturday</h5>--}}
                        </li>
                        <li>
                            <h5>Pricing</h5>
                            <ul class="booking-item-payment-price">
                                <li>
                                    <p class="booking-item-payment-price-title">1 Adult</p>
                                    <p class="booking-item-payment-price-amount">&#x20A6; {{number_format($attraction_info->adult_price, 2)}}</p>
                                </li>
                                <li>
                                    <p class="booking-item-payment-price-title">1 Child</p>
                                    <p class="booking-item-payment-price-amount">&#x20A6; {{number_format($attraction_info->child_price, 2)}}</p>
                                </li>
                                <li>
                                    <p class="booking-item-payment-price-title">1 Infant</p>
                                    <p class="booking-item-payment-price-amount">&#x20A6; {{number_format($attraction_info->infant_price, 2)}}</p>
                                </li>
                            </ul>
                        </li>
                    <li>
                        @if(auth()->guest())
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <i class="fa fa-warning"></i>
                                        User needs to be registered to continue booking
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Adults</label>
                                            <input type="number" value="0" disabled="" class="form-control num_of_adult_guests">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Children</label>
                                            <input type="number" value="0" disabled="" class="form-control num_of_child_guests">

                                        </div>
                                    </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Infants</label>
                                        <input type="number" value="0" disabled="" class="form-control num_of_infant_guests">

                                    </div>
                                </div>
                            </div>
                            @endif
                    </li>
                    </ul>
                    <p class="booking-item-payment-total">Total trip: <span>&#x20A6;<b class="total_package_amount">0.00</b></span></p>
                </div>
            </div>
        </div>
        <div class="gap"></div>
    </div>

    <script>
        // document.getElementsByClassName('num_of_adults').value(0);
        // document.getElementsByClassName('num_of_children').value(0);
        // document.getElementsByClassName('num_of_infants').value(0);
        // document.getElementsByClassName('num_of_adult_guests').value(0);
        // document.getElementsByClassName('num_of_child_guests').value(0);
        // document.getElementsByClassName('num_of_infant_guests').value(0);

        var adultsHere = document.getElementsByClassName('num_of_adults');
        var childrenHere   = document.getElementsByClassName('num_of_children');
        if((adultsHere[0].value == 0 ) && (childrenHere[0].value == 0)){
            document.getElementById('package_payment').disabled = true;
        }

        var adultPrice   = '{{$attraction_info->adult_price}}';
        var childPrice   = '{{$attraction_info->child_price}}';
        var infantPrice  = '{{$attraction_info->infant_price}}';
    </script>
@endsection