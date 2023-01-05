<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Livewire\Component;

class SearchPatient extends Component
{

    public $nama_pasien_yang_dicari = '';
    public $searchPasienResults;

    protected $listeners = ['selectPatient'];

    public function render()
    {
        $this->searchPatient();
        return view('livewire.search-patient');
    }

    public function searchPatient()
    {
        if ($this->nama_pasien_yang_dicari != '') {
            $this->searchPasienResults = Patient::where('patient_name', 'like', '%'.$this->nama_pasien_yang_dicari.'%')->get();
        }
    }

    public function selectPatient($id)
    {
        $patientData = Patient::find($id);
        $this->emitUp('setDataPasien', $patientData);
        $this->nama_pasien_yang_dicari = '';
        $this->searchPasienResults = null;
    }
}
