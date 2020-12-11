<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sandelis;

class SandelioUzimtumasController extends Controller
{
    public function __construct()
    {

    }

    public function show()
    {
        $sandeliai = Sandelis::all();
        return view('sandelio_uzimtumas.show', ['sandeliai' => $sandeliai]);
    }
}
