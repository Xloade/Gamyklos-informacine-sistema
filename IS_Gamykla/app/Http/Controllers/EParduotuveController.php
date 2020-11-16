<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EParduotuveController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('eparduotuve.index');
    }
    public function cart()
    {
        return view('eparduotuve.cart');
    }
    public function complete()
    {
        return view('eparduotuve.complete');
    }
    public function show($id)
    {
        return view('eparduotuve.show');
    }

}
