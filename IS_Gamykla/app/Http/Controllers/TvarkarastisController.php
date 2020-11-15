<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TvarkarastisController extends Controller
{
    public function __construct()
    {

    }
    public function index()
    {
        return view('tvarkarastis.index');
    }

    public function edit($id){
        return view('tvarkarastis.edit');
    }

    public function update($id){
        return redirect()->route('tvarkarasciai.index');
    }

    public function create(){
        return view('tvarkarastis.create');
    }

    public function store(){
        return redirect()->route('tvarkarasciai.index');
    }

    public function delete(){
        return redirect()->route('tvarkarasciai.index');
    }
}
