@extends('layouts.backend')

@section('tab-title')New @endsection

@section('title')New @endsection

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        Create User
      </div>
      <div class="card-body">
        <div class="alert alert-info" role="alert">
          <i class="fa fa-info-circle"></i>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          <strong>Note!</strong> all fields are required
        </div>

        {!! Form::open(['route'=> 'backend-new-users']) !!}
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              {!! Form::select('title',$titles ,null, ['id'=>'title', 'class'=>'form-control form-control-sm', 'placeholder'=>'choose title']) !!}
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              {!! Form::select('gender',['',''] ,null, ['id'=>'title', 'class'=>'form-control form-control-sm', 'placeholder'=>'choose gender']) !!}
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::text('first_name', null, ['id'=>'first_name', 'class'=>'form-control form-control', 'placeholder'=>'john']) !!}
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              {!! Form::text('last_name', null, ['id'=>'last_name', 'class'=>'form-control form-control', 'placeholder'=>'doe']) !!}
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              {!! Form::text('other_name', null, ['id'=>'other_name', 'class'=>'form-control form-control', 'placeholder'=>'james']) !!}
            </div>
          </div>

        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <div class="col-md-4">

  </div>
</div>
@endsection