<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sandelis;

class SandelisController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        $sandeliai = Sandelis::all();

        return view('sandelis.index', ['sandeliai' => $sandeliai]);
    }

    public function edit($id){
        echo $id;
        $sandelis = Sandelis::where('sandelio_kodas', $id)->get();
        return view('sandelis.edit', ['sandelis' => $sandelis[0]]);
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
