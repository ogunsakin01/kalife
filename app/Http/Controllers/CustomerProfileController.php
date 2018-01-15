<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerProfileController extends Controller
{

   public function updateProfile(Request $r){
       $this->validate($r, [
           'first_name' => 'required|string',
           'last_name' => 'required|string',
           'other_name' => 'string',
           'phone_number' => 'required|string',
           'date_of_birth' => 'required|string',
           'address' => 'required|string',
           'photo' => 'mimes:bmp,png,jpg,jpeg,tif,gif'
       ]);

       $userInfo = User::getUserById(auth()->user()->id);
       $photo = $r->photo;
       if(!is_null($photo)){
           $path = $photo->store('uploads/profile/'.auth()->user()->id);
           $photo->move('uploads/profile/'.auth()->user()->id,$path);
           $userInfo->profile_photo = $path;
       }
       $userInfo->first_name = $r['first_name'];
       $userInfo->last_name = $r['last_name'];
       $userInfo->other_name = $r['other_name'];;
       $userInfo->date_of_birth = $r['date_of_birth'];;
       $userInfo->phone_number = $r['phone_number'];;
       $userInfo->address = $r['address'];
        $update = $userInfo->update();
       if($update){
           return redirect(url(session()->previousUrl()))->with('message','Profile information updated successfully');
       }
       return redirect(url(session()->previousUrl()))->with('erroMessage','Unable to update profile information');

   }

   public function updatePassword(Request $r){
       $this->validate($r,
           [
               'old_password'=>'required',
               'password'=>'required',
               'password_confirmation'=>'required|same:password'
           ]
       );
       $user = User::getUserById(auth()->user()->id);
       $old_password = Hash::make($r->old_password);
       $password = Hash::make($r->password);


       if(Hash::check($old_password, $user->password)){
           $user->password = $password;
           $user->update();
           return redirect(url(session()->previousUrl()))->with('message','Your password has been changed successfully');
       }else{
           return redirect(url(session()->previousUrl()))->with('errorMessage','Password incorrect. Try again');
       }
   }
}
