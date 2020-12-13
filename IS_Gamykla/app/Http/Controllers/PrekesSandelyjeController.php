<?php

namespace App\Http\Controllers;

use App\Models\Preke_sandelyje as ModelsPreke_sandelyje;
use Illuminate\Http\Request;
use App\Models\Preke_sandelyje;
use App\Models\Preke;
use App\Models\sandelis;
use Illuminate\Support\Facades\Redirect;

class PrekesSandelyjeController extends Controller
{
    public function __construct()
    {

    }

    public function index(\App\Models\sandelis $id)
    {
        $allPrekes = preke_sandelyje::where(['fk_sandelisid' => $id->sandelio_kodas])
                    ->with('preke')
                    ->get();

        return view('prekes_sandelyje.index', compact('allPrekes'));
    }

    public function edit($id){
        $preke = preke_sandelyje::where('id',$id)
        ->with('preke')
        ->first();

        return view('prekes_sandelyje.edit', compact('preke'));
    }

    public function update(Request $request){

        //  $back = $request->fk_sandelisId;
        Preke_sandelyje::where('id', $request->id)->update([
            'kiekis' => $request->preke_count
            ]);
        // $prekesid = preke_sandelyje::where('fk')
        Preke::where('prekes_kodas', $request->fk_prekeId)->update([
            'pavadinimas' => $request->preke_name,
            'kaina' => $request->preke_cost,
            'svoris' => $request->preke_weight,
            'aukstis' => $request->preke_height,
            'ilgis' => $request->preke_length,
            'plotis' => $request->preke_width
        ]);
        // die($request->fk_sandelisId);
        // die($request->id);
        return Redirect()->route('prekes_sandelyje.index', ['id' => $request->fk_sandelisId]);
    }

    public function create(){
        return view('prekes_sandelyje.create');
    }

    public function store(){
        return redirect()->route('prekes_sandelyje.index');
    }

    public function delete(Request $request){
        Preke_sandelyje::where('id', $request->id)->delete();

        return Redirect()->route('prekes_sandelyje.index', ['id' => $request->fk_sandelisId]);
    }
}
