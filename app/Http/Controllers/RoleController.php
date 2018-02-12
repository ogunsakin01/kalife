<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        $permissions = Permission::all();
        return view('backend.additions.manage_users_roles',compact('roles','permissions'));
    }

    public function addPermission(Request $r){
        $role = Role::find($r->role_id);
        $permission = Permission::find($r->permission_id);

        if($role->perms->contains($permission)){
            return 2;
        }else{
          $save = $role->attachPermission($permission);
          return 1;
        }
    }
}
