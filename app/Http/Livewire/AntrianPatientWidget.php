<?php

namespace App\Http\Livewire;

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
        $antrianList = PatientVisit::with([
            'patient',
        ])->whereBetween('patient_visits.created_at', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])
            ->orderBy('patient_visits.urutan', 'asc')
            ->get();

        if ($antrianList->count() > 0) {
            $this->antrianList = $antrianList;
        } else {
            $this->antrianList = [];
        }
    }
}
