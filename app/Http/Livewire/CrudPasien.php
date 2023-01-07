<?php

namespace App\Http\Livewire;

use App\Models\JenisPatient;
use App\Models\Patient;
use Livewire\Component;

class CrudPasien extends Component
{

    public $menu = null;
    public $titlenya = null;
    public $datanya = null;
    public $patient_name, $jenis_kelamin, $patient_birth_place, $patient_birth_date, $patient_address, $patient_phone, $risiko_jatuh, $jenis_pasien_id;
    public $jenis_pasien_list = null;
    public $action;

    protected $listeners = [
        'setMenu',
        'cleanForm'
    ];

    public function mount()
    {
        $this->setMenu('index');
    }

    public function render()
    {
        return view('livewire.crud-pasien');
    }

    public function setMenu($menu, $id = null)
    {
        $this->menu = $menu;

        if($this->menu == 'index') {
            $this->titlenya = 'Data Pasien';
            $this->dispatchBrowserEvent('initTableNya', ['message' => 'Data berhasil dihapus']);
        }
        if($this->menu == 'create') {
            $this->titlenya = 'Tambah';
            $this->jenis_pasien_list = JenisPatient::all();
            $this->action = route('pasien.store');
        }
        if($this->menu == 'edit') {
            $this->titlenya = 'Edit';
            $this->datanya = Patient::with([
                'jenis_pasien'
            ])->find($id);
            $this->action = route('pasien.update', $id);
        }
        if($this->menu == 'show') {
            $this->titlenya = 'Detail';
            $this->datanya = Patient::with([
                'jenis_pasien'
            ])->find($id);
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
    }
}
