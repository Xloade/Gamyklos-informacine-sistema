<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gamykla;
use Config;
use App\Models\User;

class GamyklaController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $gamyklos = Gamykla::all();
        return view('gamykla.index', ['gamyklos' => $gamyklos]);
    }

    public function edit($id){
        $gamykla = Gamykla::where('kodas',$id)->first();
        $boss = $gamykla->boss;
        return view('gamykla.edit', ['gamykla' => $gamykla, 'boss' => $boss]);
    }

    public function update(Request $request){
        $vadovas = $request->gamykla_boss == -1 ? null : $request->gamykla_boss;
        $gamykla = Gamykla::where('kodas', $request->id)->first();
        if($gamykla->fk_userId != null){
            if($gamykla->fk_userId != $vadovas){
                User::where('id', $gamykla->fk_userId)->update(['userlevel' => Config::get('constants.DARBUOTOJAS')]);
            }
            if ($vadovas != null){
                User::where('id', $vadovas)->update(['userlevel' => Config::get('constants.GAMYKLOS_VADOVAS')]);
            }
        }
        Gamykla::where('kodas', $request->id)->update(['pavadinimas' => $request->gamykla_name, 'adresas' => $request->gamykla_adress, 'fk_userId' => $vadovas]);
        return redirect()->route('gamyklos.index');
    }

    public function create(){
        return view('gamykla.create');
    }

    public function store(Request $request){
        Gamykla::create(['pavadinimas' => $request->gamykla_name, 'adresas' => $request->gamykla_adress, 'fk_userId' => null]);
        return redirect()->route('gamyklos.index');
    }

    public function delete(Request $request){
        Gamykla::where('kodas', $request->id)->delete();
        return redirect()->route('gamyklos.index');
    }
}
