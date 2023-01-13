<?php

namespace App\Http\Controllers;

use App\Models\HistoryKeadaanPatient;
use App\Models\HistoryKonsul;
use App\Models\HistoryObat;
use App\Models\HistoryTindakan;
use App\Models\PatientVisit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RekamMedis extends Controller
{
    public function index() {
        if(request()->ajax()) {

            $id = request()->id;

            $query = PatientVisit::with([
                'patient',
                'patient.jenis_pasien'
            ])->where('patient_id', $id)->get();

            $patient_visit_id = $query->pluck('id');

            $dataKonsul = HistoryKonsul::whereIn('patient_visit_id', $patient_visit_id);

            $dataTindakan = HistoryTindakan::whereIn('patient_visit_id', $patient_visit_id);

            $dataObat = HistoryObat::whereIn('patient_visit_id', $patient_visit_id);

            $dataKeadaan = HistoryKeadaanPatient::whereIn('patient_visit_id', $patient_visit_id);

            $layanannya = [];

            if($dataKonsul->count() > 0) {
                $layanannya[] = [
                    'layanan' => 'Konsul',
                    'color' => 'bg-primary'
                ];
            }

            if($dataTindakan->count() > 0) {
                $layanannya[] = [
                    'layanan' => 'Tindakan',
                    'color' => 'bg-danger'
                ];
            }

            if($dataObat->count() > 0) {
                $layanannya[] = [
                    'layanan' => 'Obat',
                    'color' => 'bg-success'
                ];
            }

            if($dataKeadaan->count() > 0) {
                $layanannya[] = [
                    'layanan' => 'Tinjau Keadaan',
                    'color' => 'bg-info'
                ];
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('layanan_klinik', function($row) use ($layanannya) {
                    return $layanannya;
                })
                ->addColumn('action','livewire.formworkmode.layanan.action.rekam_medis_action')
                ->toJson();
        }
    }
}
