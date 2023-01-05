<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkmodeController extends Controller
{
    public function index()
    {
        return view('workmode.index');
    }
}
