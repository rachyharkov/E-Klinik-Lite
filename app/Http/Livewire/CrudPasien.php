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
    public $jenis_pasien = null;

    public $listeners = [
        'setMenu',
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
            $this->jenis_pasien = JenisPatient::all();
        }
        if($this->menu == 'edit') {
            $this->titlenya = 'Edit';
            $this->datanya = Patient::with([
                'jenis_pasien'
            ])->find($id);
        }
        if($this->menu == 'show') {
            $this->titlenya = 'Detail';
            $this->datanya = Patient::with([
                'jenis_pasien'
            ])->find($id);
        }
    }
}
