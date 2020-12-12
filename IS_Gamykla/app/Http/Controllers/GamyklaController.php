<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gamykla;

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
        return view('gamykla.edit', ['gamykla' => $gamykla]);
    }

    public function update(Request $request){
        //$vadovas = $request->gamykla_boss == -1 ? null : $request->gamykla_boss;
        $vadovas = null;
        Gamykla::where('kodas', $request->id)->update(['pavadinimas' => $request->gamykla_name, 'adresas' => $request->gamykla_adress, 'fk_userId' => $vadovas]);
        return redirect()->route('gamyklos.index');
    }

    public function create(){
        return view('gamykla.create');
    }

    public function store(Request $request){
        //$vadovas = $request->gamykla_boss == -1 ? null : $request->gamykla_boss;
        $vadovas = null;
        Gamykla::create(['pavadinimas' => $request->gamykla_name, 'adresas' => $request->gamykla_adress, 'fk_userId' => $vadovas]);
        return redirect()->route('gamyklos.index');
    }

    public function delete(Request $request){
        Gamykla::where('kodas', $request->id)->delete();
        return redirect()->route('gamyklos.index');
    }
}
