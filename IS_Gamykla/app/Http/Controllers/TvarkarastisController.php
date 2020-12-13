<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tvarkarastis;
use App\Models\Gamykla;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TvarkarastisController extends Controller
{
    public function __construct()
    {

    }
    public function index()
    {   
        $user = Auth::user();
        $tvarkarasciai = null;
        if($user->userlevel == 7){
            $tvarkarasciai = $user->tvarkarasciaiBoss();
        }
        else if($user->userlevel == 3){
            $tvarkarasciai = $user->tvarkarasciai();
        }
        else if ($user->userlevel > 7){
            $tvarkarasciai = Tvarkarastis::all();
        }

        $gamyklos = null;
        if($user->userlevel == 7){
            $gamyklos = $user->gamyklaBoss();
        }
        else if ($user->userlevel > 7){
            $gamyklos = Gamykla::all();
        }
        return view('tvarkarastis.index', ['tvarkarasciai' => $tvarkarasciai, 'gamyklos' => $gamyklos]);
    }

    public function edit($id){
        $tvarkarastis = Tvarkarastis::where('id', $id)->first();
        return view('tvarkarastis.edit', ['tvarkarastis' => $tvarkarastis]);
    }

    public function update(Request $request){
        Tvarkarastis::where('id', $request->id)->update(['darbas_nuo' => $request->hoursFrom, 'darbas_iki' => $request->hoursTo]);
        return redirect()->route('tvarkarasciai.index');
    }

    public function create(Request $request){
        $gamykla = Gamykla::where('kodas', $request->gamykla)->first();
        return view('tvarkarastis.create', ['gamykla' => $gamykla]);
    }

    public function store(Request $request){
        foreach ($request->worker as $worker){
            Tvarkarastis::create(['data' => $request->date, 'darbas_nuo' => $worker['hoursFrom'],
            'darbas_iki' => $worker['hoursTo'], 'fk_darbuotojasId' => $worker['name'], 'fk_vadovasId' => $request->boss]);
        }
        return redirect()->route('tvarkarasciai.index');
    }

    public function delete(Request $request){
        Tvarkarastis::where('id', $request->id)->delete();
        return redirect()->route('tvarkarasciai.index');
    }

    public function search(Request $request){
        $user = Auth::user();
        $tvarkarasciai = null;
        if($user->userlevel == 7){
            $tvarkarasciai = $user->tvarkarasciaiBoss()->where('data', $request->date);
        }
        else if($user->userlevel == 3){
            $tvarkarasciai = $user->tvarkarasciai()->where('data', $request->date);
        }
        else if ($user->userlevel > 7){
            $tvarkarasciai = Tvarkarastis::all()->where('data', $request->date);
        }
        //$tvarkarasciai = Tvarkarastis::where('data', $request->date);

        $gamyklos = null;
        if($user->userlevel == 7){
            $gamyklos = $user->gamyklaBoss();
        }
        else if ($user->userlevel > 7){
            $gamyklos = Gamykla::all();
        }

        return view('tvarkarastis.index', ['tvarkarasciai' => $tvarkarasciai, 'gamyklos' => $gamyklos]);
    }

    public function show($id){
        $tvarkarastis = Tvarkarastis::where('id', $id)->first();
        return view('tvarkarastis.show', ['tvarkarastis' => $tvarkarastis]);
    }
}
