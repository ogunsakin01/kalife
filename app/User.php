<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


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

}
