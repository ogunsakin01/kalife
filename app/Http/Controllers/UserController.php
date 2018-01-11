<?php

namespace App\Http\Controllers;
use App\AccountStatus;
use App\Gender;
use App\Title;
use App\Role;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {

    $title = new Title();

    $titles = $title->fetchTitles();

    $roles = new Role();

    $roles = $roles->fetchRolesExceptAdmin();

    $gender = new Gender();

    $gender = $gender->fetchTypes();

    $status = new AccountStatus();

    $status = $status->fetchStatus();

    return view('backend.users.new', compact('titles', 'roles', 'status', 'gender'));
  }

  public function saveUser(Request $r)
  {
    $user = new User();

    $this->validate($r, [
      'title' => 'required',
      'first_name' => 'required',
      'last_name' => 'required',
      'date_of_birth' => 'required',
      'email' => 'required|email',
      'phone_number' => 'required|numeric',
      'address' => 'required',
      'gender' => 'required',
      'account_status' =>'required'
    ]);

    if($user->storeUser($r->all()))
    {
      $response = 1;

      return response()->json($response);
    }
    else
    {
      $response = 0;

      return response()->json($response);
    }

  }

  public function fetchUsers()
  {
    $user_object = new User();

    $role_object = new Role();

    $users = $user_object->fetch();

    if(is_null($users) || empty($users))
    {
      $response = false;

      return response()->json($response);
    }
    else
    {
      $users_array = array();

      foreach ($users as $user)
      {
        $user_array = array();

        $user_array['id'] = $user->id;

        $user_array['full_name'] = ucfirst($user->first_name). " ".ucfirst($user->last_name) ;

        $user_array['status'] = $user_object->status($user->account_status);

        $user_array['role'] = $role_object->role($user->id);

        array_push($users_array, $user_array);
      }

      return response()->json($users_array);
    }
  }

  public function deleteUser($id)
  {
    $user = new User();

    $delete_user = $user->destroys($id);

    if($delete_user)
    {
      $response = 1;

      return response()->json($response);
    }
    else
    {
      $response = 0;

      return response()->json($response);
    }
  }

  public function editUser($id)
  {
    $user_object = new User();

    $role_object = new Role();

    $user = $user_object->fetchUserById($id);

    $user_array = array();

    $user_array['title'] = $user->title;

    $user_array['first_name'] = $user->first_name;

    $user_array['last_name'] = $user->last_name;

    $user_array['other_name'] = $user->other_name;

    $user_array['date_of_birth'] = $user->date_of_birth;

    $user_array['phone_number'] = $user->phone_number;

    $user_array['address'] = $user->address;

    $user_array['account_status'] = $user->account_status;

    $user_array['gender'] = $user->gender;

    $user_array['email'] = $user->email;

    $user_array['agency_name'] = $user->agency_name;

    $user_array['agent_id'] = $user->agent_id;

    $user_array['office_number'] = $user->office_number;

    $user_array['role'] = $role_object->getUserRole($user->id);

    return response()->json($user_array);

  }
}
