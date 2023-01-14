<?php

namespace App\Http\Controllers;

use App\Models\Tindakan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TindakanController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $query = Tindakan::with([
                'kategori_tindakan'
            ])->get();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action','livewire.tindakan._action')
                ->toJson();
        }

        return view('tindakan.index');
    }

    public function store(Request $request)
    {
        $datanya = $request->validate([
            'nama_tindakan' => 'required',
            'id_kategori_tindakan' => 'required',
            'tarif' => 'required',
        ]);

        Tindakan::create($datanya);

        return [
            'status' => 'success',
            'message' => 'Data berhasil disimpan',
            'your_data' => $datanya
        ];
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tindakan' => 'required',
            'id_kategori_tindakan' => 'required',
            'tarif' => 'required',
        ]);

        $datanya = Tindakan::find($id);
        $datanya->update($request->all());
        $datanya->save();

        return [
            'status' => 'success',
            'message' => 'Data berhasil diupdate',
            'your_data' => $datanya
        ];
    }

    public function destroy($id)
    {
        $datanya = Tindakan::find($id);
        $datanya->delete();

        return [
            'status' => 'success',
            'message' => 'Data berhasil dihapus',
            'your_data' => $datanya
        ];
    }
}
