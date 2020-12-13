<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gamykla;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TvarkarascioStatistikaController extends Controller
{
    public function __construct()
    {

    }

    public function show()
    {
        $gamyklos = Gamykla::all();
        foreach ($gamyklos as $gamykla){
            $valandos = 0;
            $start = Carbon::now();
            $finish = Carbon::create(1990, 1, 1);

            foreach($gamykla->worker as $darbuotojas){
                foreach($darbuotojas->tvarkarasciai as $tvarkarastis){
                    $valandos += $tvarkarastis->darbas_iki - $tvarkarastis->darbas_nuo;
                    if($tvarkarastis->data < $start){
                        $start = $tvarkarastis->data;
                    }
                    if($tvarkarastis->data > $finish){
                        $finish = $tvarkarastis->data;
                    }
                }
            }
            
            $gamykla->valandos = $valandos;
            $gamykla->nuo = $start;
            $gamykla->iki = $finish;
        }
        
        $gamyklos = $gamyklos->where('valandos', '>', 0)->sortBy([
            'valanados', 'desc'
        ]);
        return view('tvarkarascio_statistika.show', ['gamyklos' => $gamyklos]);
    }

    public function search(Request $request)
    {
        $gamyklos = Gamykla::all();
        $start = $request->date_from;
        $finish = $request->date_to;
        foreach ($gamyklos as $gamykla){
            $valandos = 0;

            foreach($gamykla->worker as $darbuotojas){
                foreach($darbuotojas->tvarkarasciai as $tvarkarastis){
                    if($tvarkarastis->data >= $start && $tvarkarastis->data <= $finish){
                        $valandos += $tvarkarastis->darbas_iki - $tvarkarastis->darbas_nuo;
                    }
                }
            }
            
            $gamykla->valandos = $valandos;
            $gamykla->nuo = $start;
            $gamykla->iki = $finish;
        }
        
        $gamyklos = $gamyklos->where('valandos', '>', 0)->sortBy([
            'valanados', 'desc'
        ]);
        return view('tvarkarascio_statistika.show', ['gamyklos' => $gamyklos]);
    }
}
