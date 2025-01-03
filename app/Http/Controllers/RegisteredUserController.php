<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class
RegisteredUserController extends Controller
{
    public function create()
    {
//        dd('HELLO WORLD !!!');
        return view('auth.register');
    }
}
