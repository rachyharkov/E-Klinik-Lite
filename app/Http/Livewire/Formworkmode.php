<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Livewire\Component;

class Formworkmode extends Component
{
    public $currentStep = 1;
    public $isMember;
    public $successmessage = '';

    public $dataPasien = null;
    public $dataLayananAtauTindakan = null;
    public $dataObat = null;
    public $dataKonsultasi = null;

    public $formisian = [
        0 => [
            'done' => false,
        ],
        1 => [
            'done' => false,
        ],
        2 => [
            'done' => false,
        ],
        3 => [
            'done' => false,
        ],
    ];

    protected $listeners = [
        'setDataPasien', // dari form-step-2
        'savePatientData', // dari form-step-2
        'saveDataLayananAtauTindakan', // dari form-step-3
        'saveDataObat', // dari form-step-3
        'saveDataKonsultasi', // dari form-step-3
    ];

    public function render()
    {
        return view('livewire.formworkmode');
    }

    public function stepAction($step)
    {

        $this->currentStep += $step;

        if ($this->currentStep == 1) {
            $this->dataPasien = null;
            $this->dataLayananAtauTindakan = null;
            $this->dataObat = null;
            $this->dataKonsultasi = null;
        }

        if ($this->currentStep > 4) {
            $this->submitForm();
        }
    }

    public function submitForm()
    {
        $this->successmessage = 'Form Successfully Submitted!';
        $this->clearForm();

        $this->currentStep = 1;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function clearForm()
    {
        $this->isMember = '';
        $this->dataPasien = null;
    }

    public function setDataPasien($data)
    {
        $this->dataPasien = $data;
    }

    public function savePatientData($data)
    {
        $property_name = $data['property_name'];
        $value = $data['value'];

        $this->dataPasien[$property_name] = $value;
    }

    public function saveDataLayananAtauTindakan($data)
    {
        $this->dataLayananAtauTindakan = $data;
        dd($this->dataLayananAtauTindakan);
    }

    public function saveDataObat($data)
    {
        $this->dataObat = $data;
        dd($this->dataObat);
    }

    public function saveDataKonsultasi($data)
    {
        $this->dataKonsultasi = $data;
        dd($this->dataKonsultasi);
    }
}
