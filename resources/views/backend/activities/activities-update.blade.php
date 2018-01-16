@extends('layouts.backend')
@section('tab-title')Activities  @endsection

@section('title')New Activities @endsection
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

  <div class="row">
    {!! Form::model($activities, ['method'=>'PATCH', 'action'=>['ActivitiesController@updateActivityInformation', $activities->id ]]) !!}
    <div class="col-md-6">
      <div class="panel panel-white">
        <div class="panel-heading">
          <div class="panel-title"><i class="fa fa-info"></i> Update activity information</div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group col-md-6">
                {!! Form::label('package_type_id', 'Package type') !!}
                {!! Form::select('package_type_id', \App\PackageType::getPackageTypes(), null, ['class'=> 'form-control', 'placeholder'=>'Choose package type', 'required'=>'required']) !!}
              </div>
              <div class="form-group col-md-6">
                {!! Form::label('package_category_id', 'Package Category') !!}
                {!! Form::select('package_category_id',\App\PackageCategory::getPackageCategories(), null, ['class'=> 'form-control', 'placeholder'=>'Choose package category', 'required'=>'required']) !!}
              </div>
              <div class="form-group col-md-6">
                {!! Form::label('package_name', 'Package name') !!}
                {!! Form::text('package_name', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>
              <div class="form-group col-md-6">
                {!! Form::label('location', 'Location') !!}
                {!! Form::text('location', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>
              <div class="form-group col-md-6">
                {!! Form::label('phone_number', 'Phone number') !!}
                {!! Form::text('phone_number', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>

              <div class="form-group col-md-6">
                {!! Form::label('time_length', 'Time length') !!}
                {!! Form::text('time_length', null, ['class'=>'form-control' , 'required'=>'required']) !!}
              </div>
              <div class="form-group col-md-6">
                {!! Form::label('duration_type', 'Duration type') !!}
                {!! Form::select('duration_type', getDurationType(), null, ['class'=> 'form-control', 'placeholder'=>'Choose duration type', 'required'=>'required']) !!}
              </div>

              <div class="form-group col-md-6">
                {!! Form::label('transports', 'Transports') !!}
                {!! Form::text('transports', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>
              <div class="form-group col-md-6">
                {!! Form::label('language_spoken', 'Language spoken') !!}
                {!! Form::text('language_spoken', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>

              <div class="form-group col-md-6">
                {!! Form::label('adult_price', 'Adult price') !!}
                {!! Form::text('adult_price', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>
              <div class="form-group col-md-6">
                {!! Form::label('kids_price', 'Kids price') !!}
                {!! Form::text('kids_price', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              {!! Form::submit('Update', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    {!! Form::close() !!}

    {{--{!! Form::model($activities, ['method'=>'PATCH', 'action'=>['ActivitiesController@updateTimeSchedule', $activities->id ]]) !!}--}}
    <div class="col-md-6">
      <div class="panel panel-white">
        <div class="panel-heading">
          <div class="panel-title"><i class="fa fa-truck"></i> Update sight seeing</div>
        </div>
        <div class="panel-body">
          <table class="table table-responsive table-bordered">
            <thead>
              <th>#</th>
              <th>Title</th>
              <th>Description</th>
              <th>Action</th>
            </thead>

            <tbody>
              @foreach($sight_seeing as $serial => $sights)
                <tr>
                  <td>{{$serial+1}}</td>
                  <td>{{$sights->title}}</td>
                  <td>{{substr($sights->description, 0, 50)}}</td>
                  <td>
                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_sight_{{$sights->id}}" ><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_sight_{{$sights->id}}"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>

                <div class="modal fade" id="edit_sight_{{$sights->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md">
                    {!! Form::open(['url'=>'activities/update/sight-seeing']) !!}
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="mySmallModalLabel">Add sight seeing</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="form-group col-md-12">
                            {!! Form::label('trip_schedule', 'Title') !!}
                            {!! Form::text('title', $sights->title, ['class'=>'form-control', 'required'=>'required']) !!}
                            {!! Form::hidden('sight_id', $sights->id) !!}
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-12">
                            {!! Form::label('description', 'Schedule description') !!}
                            {!! Form::textarea('description', $sights->description, ['class'=>'form-control', 'rows'=>'10', 'cols'=> '10', 'required'=>'required']) !!}
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                      </div>
                    </div>
                    {!! Form::close() !!}
                  </div>
                </div>
                <div class="modal fade" id="delete_sight_{{$sights->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="mySmallModalLabel">Confirmation</h4>
                      </div>
                      <div class="modal-body">
                        Are you sure?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-danger" href="{{url('activities/delete/sight')}}/{{$sights->id}}">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{--{!! Form::close() !!}--}}
  </div>

  <div class="row">
    {!! Form::model($good_to_knows, ['method'=>'PATCH', 'action'=>['ActivitiesController@updateGoodToKnow', $good_to_knows->id ]]) !!}
    <div class="col-md-6">
      <div class="panel panel-white">
        <div class="panel-heading">
          <div class="panel-title"><i class="fa fa-info"></i> Update good to know</div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group col-md-6">
                {!! Form::label('check_in', 'Check in') !!}
                {!! Form::text('check_in', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>
              <div class="form-group  col-md-6">
                {!! Form::label('check_out', 'Check out') !!}
                {!! Form::text('check_out', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>
              <div class="form-group col-md-6">
                {!! Form::label('cancellation_prepayment', 'Cancellation/prepayment') !!}
                {!! Form::text('cancellation_prepayment', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>
              <div class="form-group col-md-6">
                {!! Form::label('children_beds', 'Children and extra beds') !!}
                {!! Form::text('children_beds', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>
              <div class="form-group col-md-6">
                {!! Form::label('internet', 'Internet') !!}
                {!! Form::text('internet', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>
              <div class="form-group col-md-6">
                {!! Form::label('pets', 'Pets') !!}
                {!! Form::text('pets', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>

              <div class="form-group col-md-6">
                {!! Form::label('groups', 'Groups') !!}
                {!! Form::text('groups', null, ['class'=>'form-control', 'required'=>'required']) !!}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              {!! Form::submit('Update', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    {!! Form::close() !!}

    <div class="col-md-6">
      <div class="panel panel-white">
        <div class="panel-heading">
          <div class="panel-title"><i class="fa fa-info"></i> Update gallery</div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                {!! Form::open(['url'=> 'activities/gallery/'. $activities->id, 'files'=> 'true']) !!}
                <div class="form-group col-md-7">
                  {!! Form::file('photo_1', ['class'=>'form-control']) !!}
                </div>
                <div class="col-md-5">
                  {!! Form::submit('Upload', ['class'=>'btn btn-primary']) !!}
                </div>
              </div>
              <div class="row">

              </div>

              <div class="row">
                <div class="col-md-12">
                  <table class="display table" style="width: 100%;">
                    <thead>
                      <th>#</th>
                      <th>Package name</th>
                      <th>Action</th>
                    </thead>

                    <tbody>
                      @foreach($pictures as $serial => $picture)
                        <tr>
                          <td>{{$serial+1}}</td>
                          <td>{{$picture->package->package_name}}</td>
                          <td>
                            <a class="btn btn-info btn-sm" href="{{url($picture->image_path)}}" target="_blank"><i class="fa fa-picture-o"></i></a>
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_{{$picture->id}}"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <div class="modal fade" id="delete_{{$picture->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="mySmallModalLabel">Confirmation</h4>
                              </div>
                              <div class="modal-body">
                                Are you sure?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <a type="button" class="btn btn-danger" href="{{url('activities/delete/picture')}}/{{$picture->id}}">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
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
@endsection