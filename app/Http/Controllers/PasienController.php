<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PasienController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $query = Patient::query();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action','livewire.pasien._action')
                ->toJson();
        }

        return view('pasien.index');
    }

    public function store(Request $request)
    {
        $datanya = $request->validate([
            'patient_name' => 'required',
            'jenis_kelamin' => 'required',
            'patient_address' => 'required',
            'patient_phone' => 'required',
            'patient_birth_place' => 'required',
            'patient_birth_date' => 'required',
            'jenis_pasien_id' => 'required',
        ]);

        Patient::create($datanya);

        return [
            'status' => 'success',
            'message' => 'Data berhasil disimpan',
            'your_data' => $datanya
        ];
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
