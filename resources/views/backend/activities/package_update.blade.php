@extends('layouts.backend')
@section('tab-title')Packages @endsection

@section('title')Edit PAckage @endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('flash::message')
            @if($errors->any())
                <ul class="alert alert-danger" style="list-style: none;">
                    @foreach($errors->all() as $error)
                        <li style="color: #000 !important;"> {{ $error }} </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div id="package_info" class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title"><i class="fa fa-info"></i> Package Information</h4>
                </div>
                <div class="panel-body">
                    {!! Form::model(['url'=>'packages', 'method'=>'POST', 'files'=>'true']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group col-md-6">
                                        {!! Form::label('package_type_id', 'Package type') !!}
                                        <br>
                                        <label>{{ Form::checkbox('flight', null, null, ['id'=>'flight', 'class' => 'form-control']) }}Flight</label>
                                        <label>{{ Form::checkbox('hotel', null, null, ['id'=>'hotel', 'class' => 'form-control']) }}Hotel</label>
                                        <label>{{ Form::checkbox('attraction', null, null, ['id'=>'attraction', 'class' => 'form-control']) }}Attraction</label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('package_category_id', 'Package Category') !!}
                                        {!! Form::select('package_category_id',\App\PackageCategory::getPackageCategories(), null, ['id'=>'package_category_id', 'class'=> 'form-control', 'placeholder'=>'Choose package category', 'required'=>'required']) !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('package_name', 'Package name') !!}
                                        {!! Form::text('package_name', null, ['id'=>'package_name', 'class'=>'form-control', 'required'=>'required']) !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('phone_number', 'Phone number') !!}
                                        {!! Form::text('phone_number', null, ['id'=>'phone_number', 'class'=>'form-control', 'required'=>'required']) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group col-md-6">
                                        {!! Form::label('time_length', 'Time length') !!}
                                        {!! Form::text('time_length', null, ['id'=>'time_length', 'class'=>'form-control' , 'required'=>'required']) !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('language_spoken', 'Language spoken') !!}
                                        {!! Form::select('language_spoken', $lang, null, ['id'=>'language_spoken', 'class'=>'form-control', 'placeholder'=>'Select Language', 'required'=>'required']) !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('adult_price', 'Adult price') !!}
                                        {!! Form::text('adult_price', null, ['id'=>'adult_price', 'class'=>'form-control', 'required'=>'required']) !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('kids_price', 'Kids price') !!}
                                        {!! Form::text('kids_price', null, ['id'=>'kids_price', 'class'=>'form-control', 'required'=>'required']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            {!! Form::submit('Proceed', ['id'=> 'submit_package_info', 'class' => 'btn btn-success pull-right']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="flight_info" class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title"><i class="fa fa-info"></i> Flight Information</h4>
                </div>
                <div class="panel-body">
                    {!! Form::model(['url'=>'packages', 'method'=>'POST']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-md-6">
                                {!! Form::label('from_location', 'Departure Airport') !!}
                                {!! Form::text('from_location[]', null, ['class'=> 'form-control', 'id'=>'departure_city', 'placeholder'=>'Choose Departure Airline', 'required'=>'required']) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('to_location', 'Arrival Airport') !!}
                                {!! Form::text('to_location[]', null, ['class'=> 'form-control', 'id'=>'arrival_city', 'placeholder'=>'Choose Arrival Airport', 'required'=>'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group col-md-6">
                                {!! Form::label('airline', 'Airline name') !!}
                                {!! Form::text('airline[]', null, ['class'=>'form-control' , 'required'=>'required']) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('departure_date_time', 'Departure Date & Time') !!}
                                {!! Form::text('departure_date_time[]', null, ['class'=>'form-control', 'required'=>'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div id="add_flight"></div>
                    <div class="pull-right">
                        <button id="add_flight_btn" type="button" class="btn btn-default"><i class="fa fa-plus"></i> Add Flight</button>
                        {!! Form::submit('Proceed', ['id'=> 'submit_flight_info', 'class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="hotel_info" class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title"><i class="fa fa-info"></i> Hotel Information</h4>
                </div>
                <div class="panel-body">
                    {!! Form::model(['url'=>'packages', 'method'=>'POST', 'files'=>'true']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-md-6">
                                {!! Form::label('hotel_name', 'Hotel name') !!}
                                {!! Form::text('hotel_name[]', null, ['class'=>'form-control', 'required'=>'required']) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('address', 'Address') !!}
                                {!! Form::text('address[]', null, ['class'=>'form-control', 'required'=>'required']) !!}
                            </div>
                            <div class="form-group col-md-12">
                                {!! Form::label('hotel_info', 'Hotel Information') !!}
                                {!! Form::textarea('hotel_info[]', null, ['class'=>'form-control', 'rows'=> 2, 'required'=>'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group col-md-6">
                                {!! Form::label('hotel_star_rating', 'Hotel Star Rating') !!}
                                {!! Form::text('hotel_star_rating[]', null, ['class'=>'form-control' , 'required'=>'required']) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('hotel_location', 'Hotel Location') !!}
                                {!! Form::text('hotel_location[]', null, ['class'=>'form-control', 'required'=>'required']) !!}
                            </div>
                        </div>
                    </div>

                    <div id="add_hotel"></div>

                    <div class="pull-right">
                        <button id="add_hotel_btn" type="button" class="btn btn-default"><i class="fa fa-plus"></i> Add Hotel</button>
                        {!! Form::submit('Proceed', ['id'=> 'submit_hotel_info', 'class' => 'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="attraction_info" class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title"><i class="fa fa-info"></i> Attraction Information</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url'=>'packages', 'method'=>'POST', 'files'=>'true']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-md-6">
                                {!! Form::label('attraction_name', 'Attraction name') !!}
                                {!! Form::text('attraction_name', null, ['class'=>'form-control', 'required'=>'required']) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('address', 'Address') !!}
                                {!! Form::textarea('address', null, ['id'=>'address', 'class'=>'form-control', 'rows'=> 2, 'required'=>'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group col-md-6">
                                {!! Form::label('transports', 'Transports') !!}
                                {!! Form::text('transports', null, ['class'=>'form-control' , 'required'=>'required']) !!}
                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::label('duration', 'Duration') !!}
                                {!! Form::text('duration', null, ['class'=>'form-control', 'required'=>'required']) !!}
                            </div>
                        </div>

                        <div id="add_attraction"></div>
                    </div>
                    <div class="pull-right">
                        {!! Form::submit('Proceed', ['id'=> 'submit_attraction_info', 'class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="sight_seeing" class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title"><i class="fa fa-info"></i> Sight Seeing</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url'=>'packages', 'method'=>'POST']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                {!! Form::label('title', 'Title') !!}
                                {!! Form::text('s_title[]', null, ['class'=>'form-control', 'required'=>'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                {!! Form::label('description', 'Description') !!}
                                {!! Form::text('s_description[]', null, ['class'=>'form-control', 'required'=>'required']) !!}
                            </div>
                        </div>

                    </div>
                    <div id="add_sight_seeing"></div>
                    <div class="pull-right">
                        <button id="add_sight_seeing_btn" type="button" class="btn btn-default"><i class="fa fa-plus"></i> Add Sight Seeing</button>
                        {!! Form::button('Proceed', ['id'=> 'submit_sight_seeing', 'class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="good_to_know" class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title"><i class="fa fa-info"></i> Good to Know</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url'=>'packages', 'method'=>'POST']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                {!! Form::label('title', 'Title') !!}
                                {!! Form::text('g_title[]', null, ['class'=>'form-control', 'required'=>'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                {!! Form::label('description', 'Description') !!}
                                {!! Form::text('g_description[]', null, ['class'=>'form-control', 'required'=>'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div id="add_good_to_know"></div>
                    <div class="pull-right">
                        <button id="add_good_to_know_btn" type="button" class="btn btn-default"><i class="fa fa-plus"></i> Add Good to Know</button>
                        {!! Form::button('Proceed', ['id'=> 'submit_good_to_know_info', 'class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="gallery" class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title"><i class="fa fa-info"></i> Gallery</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url'=>'packages/storeGalleryInfo', 'method'=>'POST', 'files'=>'true', 'enctype' => 'multipart/form-data', 'class'=>'dropzone', 'id' => 'image-upload']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <div>
                                    <h3>Drag and Drop or Click On Box to Select Multiple Images</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('packages') }}" class="btn btn-success pull-right"><i class="fa fa-check"></i> Complete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection