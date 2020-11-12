<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserValidateRequest;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function editprofile()
    {
        return view('user.editprofile');
    }
}
