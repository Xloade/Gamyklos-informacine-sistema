<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sandelis;
use App\Models\User;
use App\Models\Preke_sandelyje;
use App\Models\Preke;

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

    public function add(){
        return view('sandelis.add');
    }

    public function ideti(Request $request){
        Preke::create([
            'pavadinimas' => $request->preke_name,
            'kaina' => $request->preke_cost,
            'svoris' => $request->preke_weight,
            'aukstis' => $request->preke_height,
            'ilgis' =>  $request->preke_length,
            'plotis' =>  $request->preke_width,
        ]);
        return redirect()->route('sandelis.index');
    }

    public function uzsakyti(){
        $sandeliai = Preke_sandelyje::with('sandelis')->get();
        $preke = Preke::all();
        return view('sandelis.uzsakyti', compact('sandeliai', 'preke'));
    }

    public function uzsakymasideti(Request $request){
        Preke_sandelyje::create([
            'kiekis' => $request->preke_count,
            'fk_sandelisId' => $request->fk_sandelisId,
            'fk_prekeId' => $request->fk_prekeId
        ]);
        return redirect()->route('sandelis.index');
    }
}
