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

        </div>

        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <div class="col-md-4">

  </div>
</div>
@endsection