<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamyklaController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('gamykla.index');
    }
}
