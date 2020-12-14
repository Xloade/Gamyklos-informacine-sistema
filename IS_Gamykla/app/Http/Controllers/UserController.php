<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gamykla;
use App\Http\Requests\UserValidateRequest;
use App\Http\Requests\UserPasswordValidateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Config;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editprofile()
    {
        $user = Auth::user();
        if($user->userlevel == Config::get('constants.DARBUOTOJAS')){
            $gamykla = Gamykla::where('kodas',$user->fk_gamykla)->first();
            return view('user.editprofile',compact('gamykla'));
        }
        return view('user.editprofile');
    }

    public function change_password(UserPasswordValidateRequest $request){
        $user=Auth::user();
        $user->update(['password' =>  Hash::make($request['password'])]);
        return redirect()->route('user.editprofile',$user->id)->with('message','Slaptažodis pakeistas');
    }
}
