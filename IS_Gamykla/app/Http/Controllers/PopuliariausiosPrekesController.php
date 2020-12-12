<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preke;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PopuliariausiosPrekesController extends Controller
{
    public function __construct()
    {

    }

    public function show()
    {
        $prekes = Preke::all();
        foreach ($prekes as $preke){
            $kiekis = 0;
            $start = Carbon::now(); // currentTime/ taip pat galima nustatyti
            $finish = Carbon::create(1990, 1, 1, 0, 0, 0);; // startOfTime/ taip pat galima nustatyti

            // foreach($preke->sandeliuose as $sandelyje){
            //     foreach($sandelyje->uzsakymai as $uzsakymas){
            //         $kiekis += $uzsakymas->kiekis;
            //         $uzsakymoDetales = $uzsakymas->info;
            //         if($uzsakymoDetales->created_at < $start){
            //             $start = $uzsakymoDetales->created_at;
            //         }
            //         if($uzsakymoDetales->created_at > $finish){
            //             $finish = $uzsakymoDetales->created_at;
            //         }
            //     }
            // }
            $start = Carbon::create(1990, 1, 1); //istrint
            $finish = Carbon::now(); //istrint
            
            $preke->kiekis = $kiekis;
            $preke->nuo = $start;
            $preke->iki = $finish;
        }
        
        $prekes = $prekes->where('kiekis', '>=', 0)->sortBy([
            'kiekis', 'desc'
        ]);
        
        return view('populiariausios_prekes.show', ['prekes' => $prekes]);
    }
}
