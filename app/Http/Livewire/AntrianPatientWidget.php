<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use App\Models\PatientTemp;
use App\Models\PatientVisit;
use Livewire\Component;

class AntrianPatientWidget extends Component
{

    public $antrianList = [];

    protected $listeners = [
        'refreshAntrian'
    ];

    public function mount() {
        $this->refreshAntrian();
    }

    public function render()
    {
        return view('livewire.antrian-patient-widget');
    }

    public function refreshAntrian() {
        // select * from patient_visits, loop through each patient_visit, if patient_temp is 1, connect to patient_temp table, if patient_temp is 0, connect to patient table
        $antrianList = PatientVisit::whereBetween('created_at', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])
            ->orderBy('urutan', 'asc')
            ->get();

        $antrianListTemp = [];

        foreach ($antrianList as $antrian) {
            $patient = $this->findPatient($antrian->patient_id, $antrian->patient_temp);
            $antrian->patient = $patient;
            $antrianListTemp[] = $antrian;
        }

        if ($antrianList->count() > 0) {
            $this->antrianList = $antrianList;
        } else {
            $this->antrianList = [];
        }
    }

    public function findPatient($id, $patient_temp) {
        $patient = null;

        if ($patient_temp == 1) {
            $patient = PatientTemp::find($id)->first();
        } else {
            $patient = Patient::find($id)->first();
        }
        return $patient;
    }
}
