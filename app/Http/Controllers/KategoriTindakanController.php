<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriTindakanController extends Controller
{
    public function index()
    {
        return view('kategori_tindakan.index');
    }
}
