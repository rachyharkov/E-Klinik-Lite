<?php

namespace App\Http\Controllers;

use App\Models\JenisPatient;
use App\Models\Patient;
use App\Models\PatientTemp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PasienController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {

            $filterJenisPasien = request()->filterJenisPasien;

            $query = null;

            if($filterJenisPasien == 1) {
                $query = PatientTemp::query();
            }

            if($filterJenisPasien == 2) {
                $query = Patient::query()
                    ->where('jenis_pasien_id', 2);
            }

            if($filterJenisPasien == 3) {
                $query = Patient::query()
                    ->where('jenis_pasien_id', 3);
            }

            if(!isset($filterJenisPasien) || $filterJenisPasien == null || $filterJenisPasien == '') {
                $patientList = Patient::all();
                $patientTempList = PatientTemp::all();
                $query = $patientList->merge($patientTempList);
            }

            return DataTables::of($query)
                ->addColumn('jenis_pasien', function($row) {

                    return [
                        'id' => $row->jenis_pasien->id,
                        'nama_jenis_pasien' => $row->jenis_pasien->nama_jenis_pasien,
                        'color_code' => $row->jenis_pasien->color_code,
                    ];
                })
                ->addIndexColumn()
                ->addColumn('action','livewire.pasien._action')
                ->toJson();

        }

        $data = [
            'jenisPasien' => JenisPatient::all(),
        ];

        return view('pasien.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required',
            'jenis_kelamin' => 'required',
            'patient_address' => 'required',
            'patient_phone' => 'required',
            'patient_birth_place' => 'required',
            'patient_birth_date' => 'required',
            'jenis_pasien_id' => 'required',
        ]);

        $datanya = [
            'patient_name' => $request->patient_name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'patient_address' => $request->patient_address,
            'patient_phone' => $request->patient_phone,
            'patient_birth_place' => $request->patient_birth_place,
            'patient_birth_date' => $request->patient_birth_date,
            'jenis_pasien_id' => $request->jenis_pasien_id,
            'risiko_jatuh' => $request->risiko_jatuh ? 1 : 0,
        ];

        $jenis_pasien = $request->jenis_pasien_id;

        if($jenis_pasien == null || $jenis_pasien == 1 || $jenis_pasien == '') {
            $datanya['registered_at'] = Carbon::now()->format('Y-m-d H:i:s');
            PatientTemp::create($datanya);
        } else {
            $datanya['registered_at'] = Carbon::now()->format('Y-m-d H:i:s');
            Patient::create($datanya);
        }

        return [
            'status' => 'success',
            'message' => 'Data berhasil disimpan',
            'your_data' => $datanya
        ];
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_name' => 'required',
            'jenis_kelamin' => 'required',
            'patient_address' => 'required',
            'patient_phone' => 'required',
            'patient_birth_place' => 'required',
            'patient_birth_date' => 'required',
            'jenis_pasien_id' => 'required',
        ]);

        $datanya = [
            'id' => $id,
            'patient_name' => $request->patient_name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'patient_address' => $request->patient_address,
            'patient_phone' => $request->patient_phone,
            'patient_birth_place' => $request->patient_birth_place,
            'patient_birth_date' => $request->patient_birth_date,
            'jenis_pasien_id' => $request->jenis_pasien_id,
            'risiko_jatuh' => isset($request->risiko_jatuh) ? 1 : 0,
        ];

        $jenis_pasien = $datanya['jenis_pasien_id'];
        $jenis_pasien_id_old = $request->jenis_pasien_id_old;

        if($jenis_pasien == 1 || $jenis_pasien == null || $jenis_pasien == '') { // jika jenis pasien adalah pasien baru
            if($jenis_pasien == $jenis_pasien_id_old) { // jika jenis pasien sama dengan jenis pasien lama
                PatientTemp::find($id)->update($datanya);
            } else { // jika jenis pasien tidak sama dengan jenis pasien lama
                $datanya['registered_at'] = Carbon::now()->format('Y-m-d H:i:s');
                PatientTemp::create($datanya);

                Patient::find($id)->delete();
            }
        } else { // jika jenis pasien adalah pasien lama
            if($jenis_pasien == $jenis_pasien_id_old) { // jika jenis pasien sama dengan jenis pasien lama
                Patient::find($id)->update($datanya);
            } else { // jika jenis pasien tidak sama dengan jenis pasien lama
                if($jenis_pasien_id_old == 1 || $jenis_pasien_id_old == null || $jenis_pasien_id_old == '') {
                    $datanya['registered_at'] = Carbon::now()->format('Y-m-d H:i:s');
                    Patient::create($datanya);
                    PatientTemp::find($id)->delete();
                } else {
                    $datanya['registered_at'] = Carbon::now()->format('Y-m-d H:i:s');
                    Patient::find($id)->update($datanya);
                }
            }
        }

        return [
            'status' => 'success',
            'message' => 'Data berhasil diupdate'
        ];
    }

    public function destroy($id)
    {
        $datanya = Patient::find($id);
        $datanya->delete();

        return [
            'status' => 'success',
            'message' => 'Data berhasil dihapus',
            'your_data' => $datanya
        ];
    }
}
