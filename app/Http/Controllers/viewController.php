<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class viewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inbox()
    {
        return view('inbox');
    }
}
