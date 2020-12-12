<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserValidateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {

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
        return view('admin.edit',compact('user'));
    }
    public function update(UserValidateRequest $request, User $user)
    {
        $user->update(['userlevel' => $request->userlevel]);
        return redirect()->route('admin.index')->with('message','User has been updated');
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
}
