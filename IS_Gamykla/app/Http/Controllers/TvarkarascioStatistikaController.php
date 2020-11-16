<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TvarkarascioStatistikaController extends Controller
{
    public function __construct()
    {

    }

    public function show()
    {
        return view('tvarkarascio_statistika.show');
    }
}
