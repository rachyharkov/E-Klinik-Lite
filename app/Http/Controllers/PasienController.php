<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PasienController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $query = Patient::query();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action','pasien._action')
                ->toJson();
        }

        return view('pasien.index');
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        //
    }
}
