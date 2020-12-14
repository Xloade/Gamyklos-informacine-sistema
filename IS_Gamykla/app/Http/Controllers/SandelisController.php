<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sandelis;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use App\Models\Preke_sandelyje;
use App\Models\Preke;

use function Ramsey\Uuid\v1;

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
        $workers = User::where([
            ['userlevel', Config::get('constants.DARBUOTOJAS')],
            ['fk_gamykla', null]
            ])->get();
        return view('sandelis.edit', ['sandelis' => $sandelis, 'boss' => $boss, 'workers' => $workers]);
    }

    public function update(Request $request){
        $sandelis = Sandelis::where('sandelio_kodas', $request->id)->first();
        $boss = $sandelis->boss;
        if($boss != null){
            User::where('id', $boss->id)->update([
                'userlevel' => Config::get('constants.DARBUOTOJAS')
            ]);
        }
        $vadovas = $request->sandelis_boss == -1 ? null : $request->sandelis_boss;
        $sandelis->update([
            'salis' => $request->sandelis_salis,
            'miestas' => $request->sandelis_miestas,
            'gatve' => $request->sandelis_gatve,
            'talpa' => $request->sandelis_talpa,
            'fk_vadovasId' => $vadovas
        ]);
        if ($vadovas > 0){
            User::where('id', $vadovas)->update([
                'userlevel' => Config::get('constants.SANDELIO_VADOVAS')
            ]);
        }
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
        // $sandeliai = Preke_sandelyje::with('sandelis')->distinct('sandelio_kodas')->get();
        $sandeliai = Sandelis::all();
        $preke = Preke::all();
        return view('sandelis.uzsakyti', compact('sandeliai', 'preke'));
    }

    public function uzsakymasideti(Request $request){
        $prekeSandelyje = Preke_sandelyje::where([
            ['fk_sandelisId', $request->fk_sandelisId],
            ['fk_prekeId', $request->fk_prekeId]
            ])->first();
        if ($prekeSandelyje == null){
            Preke_sandelyje::create([
                'kiekis' => 0 + $request->preke_count,
                'fk_sandelisId' => $request->fk_sandelisId,
                'fk_prekeId' => $request->fk_prekeId
            ]);
        }
        else {
            $kiekis = $prekeSandelyje->kiekis;
            $prekeSandelyje->update([
                'kiekis' => $kiekis + $request->preke_count 
                ]);
        }
        
        return redirect()->route('sandelis.index');
    }

    public function search() {

        return view('sandelis.search');
    }

    public function process(){

        return view();
    }
}
