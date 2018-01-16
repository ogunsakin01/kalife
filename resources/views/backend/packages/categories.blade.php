@extends('layouts.backend')
@section('tab-title')Packages @endsection

@section('title')Packages Categories @endsection
@section('content')
  <div class="row">
    <div class="col-md-7">
      <div class="panel panel-white">
        <div class="panel-body">
          <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper">
              @include('flash::message')
              @if($errors->any())
                <ul class="alert alert-danger" style="list-style: none;">
                  @foreach($errors->all() as $error)
                    <li style="color: #000 !important;"> {{ $error }} </li>
                  @endforeach
                </ul>
              @endif
              <table id="flight_table" class="display table dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                <div class="row">
                  <div class="col-md-12">
                    <a class="btn btn-success btn-addon pull-right btn-sm" data-toggle="modal" data-target="#add_package_category"><i class="fa fa-plus"></i>New</a>
                  </div>
                </div>
                <br>
                <thead>
                <tr>
                  <th rowspan="1" colspan="1">#</th>
                  <th rowspan="1" colspan="1">Package Category</th>
                  <th rowspan="1" colspan="1">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($package_categories as $serial => $package_category)
                  <tr>
                    <td>{{$serial+1}}</td>
                    <td>{{$package_category->category}}</td>
                    <td>
                      <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_{{$package_category->id}}"><i class="fa fa-edit"></i></a>
                      <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_{{$package_category->id}}"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  <div class="modal fade" id="edit_{{$package_category->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="mySmallModalLabel">Edit package category</h4>
                        </div>
                        <div class="modal-body">
                          {!! Form::open(['url'=>'package/categories/'.$package_category->id]) !!}
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                {!! Form::label('package_categories','Package category') !!}
                                {!! Form::text('package_categories',$package_category->category, ['class'=>'form-control']) !!}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          {!! Form::submit('Update', ['class'=>'btn btn-success pull-right']) !!}
                        </div>
                        {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="delete_{{$package_category->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                          <a type="button" class="btn btn-danger" href="{{url('package/categories')}}/{{$package_category->id}}">Delete</a>
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
  <div class="modal fade" id="add_package_category" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="mySmallModalLabel">Add package category</h4>
        </div>
        <div class="modal-body">
          {!! Form::open(['url'=>'package/categories']) !!}
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                {!! Form::label('package_categories','Package category') !!}
                {!! Form::text('package_categories',null, ['class'=>'form-control']) !!}
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          {!! Form::submit('Save', ['class'=>'btn btn-success pull-right']) !!}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection