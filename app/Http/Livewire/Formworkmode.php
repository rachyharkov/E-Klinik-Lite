<?php

namespace App\Http\Livewire;

use App\Models\Obat;
use App\Models\Patient;
use App\Models\Tindakan;
use Livewire\Component;

class Formworkmode extends Component
{
    public $currentStep = 1;
    public $isMember;
    public $successmessage = '';

    public $dataPasien = null;
    public $dataLayananAtauTindakan = null;
    public $dataObatdanResep = null;
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
        'saveDataObatResep', // dari form-step-3
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
            $this->dataObatdanResep = null;
            $this->dataKonsultasi = null;
        }

        if($this->currentStep == 3 && !$this->dataLayananAtauTindakan && !$this->dataObatdanResep && !$this->dataKonsultasi){
            $this->dataLayananAtauTindakan = null;
            $this->dataObatdanResep = null;
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
        $dataTindakan = null;
        foreach ($data as $value) {
            $dataTindakan[] = Tindakan::find($value);

        }
        $this->dataLayananAtauTindakan = $dataTindakan;
    }

    public function saveDataObatResep($data)
    {
        $tempDataObatdanResep = [];
        foreach ($data['obat'] as $value) {
            $dataObat = Obat::with([
                'harga_obats',
                'satuan_obats',
            ])->where('id', $value['obat_id'])->first();

            $dataObat['jumlah'] = $value['jumlah'];
            $dataObat['aturan_pakai'] = $value['aturan_pakai'];

            $tempDataObatdanResep[] = $dataObat;
        }

        $data['obat'] = $tempDataObatdanResep;

        $this->dataObatdanResep = $data;
    }

    public function saveDataKonsultasi($data)
    {
        $this->dataKonsultasi = htmlentities($data);
        // dd($this->dataKonsultasi);
    }
}
