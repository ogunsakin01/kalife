@extends('layouts.backend')

@section('tab-title')Markup @endsection

@section('title')Markup Management @endsection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Add Markup
        </div>
        <div class="card-body">
          <div class="alert alert-info" role="alert">
            <i class="fa fa-info-circle"></i>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Note!</strong> all fields are required
          </div>

          {!! Form::open() !!}

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                {!! Form::select('role',['1'=>'1'] ,null, ['id'=>'role', 'class'=>'form-control form-control-sm', 'placeholder'=>'select role']) !!}
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::text('markup_type',null, ['id'=>'role', 'class'=>'form-control', 'placeholder'=>'markup type']) !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::number('markup_value',null, ['id'=>'role', 'class'=>'form-control', 'placeholder'=>'markup value']) !!}
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-12">
              <button id="save_role" class="btn btn-alt-primary btn-sm pull-right" type="button">Save</button>
            </div>
          </div>

          {!! Form::close() !!}
        </div>
      </div>
    </div>

  </div>
@endsection