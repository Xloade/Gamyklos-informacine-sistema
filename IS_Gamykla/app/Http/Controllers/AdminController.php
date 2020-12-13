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
            'password.required' => 'Įrašykite slaptažodį',
            'password.min' => 'Slaptažodis turi būti bent 8 simbolių',
            'password_confirmation.required' => 'Patvirtinkite slaptažodį',
            'password_confirmation.same' => 'Slaptažodžiai nevienodi',
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
            break;
            case Config::get('constants.DARBUOTOJAS'):
                $gamykla = Gamykla::where('kodas',$user->fk_gamykla)->first();
                $visosGamyklos = Gamykla::orderBy('pavadinimas')->get();
                return view('admin.edit',compact('user','gamykla','visosGamyklos')); 
            break;
            case Config::get('constants.SANDELIO_VADOVAS'):
                $sandeliai = Sandelis::where('fk_vadovasId',$user->id)->get();
                return view('admin.edit',compact('user', 'sandeliai')); 
            break;
            case Config::get('constants.GAMYKLOS_VADOVAS'):
                $gamykla = Gamykla::where('fk_userId',$user->id)->first();
                if(!empty($gamykla))
                    $gamyklosDarbuotojai = User::where('userlevel',Config::get('constants.DARBUOTOJAS'))->where('fk_gamykla',$gamykla->kodas)->orderBy('first_name')->get();
                else $gamyklosDarbuotojai = null;
                $visiVadovai = User::where('userlevel',Config::get('constants.GAMYKLOS_VADOVAS'))->orderBy('first_name')->get();
                return view('admin.edit',compact('user', 'gamykla','visiVadovai','gamyklosDarbuotojai'));
            break;
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

    public function change_worker_info(Request $request,User $user){
        $validator = Validator::make($request->all(), [
            'atlyginimas' => ['required','numeric', 'min:325'],
        ], [
            'atlyginimas.required' => 'įrašykite atlyginimą',
            'atlyginimas.numeric' => 'Atlyginimas turi būti skaičius',
            'atlyginimas.min' => 'Atlyginimas ne mažesnis nei 325',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //dd($request['atlyginimas']);
        $user->update([
            'atlyginimas' => $request['atlyginimas'],
            'fk_gamykla' => $request['darbuotojo_gamykla'],
        ]);
        return redirect()->route('admin.edit',$user->id)->with('message','Darbuotojo duomenys pakeisti');
    }
}
