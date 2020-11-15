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
        return view('gamykla.index');
    }

    public function edit($id){
        return view('gamykla.edit');
    }

    public function update($id){
        return redirect()->route('gamyklos.index');
    }

    public function create(){
        return view('gamykla.create');
    }

    public function store(){
        return redirect()->route('gamyklos.index');
    }

    public function delete(){
        return redirect()->route('gamyklos.index');
    }
}
