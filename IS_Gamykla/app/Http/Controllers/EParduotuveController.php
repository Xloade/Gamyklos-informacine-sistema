<?php

namespace App\Http\Controllers;

use App\Models\Uzsakymas;
use App\Models\Uzsakymas_preke;
use App\Models\Preke;
use App\Models\Preke_sandelyje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EParduotuveController extends Controller
{
    public function __construct()
    {

    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kaina-max' => ['numeric','min:0','nullable'],
            'kaina-min' => ['numeric','min:0','nullable'],
            'svoris-max' => ['numeric','min:0','nullable'],
            'svoris-min' => ['numeric','min:0','nullable'],
            'turis-max' => ['numeric','min:0','nullable'],
            'turis-min' => ['numeric','min:0','nullable'],
            'plotis-max' => ['numeric','min:0','nullable'],
            'plotis-min' => ['numeric','min:0','nullable'],
            'ilgis-max' => ['numeric','min:0','nullable'],
            'ilgis-min' => ['numeric','min:0','nullable'],
            'aukstis-max' => ['numeric','min:0','nullable'],
            'aukstis-min' => ['numeric','min:0','nullable'],
            'sandelys' => ['integer','min:0','nullable'],
        ], [
            'kaina-min.min' => 'Į kainą min įveskite teigiama numerį',
            'kaina-min.numeric' => 'Į kainą min įveskite numerį',
            'kaina-max.min' => 'Į kainą max įveskite teigiama numerį',
            'kaina-max.numeric' => 'Į kainą max įveskite numerį',
            'svoris-min.min' => 'Į svorį min įveskite teigiama numerį',
            'svoris-min.numeric' => 'Į svorį min įveskite numerį',
            'svoris-max.min' => 'Į svorį max įveskite teigiama numerį',
            'svoris-max.numeric' => 'Į svorį max įveskite numerį',
            'turis-min.min' => 'Į turį min įveskite teigiama numerį',
            'turis-min.numeric' => 'Į turį min įveskite numerį',
            'turis-max.min' => 'Į turį max įveskite teigiama numerį',
            'turis-max.numeric' => 'Į turį max įveskite numerį',
            'plotis-min.min' => 'Į plotį min įveskite teigiama numerį',
            'plotis-min.numeric' => 'Į plotį min įveskite numerį',
            'plotis-max.min' => 'Į plotį max įveskite teigiama numerį',
            'plotis-max.numeric' => 'Į plotį max įveskite numerį',
            'ilgis-min.min' => 'Į ilgį min įveskite teigiama numerį',
            'ilgis-min.numeric' => 'Į ilgį min įveskite numerį',
            'ilgis-max.min' => 'Į ilgį max įveskite teigiama numerį',
            'ilgis-max.numeric' => 'Į ilgį max įveskite numerį',
            'aukstis-min.min' => 'Į aukstį min įveskite teigiama numerį',
            'aukstis-min.numeric' => 'Į aukstį min įveskite numerį',
            'aukstis-max.min' => 'Į aukstį max įveskite teigiama numerį',
            'aukstis-max.numeric' => 'Į aukstį max įveskite numerį',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $query = DB::table('preke')
            ->selectRaw('preke.prekes_kodas as prekes_kodas, preke.pavadinimas as pavadinimas, preke.kaina as kaina, preke.svoris as svoris, preke.plotis as plotis, preke.ilgis as ilgis, preke.aukstis as aukstis');
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
                echo 'hahah';
            }
            else{
                $query = $query->join('preke_sandelyje', 'preke_sandelyje.fk_prekeId', '=', 'preke.prekes_kodas');
                $query = $query->where('preke_sandelyje.fk_sandelisId', '=', $request['sandelys']);
            }
            $query = $query->where('preke_sandelyje.kiekis', '>', '0');
        }
        $prekes = $query->distinct('preke.prekes_kodas')->get();
        // $prekes = $query->get();
        $sandeliai =  DB::table('sandeliai')->selectRaw('sandelio_kodas as id, salis, miestas, gatve')->get();
        FRequest::flash();
        return view('eparduotuve.search', ['prekes' => $prekes, 'sandeliai' => $sandeliai]);
    }

    public function cart()
    {
        $prekes = DB::table('preke')
            ->selectRaw('uzsakymas_preke.id as id, preke_sandelyje.fk_prekeId as prekeId, uzsakymas_preke.kiekis as kiekis, preke.pavadinimas as pavadinimas, preke.kaina * uzsakymas_preke.kiekis as kaina, sandeliai.salis as salis, sandeliai.miestas as miestas, sandeliai.gatve as gatve')
            ->join('preke_sandelyje', 'preke_sandelyje.fk_prekeId', '=', 'preke.prekes_kodas')
            ->join('uzsakymas_preke', 'uzsakymas_preke.fk_prekeSandelyjeId', '=', 'preke_sandelyje.id')
            ->join('sandeliai', 'uzsakymas_preke.fk_prekeSandelyjeId', '=', 'sandeliai.sandelio_kodas')
            ->join('uzsakymas', 'uzsakymas_preke.fk_uzsakymasId', '=', 'uzsakymas.id')
            ->where("uzsakymas.fk_userId", "=", Auth::id())
            ->where("uzsakymo_statusas", "=", Config::get('constants.UZASKYMAS_PRADETAS'))
            ->get();
        $isViso = DB::table('preke')
        ->selectRaw('sum(preke.kaina * uzsakymas_preke.kiekis) as isViso')
        ->join('preke_sandelyje', 'preke_sandelyje.fk_prekeId', '=', 'preke.prekes_kodas')
        ->join('uzsakymas_preke', 'uzsakymas_preke.fk_prekeSandelyjeId', '=', 'preke_sandelyje.id')
        ->join('uzsakymas', 'uzsakymas_preke.fk_uzsakymasId', '=', 'uzsakymas.id')
        ->where("uzsakymas.fk_userId", "=", Auth::id())
        ->where("uzsakymo_statusas", "=", Config::get('constants.UZASKYMAS_PRADETAS'))
        ->get();
        // echo Auth::id();
        return view('eparduotuve.cart', ['prekes' => $prekes, 'isViso' => $isViso]);
    }
    public function complete()
    {
        return view('eparduotuve.complete');
    }
    public function show($id)
    {
        $preke = Preke::where('prekes_kodas',$id)->first();
        $sandeliai = DB::table('preke_sandelyje')
            ->select('preke_sandelyje.id as id','sandeliai.salis as salis', 'sandeliai.miestas as miestas', 'sandeliai.gatve as gatve')
            ->join('sandeliai', 'preke_sandelyje.fk_sandelisId', '=', 'sandeliai.sandelio_kodas')
            ->where('preke_sandelyje.fk_prekeId',$id)
            ->get();
        return view('eparduotuve.show', ['preke' => $preke, 'sandeliai' => $sandeliai]);
    }
    public function addToCart(Request $request){
        $preke_sandelyje = Preke_sandelyje::find($request['id']);
        if(isset($preke_sandelyje)){
            $max = $preke_sandelyje->kiekis;
        }
        else{
            $max = 0;
        }
        $validator = Validator::make($request->all(), [
            'kiekis' => ['required', 'integer', 'max:'.$max],
            'id' => ['required', 'exists:preke_sandelyje,id'],
        ], [
            'kiekis.required' => 'Įveskite kiekį',
            'kiekis.integer' => 'Įveskite numerį',
            'kiekis.max' => 'Įveskite mažesnį kiekį',
            'id.required' => 'Pasirinkite sandelį',
            'id.exists' => 'Prekes šiame sandalyje nera'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(Uzsakymas::where("fk_userId", "=", Auth::id())->where("uzsakymo_statusas", "=", Config::get('constants.UZASKYMAS_PRADETAS'))->doesntExist()){
            Uzsakymas::create(['fk_userId' => Auth::id(), 'uzsakymo_statusas' => Config::get('constants.UZASKYMAS_PRADETAS')]);
        }
        $uzsakymas = Uzsakymas::where("fk_userId", "=", Auth::id())
            ->where("uzsakymo_statusas", "=", Config::get('constants.UZASKYMAS_PRADETAS'))
            ->first();
        Uzsakymas_preke::create([
            'kiekis' => $request['kiekis'],
            'fk_uzsakymasId' => $uzsakymas->id,
            'fk_prekeSandelyjeId' => $request['id'],
        ]);
        return back()->with('message','Krepšelis sekmingai atnaujintas');
    }
    public function removeFromCart($id){
        $result = DB::table('uzsakymas_preke')
        ->join('uzsakymas', 'uzsakymas_preke.fk_uzsakymasId', '=', 'uzsakymas.id')
        ->where('uzsakymas_preke.id' , '=', $id)
        ->where("uzsakymas.fk_userId", "=", Auth::id())
        ->delete();
        if($result){
            return back()->with('message','Krepšelis sekmingai atnaujintas');
        }
        else{
            return back()->withErrors(['id' => 'Krepšelyje nera tokios prekes']);
        }
    }
}
