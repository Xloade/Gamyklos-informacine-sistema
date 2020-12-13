<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gamykla;
use App\Models\Uzsakymas;
use App\Models\Sandelis;
use App\Http\Requests\UserValidateRequest;
use App\Http\Requests\UserPasswordValidateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Config;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::orderBy('userlevel')->get();
        $userlevel = -1;
        return view('admin.index',compact('users','userlevel'));
    }
    public function create(){
        return view('admin.create');
    }
    public function store(UserValidateRequest $request){
        // $userId = auth()->id();
        // $request['user_id'] = $userId;
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required','same:password'],
        ], [
            'password_confirmation.same' => 'passwords do not match',
        ],[
            'password.required' => 'Please enter password',
            'password.min' => 'Password has to be at least 8 characters long',
            'password_confirmation.required' => 'Please confirm password',
            'password_confirmation.same' => 'Passwords do not match',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //User::create($request->all());
        User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'userlevel' => $request['userlevel'],
        ]);
        return redirect()->route('admin.index')->with('message','User succesfully created');
    }
    public function edit(User $user)
    {
        $userlevel = $user->userlevel;
        switch($userlevel){
            case Config::get('constants.KLIENTAS'):
                $uzsakymai = Uzsakymas::where('fk_userId',$user->id)->get();
                return view('admin.edit',compact('user', 'uzsakymai')); 
            case Config::get('constants.DARBUOTOJAS'):
                $gamykla = Gamykla::where('kodas',$user->fk_gamyklaId)->get();
                return view('admin.edit',compact('user', 'gamykla')); 
            case Config::get('constants.SANDELIO_VADOVAS'):
                $sandeliai = Sandelis::where('fk_vadovasId',$user->id)->get();
                return view('admin.edit',compact('user', 'sandeliai')); 
            case Config::get('constants.GAMYKLOS_VADOVAS'):
                $gamyklos = Gamykla::where('fk_userId',$user->id)->get();
                return view('admin.edit',compact('user', 'gamyklos'));
            default:
                return view('admin.edit',compact('user'));
        }
       // return view('admin.edit',compact('user'));
    }
    public function update(UserValidateRequest $request, User $user)
    {
        $user->update(['userlevel' => $request->userlevel]);
        return redirect()->route('admin.index')->with('message','Vartotojo kategorija buvo redaguota');
    }
    public function destroy(User $user){
        $user->delete();
        return redirect()->route('admin.index')->with('message','User deleted');
    }

    public function change_category(Request $request){
        $userlevel = $request->get('userlevel');
        if($userlevel != -1){
            $users = User::where('userlevel', $userlevel)->orderBy('first_name')->get();
        } else $users = User::orderBy('userlevel')->get();
        //return $this->index();
        
        return view('admin.index',compact('users', 'userlevel'));
    }

    public function search(Request $request){
        $result = User::query();
        $userlevel = $request->get('userlevel');
        if($userlevel != -1){
            $result = $result->where('userlevel', $userlevel)->orderBy('first_name');
        } else $result = $result->orderBy('userlevel');
        
        $date = $request->get('date');
        $request->session()->flash('user_search_date', $date);
        $date = Carbon::createFromFormat('Y-m-d', $date)->addDays(1);
        $result = $result->where('created_at','<=', $date);

        $email = $request->get('email');
        if (!empty($email)) {
            $result = $result->where('email', 'like', '%'.$email.'%');
            $request->session()->flash('user_search_email', $email);
        }

        $users = $result->get();
        return view('admin.index',compact('users', 'userlevel'));
    }

    public function change_password(UserPasswordValidateRequest $request, User $user){
        $user->update(['password' =>  Hash::make($request['password'])]);
        return redirect()->route('admin.edit',$user->id)->with('message','Slaptažodis pakeistas');
    }
}
