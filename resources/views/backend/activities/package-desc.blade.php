@extends('layouts.backend')
@section('tab-title')Packages  @endsection

@section('title')New Package Description @endsection
@section('content')
    <div class="row">
    <div class="col-md-12">
      <div class="panel panel-white">
        <div class="panel-body">
          <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper">
              <table id="flight_table" class="display table dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                <thead>
                <tr>
                  <th rowspan="1" colspan="1">#</th>
                  <th rowspan="1" colspan="1">Package type</th>
                  <th rowspan="1" colspan="1">Package category</th>
                  <th rowspan="1" colspan="1">Package name</th>
                  <th rowspan="1" colspan="1">Phone number</th>
                  <th rowspan="1" colspan="1">Time length</th>
                  <th rowspan="1" colspan="1">Adult price (&#x20A6;)</th>
                  <th rowspan="1" colspan="1">Kids price (&#x20A6;)</th>
                  <th rowspan="1" colspan="1">Status</th>
                  <th rowspan="1" colspan="1">Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($activities as $serial=> $activity)
                    <tr>
                      <td>{{$serial+1}}</td>
                      <td>
                        @if($activity->flight)
                          <button data-toggle="modal" data-target="#flight_{{$activity->id}}" class="btn btn-success btn-sm">Flight</button>
                        @endif
                        @if($activity->hotel)
                          <button data-toggle="modal" data-target="#hotel_{{$activity->id}}" class="btn btn-info btn-sm">Hotel</button>
                        @endif
                        @if($activity->attraction)
                          <button data-toggle="modal" data-target="#atrraction_{{$activity->id}}"class="btn btn-warning btn-sm">Attraction</button>
                        @endif
                        {{--{{$activity->packageType->type}}--}}
                      </td>
                      <td>{{$activity->packageCategory->category}}</td>
                      <td>{{$activity->package_name}}</td>
                      <td>{{$activity->phone_number}}</td>
                      <td>{{$activity->time_length}}</td>
                      <td>{{number_format($activity->adult_price)}}</td>
                      <td>{{number_format($activity->kids_price)}}</td>
                      <td id="status{{$activity->id}}">
                        @if($activity->status == \App\Package::DEACTIVATED)
                          <span disabled class="btn btn-danger btn-xs">Deactivated</span>
                        @elseif($activity->status == \App\Package::ACTIVATED)
                          <span disabled class="btn btn-success btn-xs">Activated</span>
                        @endif
                      </td>
                      <td>
                        <a class="btn btn-success btn-sm" onclick="activate({{$activity->id}})"><i class="fa fa-check"></i></a>
                        <a class="btn btn-warning btn-sm" onclick="deactivate({{$activity->id}})"><i class="fa fa-times"></i></a>
                        <a class="btn btn-info btn-sm" href="{{url('activities/edit')}}/{{$activity->id}}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_{{$activity->id}}"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>

                    <div class="modal fade" id="add_trip_{{$activity->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-md">
                        {!! Form::open(['url'=>'activities/sight-seeing']) !!}
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="mySmallModalLabel">Add sight seeing</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="form-group col-md-12">
                                {!! Form::label('trip_schedule', 'Title') !!}
                                {!! Form::text('title', null, ['class'=>'form-control', 'required'=>'required']) !!}
                                {!! Form::hidden('package_id', $activity->id) !!}
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-12">
                                {!! Form::label('description', 'Schedule description') !!}
                                {!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>'10', 'cols'=> '10', 'required'=>'required']) !!}
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
                    <div class="modal fade" id="delete_{{$activity->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="mySmallModalLabel">Confirmation</h4>
                          </div>
                          <div class="modal-body">

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a type="button" class="btn btn-danger" href="{{url('activities/delete')}}/{{$activity->id}}">Delete</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="flight_{{$activity->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="mySmallModalLabel">Flight Information</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a type="button" class="btn btn-danger" href="{{url('activities/delete')}}/{{$activity->id}}">Delete</a>
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
@endsection