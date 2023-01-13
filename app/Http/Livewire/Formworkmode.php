<?php

namespace App\Http\Livewire;

use App\Models\DataPembayaran;
use App\Models\HistoryKeadaanPatient;
use App\Models\HistoryKonsul;
use App\Models\HistoryObat;
use App\Models\HistoryTindakan;
use App\Models\HutangPiutang;
use App\Models\Obat;
use App\Models\PatientVisit;
use App\Models\Regency;
use App\Models\Tindakan;
use Carbon\Carbon;
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
    public $dataKeadaanPasien = [
        'berat_badan' => null,
        'tinggi_badan' => null,
        'alergi_obat' => 'Tidak ada',
        'gangguan_fungsi_ginjal' => 0,
        'puasa' => 0
    ];
    public $dataTindakan = [];
    public $dataObatdanResep = [];
    public $dataKonsultasi = null;
    public $listDataDaerah = null;
    public $biayaKonsultasi = 15000;
    public $dataPembayaran = [
        'totalBiaya' => 0,
        'diskonBiaya' => 0,
        'dibayarPasien' => 0,
        'sisaTagihan' => 0,
        'dibayarOleh' => null,
        'metodePembayaran' => null,
    ];

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
        'savedataTindakan', // dari form-step-3
        'saveDataObatResep', // dari form-step-3
        'saveDataKeadaanPasien',
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
            $this->dataTindakan = null;
            $this->dataObatdanResep = null;
            $this->dataKonsultasi = null;
        }

        if($this->currentStep == 3 && !$this->dataTindakan && !$this->dataObatdanResep && !$this->dataKonsultasi){
            $this->dataTindakan = null;
            $this->dataObatdanResep = null;
            $this->dataKonsultasi = null;
        }

        // if($this->currentStep == 4) {
        //     dd([
        //         'isMember' => $this->isMember,
        //         'dataPasien' => $this->dataPasien,
        //         'dataTindakan' => $this->dataTindakan,
        //         'dataObatdanResep' => $this->dataObatdanResep,
        //         'dataKonsultasi' => $this->dataKonsultasi,
        //     ]);
        // }

        if ($this->currentStep > 4) {
            $this->saveDataKunjungan();
            $this->dariAwalLagi();
        }
    }

    public function dariAwalLagi()
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
        $this->dataPasien = [
            'id' => null,
            'patient_name' => null,
            'patient_birth_place' => null,
            'patient_birth_date' => null,
            'jenis_kelamin' => 'Laki-laki',
            'patient_address' => null,
            'patient_phone' => null,
            'risiko_jatuh' => 0
        ];
        $this->dataTindakan = null;
        $this->dataKeadaanPasien = [
            'berat_badan' => null,
            'tinggi_badan' => null,
            'alergi_obat' => 'Tidak ada',
            'gangguan_fungsi_ginjal' => 0,
            'puasa' => 0
        ];
        $this->dataObatdanResep = null;
        $this->dataKonsultasi = '';
        $this->listDataDaerah = null;
        $this->dataPembayaran = [
            'totalBiaya' => 0,
            'diskonBiaya' => 0,
            'dibayarPasien' => 0,
            'sisaTagihan' => 0,
            'dibayarOleh' => null,
            'metodePembayaran' => null,
        ];
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

    public function savedataTindakan($data)
    {
        $dataTindakan = null;
        foreach ($data as $value) {
            $dataTindakan[] = Tindakan::find($value);

        }
        $this->dataTindakan = $dataTindakan;
    }

    public function saveDataObatResep($data)
    {
        $tempDataObatdanResep = [];

        if (isset($data)) {
            foreach ($data as $value) {
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
        }

        $this->dataObatdanResep = $tempDataObatdanResep;
    }

    public function saveDataKeadaanPasien($data)
    {
        $this->dataKeadaanPasien = $data;
    }

    public function saveDataKonsultasi($data)
    {
        $this->dataKonsultasi = htmlentities($data);
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

    // public function hitungTagihan() {

    //     $totalBiayaTemp = 0;

    //     foreach ($this->dataTindakan as $value) {
    //         $totalBiayaTemp += $value['harga'];
    //     }

    //     foreach ($this->dataObatdanResep['obat'] as $value) {
    //         $totalBiayaTemp += $value['harga_obats'][0]['harga'] * $value['jumlah'];
    //     }

    //     $totalBiayaTemp += $this->biayaKonsultasi; // biaya konsultasi

    //     $totalBiayaTemp -= $this->diskonBiaya; // diskon

    //     $this->dataPembayaran['totalBiaya'] = $totalBiayaTemp;
    // }

    public function saveDataKunjungan() {

        if($this->dataPasien != null) {

            PatientVisit::create([
                'patient_id' => $this->dataPasien['id'],
                'urutan' => PatientVisit::where('id', $this->dataPasien['id'])->count() + 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $getLatestIdPatientVisit = PatientVisit::latest()->first()->id;

            if(!empty($this->dataTindakan)) {
                foreach ($this->dataTindakan as $value) {
                    HistoryTindakan::create([
                        'patient_visit_id' => $getLatestIdPatientVisit,
                        'tindakan_id' => $value['id'],
                        'harga' => $value['tarif'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }

            if(!empty($this->dataObatdanResep)) {
                foreach ($this->dataObatdanResep as $value) {
                    HistoryObat::create([
                        'patient_visit_id' => $getLatestIdPatientVisit,
                        'obat_id' => $value['id'],
                        'aturan_pakai' => $value['aturan_pakai'],
                        'harga' => $value['harga_obats'][0]['harga'],
                        'jumlah' => $value['jumlah'],
                        'total' => $value['harga_obats'][0]['harga'] * $value['jumlah'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }

            HistoryKeadaanPatient::create([
                'patient_visit_id' => $getLatestIdPatientVisit,
                'berat_badan' => $this->dataKeadaanPasien['berat_badan'],
                'tinggi_badan' => $this->dataKeadaanPasien['tinggi_badan'],
                'alergi_obat' => $this->dataKeadaanPasien['alergi_obat'],
                'gangguan_fungsi_ginjal' => $this->dataKeadaanPasien['gangguan_fungsi_ginjal'],
                'puasa' => $this->dataKeadaanPasien['puasa'],
                'risiko_jatuh' => $this->dataPasien['risiko_jatuh'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            HistoryKonsul::create([
                'patient_visit_id' => $getLatestIdPatientVisit,
                'konsultasi' => $this->dataKonsultasi,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $statusTagihan = 'Lunas';
            $sisaTagihan = $this->dataPembayaran['totalBiaya'] - $this->dataPembayaran['diskonBiaya'] - $this->dataPembayaran['dibayarPasien'];

            if($sisaTagihan > 0) {
                $statusTagihan = 'Belum Lunas';
            }

            DataPembayaran::create([
                'patient_visit_id' => $getLatestIdPatientVisit,
                'metode_pembayaran_id' => $this->dataPembayaran['metodePembayaran'],
                'total_biaya' => $this->dataPembayaran['totalBiaya'],
                'diskon' => $this->dataPembayaran['diskonBiaya'],
                'dibayar' => $this->dataPembayaran['dibayarPasien'],
                'sisa_tagihan' => $sisaTagihan,
                'status' => $statusTagihan,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if($statusTagihan == 'Belum Lunas') {
                $getLatestDataPembayaranID = DataPembayaran::latest()->first()->id;

                HutangPiutang::create([
                    'data_pembayaran_id' => $getLatestDataPembayaranID,
                    'nominal_awal' => $this->dataPembayaran['totalBiaya'] - $this->dataPembayaran['diskonBiaya'],
                    'diskon' => $this->dataPembayaran['diskonBiaya'],
                    'dibayar' => $this->dataPembayaran['dibayarPasien'],
                    'sisa_tagihan' => $sisaTagihan,
                    'dibayar_oleh' => $this->dataPembayaran['metodePembayaran'],
                    'metode_pembayaran_id' => $this->dataPembayaran['metodePembayaran'],
                    'keterangan' => 'Belum Lunas - Pembayaran Awal',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        } else {
            dd('Bukan Pasien Lama kah?');
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
