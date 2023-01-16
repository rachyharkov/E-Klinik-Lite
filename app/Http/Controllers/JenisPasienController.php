<?php

namespace App\Http\Controllers;

use App\Models\JenisPatient;
use Illuminate\Http\Request;

class JenisPasienController extends Controller
{
    public function index()
    {
        return view('jenis_pasien.index');
    }
}
