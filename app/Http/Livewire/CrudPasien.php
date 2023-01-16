<?php

namespace App\Http\Livewire;

use App\Models\JenisPatient;
use App\Models\Patient;
use App\Models\PatientTemp;
use App\Models\Regency;
use Livewire\Component;

class CrudPasien extends Component
{

    public $menu = null;
    public $titlenya = null;
    public $pasien_id, $patient_name, $jenis_kelamin, $patient_birth_place, $patient_birth_date, $patient_address, $patient_phone, $risiko_jatuh, $jenis_pasien_id, $jenis_pasien_id_old, $registered_at;
    public $jenis_pasien_list = null;
    public $listDataDaerah;
    public $action;


    protected $listeners = [
        'setMenu',
        'cleanForm',
        'restoreValue'
    ];

    public function mount()
    {
        $this->setMenu('index');
        $this->listDataDaerah = Regency::all();
    }

    public function render()
    {
        return view('livewire.crud-pasien');
    }

    public function updated($propertyName)
    {
        dd('$propertyName');
    }

    public function setMenu($menu, $id = null, $jenisPasien = null)
    {
        $this->menu = $menu;

        if($this->menu == 'index') {
            $this->titlenya = 'Data Pasien';
            $this->dispatchBrowserEvent('initTableNya', ['message' => 'Data berhasil dihapus']);
            $this->cleanForm();
        }
        if($this->menu == 'create') {
            $this->titlenya = 'Tambah';
            $this->jenis_pasien_list = JenisPatient::all();
            $this->action = route('pasien.store');
        }
        if($this->menu == 'edit') {
            $this->titlenya = 'Edit';

            if($jenisPasien == 1) {
                $dataPasien = PatientTemp::find($id);
            } else {
                $dataPasien = Patient::find($id);
            }

            $this->pasien_id = $dataPasien->id;
            $this->patient_name = $dataPasien->patient_name;
            $this->jenis_kelamin = $dataPasien->jenis_kelamin;
            $this->patient_birth_place = $dataPasien->patient_birth_place;
            $this->patient_birth_date = $dataPasien->patient_birth_date;
            $this->patient_address = $dataPasien->patient_address;
            $this->patient_phone = $dataPasien->patient_phone;
            $this->risiko_jatuh = $dataPasien->risiko_jatuh ? 1 : 0;
            $this->jenis_pasien_id = $jenisPasien == null ? 1 : $dataPasien->jenis_pasien_id;
            $this->jenis_pasien_list = JenisPatient::all();
            $this->registered_at = $dataPasien->registered_at;
            $this->jenis_pasien_id_old = $dataPasien->jenis_pasien_id;

            $this->action = route('pasien.update', $id);
        }
        if($this->menu == 'show') {
            if($jenisPasien == 1) {
                $dataPasien = PatientTemp::find($id);
            } else {
                $dataPasien = Patient::find($id);
            }

            $this->titlenya = 'Detail Pasien ' . $dataPasien->patient_name;

            $this->pasien_id = $dataPasien->id;
            $this->patient_name = $dataPasien->patient_name;
            $this->jenis_kelamin = $dataPasien->jenis_kelamin;
            $this->patient_birth_place = $dataPasien->patient_birth_place;
            $this->patient_birth_date = $dataPasien->patient_birth_date;
            $this->patient_address = $dataPasien->patient_address;
            $this->patient_phone = $dataPasien->patient_phone;
            $this->risiko_jatuh = $dataPasien->risiko_jatuh ? 1 : 0;
            $this->jenis_pasien_id = $dataPasien->jenis_pasien_id;
            $this->registered_at = $dataPasien->registered_at;
        }
    }

    public function cleanForm()
    {
        $this->patient_name = null;
        $this->jenis_kelamin = null;
        $this->patient_birth_place = null;
        $this->patient_birth_date = null;
        $this->patient_address = null;
        $this->patient_phone = null;
        $this->risiko_jatuh = null;
        $this->jenis_pasien_id = null;
        $this->jenis_pasien_id_old = null;
        $this->registered_at = null;
    }

    public function restoreValue(){
        $this->setMenu('edit', $this->pasien_id);
    }
}
