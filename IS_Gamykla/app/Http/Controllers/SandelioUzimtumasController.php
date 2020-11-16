<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SandelioUzimtumasController extends Controller
{
    public function __construct()
    {

    }

    public function show()
    {
        return view('sandelio_uzimtumas.show');
    }
}
