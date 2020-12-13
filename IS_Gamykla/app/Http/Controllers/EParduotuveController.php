<?php

namespace App\Http\Controllers;

use App\Models\Uzsakymas;
use App\Models\Uzsakymas_preke;
use App\Models\Preke;
use App\Models\Preke_sandelyje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\UserValidateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EParduotuveController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('eparduotuve.index');
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
            return back()->with('error','Krepšelyje nera tokios prekes');
        }
    }
}
