<?php

namespace App;

use App\Mail\PasswordResetLink;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Zizaco\Entrust\Traits\EntrustUserTrait;
class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',  'first_name', 'last_name', 'other_name',
        'date_of_birth', 'email',  'phone_number',
        'address', 'gender', 'password', 'account_status',
        'agency_name', 'agency_id', 'office_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $active = 1;

    public $inactive = 0;

    public static function getUserByEmail($email)
    {
        $user = static::where('email', $email)->first();

        if(is_null($user) || empty($user)){
            return "0";
        }
        else{
            return $user;
        }

    }

    public static function getUserById($id)
    {
        $user = static::where('id', $id)->first();
        if(is_null($user) || empty($user)){
            return "0";
        }
        else{
            return $user;
        }

    }

    public function generateRandomPassword()
    {
      $password = str_random(8);

      return $password;
    }

    public function hashPassword($password)
    {
      return Hash::make($password);
    }

    public function storeUser($data)
    {
      $password = $this->generateRandomPassword();

      $user = static::updateOrCreate(
        [
            'email' => $data['email']
        ],

        [
            'title' => $data['title'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'other_name' => $data['other_name'],
            'date_of_birth' => $data['date_of_birth'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'gender' => $data['gender'],
            'account_status' => $data['account_status'],
            'email' => $data['email'],
            'password' => $this->hashPassword($password),
            'agency_name' => $data['agency_name'],
            'agent_id' => $data['agent_id'],
            'office_number' => $data['office_number']
        ]
      );

      if ($user)
      {
        $role = Role::where('id', $data['role'])->first();

        $user->detachRole($role);
        $user->attachRole($role);

        return true;
      }

      return false;
    }

    public function fetch()
  {
    return static::orderBy('created_at', 'ASC')->get();
  }

    public function status($status)
    {
      if ($status ==  1)
      {
        return '<span class="badge badge-success"><i class="fa fa-check"></i>&nbsp;ACTIVE</span>';
      }
      elseif ($status == 0)
      {
        return '<span class="badge badge-danger"><i class="fa fa-times"></i>&nbsp;INACTIVE</span>';
      }
    }

    public function destroys($id)
  {
    if (static::where('id', $id)->delete())
    {
      return true;
    }

    return false;
  }

    public function fetchUserById($id)
    {
      return static::where('id', $id)->first();
    }

    public function checkLogin()
    {
      if (auth()->check())
      {
        return redirect()->route('backend-home');
      }
      else
      {
        return view('backend.auth.login');
      }
    }

    public function ifUserExists(array $data)
    {
      $user = static::where('email', $data['email'])->first();

      if(is_null($user) || empty($user))
      {
        return false;
      }
      else
      {
        return true;
      }
    }

    public function comparePasswordHash(array $data)
    {
      $user = static::where('email', $data['email'])->first();

      if(Hash::check($data['password'], $user->password))
      {
        return true;
      }
      return false;
    }

    public function ifPasswordExists(array $data)
      {
        $user = static::where('email', $data['email'])->first();

        if($user->password == $data['password'])
        {
          return true;
        }

        return false;
      }

    public function checkAccountStatus(array $data)
    {
      $user = static::where('email', $data['email'])->first();

      if($user->status == $this->active)
      {
        return true;
      }
      return false;
    }

    public function authenticateUser(array $data)
    {
      if ($this->ifUserExists($data))
      {
        if ($this->comparePasswordHash($data))
        {
          if ($this->checkAccountStatus($data))
          {
            /*
             * Authenticate user
             * */
            $response = 1;

            $user = static::where('email', $data['email'])->first();

            auth()->login($user);

            return response()->json($response);
          }
          else
          {
            /*
             * Return user back. user has been blocked
             * */
            $response = 2;

            return response()->json($response);
          }
        }
        else
        {
          /*
           * Return user back. Incorrect email/ password
           * */
          $response = 0;

          return response()->json($response);
        }
      }
      else
      {
        /*
         * Return user back. Incorrect email/ password
         * */
        $response = 0;

        return response()->json($response);
      }
    }

    public function checkPasswordResetEmail(array $data)
    {
      if ($this->ifUserExists($data))
      {
        try
        {
          Mail::to($data['email'])->send(new PasswordResetLink($data['email']));

          $response = 1;

          return response()->json($response);
        }
        catch (\Exception $e)
        {
          $response = 0;

          return response()->json($response);
        }
      }
      else
      {
        $response = 0;

        return response()->json($response);
      }
    }

    public function getFirstNameByEmail($email)
    {
      return static::where('email', $email)->first()->first_name;
    }

}
