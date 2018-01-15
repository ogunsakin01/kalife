@extends('layouts.app')
@section('title')Manage your information @endsection
@section('user') active @endsection
@section('content')
    <div class="gap gap-small"></div>
    <div class="container">
        <h1 class="page-title">Manage your information</h1>
    </div>
    <div class="container">
        <div class="row">
            @include('partials.profileSideBar')
            <div class="col-md-9">
                <div class="row">
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
                            @elseif(session()->has('errorMessage'))
                                <div class="alert alert-danger">
                                    <i class="fa fa-check"></i>
                                    {{session()->get('errorMessage')}}
                                </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <form method="post" enctype="multipart/form-data" action="{{ url('/update-user') }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{auth()->user()->id}}" name="id"/>
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
                                        <option @if(auth()->user()->title == 1) selected @endif value="1">Mr.</option>
                                        <option @if(auth()->user()->title == 2) selected @endif value="2">Mrs.</option>
                                        <option @if(auth()->user()->title == 3) selected @endif value="3">MISS</option>
                                        <option @if(auth()->user()->title == 4) selected @endif value="4">MASTER</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                    <label>First Name *</label>
                                    <input class="form-control" name="first_name" value="{{auth()->user()->first_name}}" required placeholder="" type="text" />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                    <label>Last Name *</label>
                                    <input class="form-control" name="last_name" value="{{auth()->user()->last_name}}"  required placeholder="" type="text" />
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                    <label>Other Name</label>
                                    <input class="form-control" name="other_name" value="{{auth()->user()->other_name}}"  placeholder="e.g. Smith" type="text" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-group-icon-left">
                                    <i class="fa fa-envelope input-icon input-icon-show"></i>
                                    <label>Email</label>
                                    <input class="form-control" placeholder="" value="{{auth()->user()->email}}" disabled="disabled" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-group-icon-left">
                                    <i class="fa fa-phone input-icon input-icon-show"></i>
                                    <label>Phone Number *</label>
                                    <input class="form-control" name="phone_number" value="{{auth()->user()->phone_number}}"  required placeholder="" type="number" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-group-icon-left">
                                    <i class="fa fa-calendar input-icon input-icon-show"></i>
                                    <label>Date of Birth *</label>
                                    <input class="date-pick-adult form-control" name="date_of_birth" value="{{auth()->user()->date_of_birth}}"  required type="text" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Gender *</label>
                                <div class="radio-inline radio-small">
                                    <label>
                                        <input class="i-radio" type="radio" value="1" @if(auth()->user()->gender == 1)checked="true"@endif name="gender" required />Male</label>
                                </div>
                                <div class="radio-inline radio-small">
                                    <label>
                                        <input class="i-radio" type="radio" value="2" @if(auth()->user()->gender == 2)checked="true"@endif name="gender" required />Female</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-group-icon-left">
                                    <i class="fa fa-image input-icon input-icon-show"></i>
                                    <label>Add profile photo *</label>
                                    <input class="form-control" name="photo" type="file" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <i class="fa fa-home input-icon input-icon-show"></i>
                                    <label> Address *</label>
                                    <textarea required name="address" class="form-control">
                                       {{auth()->user()->address}}
                                     </textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit"> Update Information</button>
                    </form>
                    <div class="gap gap-small"></div>
                    <form method="post" action="{{url('/update-password')}}">
                        {{csrf_field()}}
                        <input type="hidden" value="{{auth()->user()->id}}" name="id"/>
                        <h4>Change Password</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                                    <label>Old Password *</label>
                                    <input class="form-control" type="password" name="old_password" required placeholder="my secret password" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                                    <label>Password *</label>
                                    <input class="form-control" type="password" name="password" required placeholder="my secret password" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                                    <label>Confirm Password *</label>
                                    <input class="form-control" type="password" name="password_confirmation" required placeholder="my secret password confirmation" />
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit"> Change Password </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="gap"></div>
@endsection