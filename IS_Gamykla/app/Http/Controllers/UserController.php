<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserValidateRequest;
use App\Http\Requests\UserPasswordValidateRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editprofile()
    {
        return view('user.editprofile');
    }

    public function change_password(UserPasswordValidateRequest $request){
        $user=Auth::user();
        $user->update(['password' =>  Hash::make($request['password'])]);
        return redirect()->route('user.editprofile',$user->id)->with('message','Slaptažodis pakeistas');
    }
}
