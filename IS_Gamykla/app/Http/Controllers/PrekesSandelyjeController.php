<?php

namespace App\Http\Controllers;

use App\Models\Preke_sandelyje as ModelsPreke_sandelyje;
use Illuminate\Http\Request;
use App\Models\Preke_sandelyje;
use App\Models\Preke;
class PrekesSandelyjeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $allPrekes = Preke_sandelyje::with('preke')->get();
        return view('prekes_sandelyje.index', compact('allPrekes'));
    }

    public function edit($id){
        return view('prekes_sandelyje.edit');
    }

    public function update($id){
        return redirect()->route('prekes_sandelyje.index');
    }

    public function create(){
        return view('prekes_sandelyje.create');
    }

    public function store(){
        return redirect()->route('prekes_sandelyje.index');
    }

    public function delete(){
        return redirect()->route('prekes_sandelyje.index');
    }
}
