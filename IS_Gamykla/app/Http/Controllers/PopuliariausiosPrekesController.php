<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preke;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
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
            $start = Carbon::now(); 
            $finish = Carbon::create(1990, 1, 1);

            foreach($preke->sandeliuose as $sandelyje){
                foreach($sandelyje->uzsakymai as $uzsakymas){
                    $uzsakymoDetales = $uzsakymas->info;
                    if ($uzsakymoDetales->uzsakymo_statusas > Config::get('constants.UZASKYMAS_PRADETAS')){
                        $kiekis += $uzsakymas->kiekis;
                        if($uzsakymoDetales->created_at < $start){
                            $start = $uzsakymoDetales->created_at;
                        }
                        if($uzsakymoDetales->created_at > $finish){
                            $finish = $uzsakymoDetales->created_at;
                        }
                    }
                }
            }
            
            $preke->kiekis = $kiekis;
            $preke->nuo = $start;
            $preke->iki = $finish;
        }
        
        $prekes = $prekes->where('kiekis', '>', 0)->sortByDesc('kiekis');
        
        return view('populiariausios_prekes.show', ['prekes' => $prekes]);
    }

    public function search(Request $request)
    {
        $prekes = Preke::all();
        $start = $request->date_from;
        $finish = $request->date_to;

        foreach ($prekes as $preke){
            $kiekis = 0;
            
            foreach($preke->sandeliuose as $sandelyje){
                foreach($sandelyje->uzsakymai as $uzsakymas){
                    $uzsakymoDetales = $uzsakymas->info;
                    if($uzsakymoDetales->created_at >= $start && $uzsakymoDetales->created_at <= $finish && $uzsakymoDetales->uzsakymo_statusas > Config::get('constants.UZASKYMAS_PRADETAS')){
                        $kiekis += $uzsakymas->kiekis;
                    }
                }
            }
            
            $preke->kiekis = $kiekis;
            $preke->nuo = $start;
            $preke->iki = $finish;
        }
        
        $prekes = $prekes->where('kiekis', '>', 0)->sortByDesc('kiekis');
        
        return view('populiariausios_prekes.show', ['prekes' => $prekes]);
    }
}
