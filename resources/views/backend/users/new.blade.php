@extends('layouts.backend')

@section('tab-title')New @endsection

@section('title')New @endsection

@section('content')
<div class="row">
  <div class="col-md-12">
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

        {!! Form::open(['route'=> 'backend-save-new-users']) !!}
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              {!! Form::label('','Title') !!}
              {!! Form::select('title',$titles ,null, ['id'=>'title', 'class'=>'form-control form-control-sm', 'placeholder'=>'choose title']) !!}
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              {!! Form::label('','Gender') !!}
              {!! Form::select('gender',$gender ,null, ['id'=>'gender', 'class'=>'form-control form-control-sm', 'placeholder'=>'choose gender']) !!}
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              {!! Form::label('','Account Status') !!}
              {!! Form::select('account_status',$status ,null, ['id'=>'account_status', 'class'=>'form-control form-control-sm', 'placeholder'=>'choose status']) !!}
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              {!! Form::label('','Role') !!}
              {!! Form::select('role', $roles ,null, ['id'=>'role', 'class'=>'form-control form-control-sm', 'placeholder'=>'choose role']) !!}
            </div>
          </div>


        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('','First Name') !!}
              {!! Form::text('first_name', null, ['id'=>'first_name', 'class'=>'form-control form-control', 'placeholder'=>'john']) !!}
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('','Last Name') !!}
              {!! Form::text('last_name', null, ['id'=>'last_name', 'class'=>'form-control form-control', 'placeholder'=>'doe']) !!}
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('','Other Name(s)') !!}
              {!! Form::text('other_name', null, ['id'=>'other_name', 'class'=>'form-control form-control', 'placeholder'=>'james']) !!}
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('','Phone Number') !!}
              {!! Form::text('phone_number', null, ['id'=>'phone_number', 'class'=>'form-control form-control', 'placeholder'=>'080XXXXXXXX']) !!}
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('','Date Of Birth') !!}
              {!! Form::text('date_of_birth', null, ['id'=>'date_of_birth', 'class'=>'form-control form-control', 'placeholder'=>'12/12/2012']) !!}
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('','Address') !!}
              {!! Form::text('address', null, ['id'=>'address', 'class'=>'form-control form-control', 'placeholder'=>'....']) !!}
            </div>
          </div>

        </div>

        <div class="card-header">
          Other Details
        </div>

        <br>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              {!! Form::label('','Email') !!}
              {!! Form::text('email', null, ['id'=>'email', 'class'=>'form-control form-control', 'placeholder'=>'johndoe@example.com']) !!}
            </div>
          </div>

          <div class="col-md-9" id="hide_agent">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('','Agency Name') !!}
                  {!! Form::text('agency_name', null, ['id'=>'agency_name', 'class'=>'form-control form-control', 'placeholder'=>'....']) !!}
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('','Agency ID') !!}
                  {!! Form::text('agent_id', null, ['id'=>'agent_id', 'class'=>'form-control form-control', 'placeholder'=>'....']) !!}
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('','Office Number') !!}
                  {!! Form::text('office_number', null, ['id'=>'office_number', 'class'=>'form-control form-control', 'placeholder'=>'....']) !!}
                </div>
              </div>
            </div>

          </div>

        </div>

        <div class="row">
          <div class="col-md-12">
            <button id="save_user" class="btn btn-alt-primary pull-right btn-sm" type="button">Save</button>
          </div>
        </div>

        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card">
      <div class="card-header">User List</div>
      <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper">
          <table id="users_table" class="table table-striped dataTable">
            <thead>
              <th>#</th>
              <th>Full Name</th>
              <th>Role</th>
              <th>Status</th>
              <th>Action</th>
            </thead>
            <tbody id="user_table_body">

            </tbody>
          </table>
          </div>
      </div>
    </div>
  </div>

</div>

@endsection

@section('javascript')
  <script type="text/javascript" src="{{url('backend/js/users.js')}}"></script>
@endsection