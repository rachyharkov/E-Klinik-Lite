<?php

namespace App\Http\Livewire;

use App\Models\Obat;
use App\Models\Patient;
use App\Models\Regency;
use App\Models\Tindakan;
use Livewire\Component;

class Formworkmode extends Component
{
    public $currentStep = 1;
    public $isMember;
    public $successmessage = '';

    public $dataPasien = [
        'id' => null,
        'patient_name' => null,
        'patient_birth_place' => null,
        'patient_birth_date' => null,
        'jenis_kelamin' => 'Laki-laki',
        'patient_address' => null,
        'patient_phone' => null,
        'risiko_jatuh' => 0
    ];
    public $dataLayananAtauTindakan = null;
    public $dataObatdanResep = null;
    public $dataKonsultasi = null;
    public $listDataDaerah = null;

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

    protected $messages = [
        'dataPasien.patient_name.required' => 'Nama Pasien harus diisi',
        'dataPasien.patient_birth_place.required' => 'Tempat Lahir Pasien harus diisi',
        'dataPasien.patient_birth_date.required' => 'Tanggal Lahir Pasien harus diisi',
        'dataPasien.jenis_kelamin.required' => 'Jenis Kelamin Pasien harus diisi',
        'dataPasien.patient_address.required' => 'Alamat Pasien harus diisi',
        'dataPasien.patient_phone.required' => 'Nomor Telepon Pasien harus diisi',
        'dataPasien.risiko_jatuh.required' => 'Risiko Jatuh Pasien harus diisi',
    ];

    public function mount()
    {
        $this->listDataDaerah = Regency::all();
    }

    public function render()
    {
        return view('livewire.formworkmode');
    }

    public function stepAction($step)
    {
        if($step > 0) {
            $this->checkPasienDataValidation();
        }


        $this->currentStep += $step;

        if ($this->currentStep == 1) {
            $this->cleanDataPasien();
            $this->dataLayananAtauTindakan = null;
            $this->dataObatdanResep = null;
            $this->dataKonsultasi = null;
        }

        if($this->currentStep == 3 && !$this->dataLayananAtauTindakan && !$this->dataObatdanResep && !$this->dataKonsultasi){
            $this->dataLayananAtauTindakan = null;
            $this->dataObatdanResep = null;
            $this->dataKonsultasi = null;
        }

        // if($this->currentStep == 4) {
        //     dd([
        //         'isMember' => $this->isMember,
        //         'dataPasien' => $this->dataPasien,
        //         'dataLayananAtauTindakan' => $this->dataLayananAtauTindakan,
        //         'dataObatdanResep' => $this->dataObatdanResep,
        //         'dataKonsultasi' => $this->dataKonsultasi,
        //     ]);
        // }

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
        $this->cleanDataPasien();
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
                'harga_obats' => function ($query) {
                    $query->where('id_jenis_pasien', 1); // 1 = umum
                },
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

    public function checkPasienDataValidation()
    {
        if ($this->currentStep == 2) {
            $this->validate([
                'dataPasien.patient_name' => 'required',
                'dataPasien.patient_birth_place' => 'required',
                'dataPasien.patient_birth_date' => 'required',
                'dataPasien.jenis_kelamin' => 'required',
                'dataPasien.patient_address' => 'required',
                'dataPasien.patient_phone' => 'required',
                'dataPasien.risiko_jatuh' => 'required'
            ]);
        }
    }

    public function cleanDataPasien() {
        $this->dataPasien = [
            'patient_name' => null,
            'patient_birth_place' => null,
            'patient_birth_date' => null,
            'jenis_kelamin' => 'Laki-laki',
            'patient_address' => null,
            'patient_phone' => null,
            'risiko_jatuh' => 0
        ];
    }
}
