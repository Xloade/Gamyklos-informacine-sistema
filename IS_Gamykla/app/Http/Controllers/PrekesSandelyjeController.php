<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrekesSandelyjeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('prekes_sandelyje.index');
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
