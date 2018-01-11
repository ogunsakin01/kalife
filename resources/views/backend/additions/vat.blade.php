@extends('layouts.backend')

@section('tab-title')VAT @endsection

@section('title')VAT Management @endsection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Add VAT
        </div>
        <div class="card-body">
          <div class="alert alert-info" role="alert">
            <i class="fa fa-info-circle"></i>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Note!</strong> all fields are required
          </div>

          {!! Form::open(['route'=> 'backend-save-vat']) !!}
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                {!! Form::select('vat_type',$vat_types ,null, ['id'=>'vat_type', 'class'=>'form-control form-control-sm', 'placeholder'=>'choose vat type']) !!}
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {!! Form::select('vat_value_type',$vat_value_types ,null, ['id'=>'vat_value_type', 'class'=>'form-control form-control-sm', 'placeholder'=>'choose vat value type']) !!}
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {!! Form::number('vat_value',null, ['id'=>'vat_value', 'class'=>'form-control', 'placeholder'=>'vat value e.g. 12.00']) !!}
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <button id="save_vat" class="btn btn-alt-primary btn-sm pull-right" type="button">Save</button>
            </div>
          </div>

          {!! Form::close() !!}
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">vat List</div>
        <div class="card-body">
          <table class="table table-sm">
            <thead>
            <tr>
              <th>#</th>
              <th>Type</th>
              <th>Value Type</th>
              <th>Value</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody id="vat-body">

            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
  <script type="text/javascript" src="{{asset('backend/js/vat.js')}}"></script>
@endsection