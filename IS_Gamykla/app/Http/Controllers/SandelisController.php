<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sandelis;
use App\Models\User;

class SandelisController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $sandeliai = Sandelis::all();

        return view('sandelis.index', ['sandeliai' => $sandeliai]);
    }

    public function edit($id){
        $sandelis = Sandelis::where('sandelio_kodas', $id)->first();
        $boss = $sandelis->boss;
        $workers = User::where('userlevel', 3)->get();
        return view('sandelis.edit', ['sandelis' => $sandelis, 'boss' => $boss, 'workers' => $workers]);
    }

    public function update(Request $request){
        $vadovas = $request->gsandelis_boss == -1 ? null : $request->sandelis_boss;
        Sandelis::where('sandelio_kodas', $request->id)->update([
            'salis' => $request->sandelis_salis,
            'miestas' => $request->sandelis_miestas,
            'gatve' => $request->sandelis_gatve,
            'talpa' => $request->sandelis_talpa,
            'fk_vadovasId' => $vadovas
        ]);
        return redirect()->route('sandelis.index');
    }

    public function create(){
        return view('sandelis.create');
    }

    public function store(Request $request){
        Sandelis::create([
            'salis' => $request->sandelis_salis,
            'miestas' => $request->sandelis_miestas,
            'gatve' => $request->sandelis_gatve,
            'talpa' => $request->sandelis_talpa,
            'fk_vadovasId' => null
        ]);
        return redirect()->route('sandelis.index');
    }

    public function delete(Request $request){
        Sandelis::where('sandelio_kodas', $request->id)->delete();
        return redirect()->route('sandelis.index');
    }
}
