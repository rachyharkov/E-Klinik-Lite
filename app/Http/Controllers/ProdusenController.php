<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Produsen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProdusenController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $query = Produsen::query();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action','livewire.produsen._action')
                ->toJson();
        }

        return view('produsen.index');
    }

    public function store(Request $request)
    {
        $datanya = $request->validate([
            'nama_produsen' => 'required',
            'catatan' => 'required',
        ]);

        $datanya['catatan'] = htmlentities($datanya['catatan']);

        Produsen::create($datanya);

        return [
            'status' => 'success',
            'message' => $datanya['nama_produsen'].' berhasil ditambahkan',
            'your_data' => $datanya
        ];
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produsen' => 'required',
            'catatan' => 'required',
        ]);

        $datanya = Produsen::find($id);
        $request['catatan'] = htmlentities($request['catatan']);
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
        $dataObat = Obat::where('id_produsen', $id)->get()->count();

        if($dataObat > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak bisa dihapus karena masih ada data obat yang terkait'
            ], 400);
        }

        $datanya = Produsen::find($id);

        $namaProdusen = $datanya->nama_produsen;

        $datanya->delete();

        return [
            'status' => 'success',
            'message' => $namaProdusen.' berhasil dihapus',
            'your_data' => $datanya
        ];
    }
}
