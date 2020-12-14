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
            ->join('sandeliai', 'preke_sandelyje.fk_sandelisId', '=', 'sandeliai.sandelio_kodas')
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
    public function order()
    {
        $orderNotEmpty = Uzsakymas::where("fk_userId", "=", Auth::id())
            ->crossJoin('uzsakymas_preke', 'uzsakymas.id', '=', 'uzsakymas_preke.fk_uzsakymasId')
            ->where("uzsakymo_statusas", "=", Config::get('constants.UZASKYMAS_PRADETAS'))
            ->doesntExist();
        if($orderNotEmpty){
            return redirect()->route('eparduotuve.cart')->withErrors(['uzsakymas'=>'Nieko neturite krepšelyje']);
        }
        else{
            $korteles = DB::table('banko_korteles')
                ->select("korteles_numeris")
                ->where("fk_userId", "=", Auth::id())
                ->get();
            return view('eparduotuve.order', ['korteles'=>$korteles]);
        }   
    }
    public function completeOrder(Request $request)
    {
        if($request->filled('isaugotaKortele')){
            $validator = Validator::make($request->all(), [
                'isaugotaKortele' => ['exists:banko_korteles,korteles_numeris'],
            ], [
                
            ]);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $kortele_id = $request['isaugotaKortele'];
        }else{
            $validator = Validator::make($request->all(), [
                'kortele_vardas' => ['required','max:30'],
                'kortele_pavarde' => ['required','max:30'],
                'kortele_nr' => ['required','digits:16','min:0'],
                'kortele_cvv' => ['required','digits:3','min:0'],
                'kortele_galiojimoMenuo' => ['required','integer','min:0','max:12'],
                'kortele_galiojimoMetai' => ['required','integer','min:0','max:99'],
                'kortele_salis' => ['required','max:30'],
                'kortele_miestas' => ['required','max:30'],
                'kortele_gatve' => ['required','max:30'],
                'kortele_butoNr' => ['max:30'],

            ], [
                
            ]);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $kortele_id = DB::table('banko_korteles')->insertGetId([
                ['korteles_numeris' => $request['kortele_nr'],
                'vardas' => $request['kortele_vardas'],
                'pavarde' => $request['kortele_pavarde'],
                'cvv' => $request['kortele_cvv'],
                'galiojimo_pabaigos_menuo' => $request['kortele_galiojimoMenuo'],
                'galiojimo_pabaigos_metai' => $request['kortele_galiojimoMetai'],
                'gatve' => $request['kortele_gatve'],
                'buto_nr' => $request['kortele_butoNr'],
                'miestas' => $request['kortele_miestas'],
                'salis' => $request['kortele_salis'],
                'fk_userId' => Auth::id()]
            ]);
        }
        if($request['isaugotasAdresas'] == false){
            $validator = Validator::make($request->all(), [
                'salis' => ['required','max:30'],
                'miestas' => ['required','max:30'],
                'gatve' => ['required','max:30'],
                'butoNr' => ['integer','digits_between:0,11'],
                'duruKodas' => ['integer','digits_between:0,11'],
            ], [
                
            ]);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            if($request['atsimintiAdresa'] == true){
                DB::table('users')
                ->where('id', Auth::id())
                ->update([
                    'salis' => $request['salis'],
                    'miestas' => $request['miestas'],
                    'gatve' => $request['gatve'],
                    'buto_nr' => $request['butoNr'],
                    'duru_kodas' => $request['duruKodas'],
                ]);
            }
            DB::table('uzsakymas')
                ->where('fk_userId', Auth::id())
                ->where("uzsakymo_statusas", Config::get('constants.UZASKYMAS_PRADETAS'))
                ->update([
                    'salis' => $request['salis'],
                    'miestas' => $request['miestas'],
                    'gatve' => $request['gatve'],
                    'buto_nr' => $request['butoNr'],
                    'duru_kodas' => $request['duruKodas'],
                    'uzsakymo_statusas' => Config::get('constants.UZASKYMAS_PATVIRTINTAS'),
                    'fk_bankoKorteleId' => $kortele_id,
                ]);
        }
        $userInfo = DB::table('users')
            ->where('id', Auth::id())
            ->first();
        DB::table('uzsakymas')
                ->where('fk_userId', Auth::id())
                ->where("uzsakymo_statusas", Config::get('constants.UZASKYMAS_PRADETAS'))
                ->update([
                    'salis' => $userInfo->salis,
                    'miestas' => $userInfo->miestas,
                    'gatve' => $userInfo->gatve,
                    'buto_nr' => isset($userInfo->butoNr)?$userInfo->butoNr:null,
                    'duru_kodas' => isset($userInfo->duruKodas)?$userInfo->duruKodas:null,
                    'uzsakymo_statusas' => Config::get('constants.UZASKYMAS_PATVIRTINTAS'),
                    'fk_bankoKorteleId' => $kortele_id,
                ]);
        return redirect()->route('eparduotuve.cart')->with('message','Užsakymas įvikdytas');
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
            return back()->withErrors($validator)->withInput();
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

        Preke_sandelyje::find($request['id'])
            ->update([
                'kiekis' => $preke_sandelyje->kiekis - $request['kiekis']
            ]);

        return redirect()->route('eparduotuve.cart')->with('message','Krepšelis sekmingai atnaujintas');
    }
    public function removeFromCart($id){
        $uzsakymas = Uzsakymas_preke::find($id);
        echo $uzsakymas;
        $sandelyje = Preke_sandelyje::find($uzsakymas->fk_prekeSandelyjeId);
        $naujas_kiekis = $sandelyje->kiekis + $uzsakymas->kiekis;
        $result = DB::table('uzsakymas_preke')
        ->join('uzsakymas', 'uzsakymas_preke.fk_uzsakymasId', '=', 'uzsakymas.id')
            ->where('uzsakymas_preke.id' , '=', $id)
            ->where("uzsakymas.fk_userId", "=", Auth::id())
            ->delete();
        Preke_sandelyje::find($uzsakymas->fk_prekeSandelyjeId)
            ->update([
                'kiekis' => $naujas_kiekis 
            ]);
        if($result){
            return back()->with('message','Krepšelis sekmingai atnaujintas');
        }
        else{
            return back()->withErrors(['id' => 'Krepšelyje nera tokios prekes']);
        }
    }
}
