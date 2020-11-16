<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PopuliariausiosPrekesController extends Controller
{
    public function __construct()
    {

    }

    public function show()
    {
        return view('populiariausios_prekes.show');
    }
}
