@extends('layouts.backend')

@section('tab-title')Roles and Permissions @endsection

@section('title')Users Roles and Permissions Management @endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3" id="enter_bank_details_card_body">
            <div class="card">
                <div class="card-header">
                    <h3 id="save_header">Add Permission</h3>
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>User Type</label>
                                 <select class="form-control" id="role_id">
                                     <option value="">[SELECT USER]</option>
                                     @foreach($roles as $serial => $role)
                                     <option value="{{$role->id}}">{{$role->display_name}}</option>
                                      @endforeach
                                 </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Permission</label>
                                <select class="form-control" id="permission_id">
                                    <option value="">[SELECT PERMISSION]</option>
                                    @foreach($permissions as $serial => $permission)
                                    <option value="{{$permission->id}}">{{$permission->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-alt-primary upload-bank pull-right" id="save_permission">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script src="{{asset('backend/js/roles.js')}}" type="text/javascript"></script>
@endsection