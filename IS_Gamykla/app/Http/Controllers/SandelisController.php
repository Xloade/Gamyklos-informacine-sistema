<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Sandelis;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use App\Models\Preke_sandelyje;
use App\Models\Preke;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FRequest;


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

    public function search(Request $request) {
        $validator = Validator::make($request->all(), [
            'kaina-max' => ['numeric','min:0','nullable'],
            'kaina-min' => ['numeric','min:0','nullable'],
            'svoris-max' => ['numeric','min:0','nullable'],
            'kaina-min' => ['numeric','min:0','nullable'],
            'turis-max' => ['numeric','min:0','nullable'],
            'kaina-min' => ['numeric','min:0','nullable'],
            'plotis-max' => ['numeric','min:0','nullable'],
            'kaina-min' => ['numeric','min:0','nullable'],
            'ilgis-max' => ['numeric','min:0','nullable'],
            'kaina-min' => ['numeric','min:0','nullable'],
            'aukstis-max' => ['numeric','min:0','nullable'],
            'kaina-min' => ['numeric','min:0','nullable'],
            'sandelys' => ['integer','min:0','nullable'],
        ], [
            'min' => 'Įveskite teigiama numerį',
            'numeric' => 'Įveskite kiekį',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $query = DB::table('preke')
            ->selectRaw('preke_sandelyje.kiekis as kiekis, preke.prekes_kodas as prekes_kodas, preke.pavadinimas as pavadinimas, preke.kaina as kaina, preke.svoris as svoris, preke.plotis as plotis, preke.ilgis as ilgis, preke.aukstis as aukstis');
        if($request->filled('pavadinimas')){
            $query = $query->where('pavadinimas', 'like', '%'.$request['pavadinimas'].'%');
        }
        if($request->filled('kaina-max')){
            $query = $query->where('kaina', '<=', $request['kaina-max']);
        }
        if($request->filled('kaina-min')){
            $query = $query->where('kaina', '>=', $request['kaina-min']);
        }
        if($request->filled('svoris-max')){
            $query = $query->where('svoris', '<=', $request['svoris-max']);
        }
        if($request->filled('svoris-min')){
            $query = $query->where('svoris', '>=', $request['svoris-max']);
        }
        if($request->filled('turis-max')){
            $query = $query->where('plotis*ilgis*aukstis', '<=', $request['turis-max']);
        }
        if($request->filled('turis-min')){
            $query = $query->where('plotis*ilgis*aukstis', '>=', $request['turis-min']);
        }
        if($request->filled('plotis-max')){
            $query = $query->where('plotis', '<=', $request['plotis-max']);
        }
        if($request->filled('plotis-min')){
            $query = $query->where('plotis', '>=', $request['plotis-min']);
        }
        if($request->filled('ilgis-max')){
            $query = $query->where('ilgis', '<=', $request['ilgis-max']);
        }
        if($request->filled('ilgis-min')){
            $query = $query->where('ilgis', '>=', $request['ilgis-min']);
        }
        if($request->filled('aukstis-max')){
            $query = $query->where('aukstis', '<=', $request['aukstis-max']);
        }
        if($request->filled('aukstis-min')){
            $query = $query->where('aukstis', '>=', $request['aukstis-min']);
        }
        if($request->filled('sandelys')){
            if($request['sandelys'] == 0){
                $query = $query->crossJoin('preke_sandelyje', 'preke_sandelyje.fk_prekeId', '=', 'preke.prekes_kodas');

            }
            else{
               // $query = $query->join('preke_sandelyje', 'preke_sandelyje.fk_prekeId', '=', 'preke.prekes_kodas');
                $query = $query->where('preke_sandelyje.fk_sandelisId', '=', $request['sandelys']);
            }
           // $query = $query->where('preke_sandelyje.kiekis', '>', '0');
        }

        $query = $query->join('preke_sandelyje', 'preke_sandelyje.fk_prekeId', '=', 'preke.prekes_kodas');
     //   $query = $query->join('sandeliai', 'sandeliai.', '=', 'preke.prekes_kodas');

        $prekes = $query->distinct('preke.prekes_kodas')->get();
        // $prekes = $query->get();
        $sandeliai =  DB::table('sandeliai')->selectRaw('sandelio_kodas as id, salis, miestas, gatve')->get();
        //$kiekis = preke_sandelyje::where('fk_prekeId', 'preke.prekes_kodas')->value('kiekis');

        FRequest::flash();
        return view('sandelis.search', compact('prekes', 'sandeliai'));
    }
}
