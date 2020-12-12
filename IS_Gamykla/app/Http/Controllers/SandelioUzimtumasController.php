<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sandelis;
use Illuminate\Support\Facades\DB;

class SandelioUzimtumasController extends Controller
{
    public function __construct()
    {

    }

    public function show()
    {
        $sandeliai = Sandelis::all();        
        foreach($sandeliai as $sandelis){
            $uzimta = 0;
            $sandelyje = $sandelis->sandelyje;
            foreach ($sandelyje as $prekeSandelyje){
                $preke = $prekeSandelyje->preke;
                $uzimta += (($preke->aukstis / 100) *  ($preke->ilgis / 100) * ($preke->plotis / 100)) * $prekeSandelyje->kiekis;
            }
            $sandelis->uzpildyta = $uzimta / $sandelis->talpa;
        }

        return view('sandelio_uzimtumas.show', ['sandeliai' => $sandeliai]);
    }
}
