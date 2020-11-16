<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SandelisController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('sandelis.index');
    }

    public function edit($id){
        return view('sandelis.edit');
    }

    public function update($id){
        return redirect()->route('sandelis.index');
    }

    public function create(){
        return view('sandelis.create');
    }

    public function store(){
        return redirect()->route('sandelis.index');
    }

    public function delete(){
        return redirect()->route('sandelis.index');
    }
}
