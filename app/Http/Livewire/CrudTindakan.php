<?php

namespace App\Http\Livewire;

use App\Models\KategoriTindakan;
use App\Models\Tindakan;
use Livewire\Component;

class CrudTindakan extends Component
{
    public $menu = null;
    public $titlenya = null;
    public $tindakan_id, $nama_tindakan, $id_kategori_tindakan, $is_active, $tarif;
    public $kategori_tindakan_list;
    public $action;

    protected $listeners = [
        'setMenu',
        'cleanForm',
        'restoreValue'
    ];

    public function mount()
    {
        $this->setMenu('index');
    }

    public function render()
    {
        return view('livewire.crud-tindakan');
    }

    public function setMenu($menu, $id = null)
    {
        $this->menu = $menu;

        if($this->menu == 'index') {
            $this->titlenya = 'Data Tindakan';
            $this->dispatchBrowserEvent('initTableNya', ['message' => 'Tindakan berhasil dihapus']);
            $this->cleanForm();
        }
        if($this->menu == 'create') {
            $this->titlenya = 'Tambah';
            $this->kategori_tindakan_list = KategoriTindakan::all();
            $this->action = route('tindakan.store');
        }
        if($this->menu == 'edit') {
            $this->titlenya = 'Edit';
            $dataTindakan = Tindakan::find($id);

            $this->tindakan_id = $dataTindakan->id;
            $this->nama_tindakan = $dataTindakan->nama_tindakan;
            $this->id_kategori_tindakan = $dataTindakan->id_kategori_tindakan;
            $this->is_active = $dataTindakan->is_active;
            $this->tarif = $dataTindakan->tarif;
            $this->kategori_tindakan_list = KategoriTindakan::all();

            $this->action = route('tindakan.update', $id);
        }
        if($this->menu == 'show') {
            $this->titlenya = 'Detail Tindakan';
            $dataTindakan = Tindakan::with([
                'kategori_tindakan'
            ])->find($id);

            $this->tindakan_id = $dataTindakan->id;
            $this->nama_tindakan = $dataTindakan->nama_tindakan;
            $this->id_kategori_tindakan = $dataTindakan->id_kategori_tindakan;
            $this->is_active = $dataTindakan->is_active;
            $this->tarif = $dataTindakan->tarif;
        }
    }

    public function cleanForm()
    {
        $this->tindakan_id = null;
        $this->nama_tindakan = null;
        $this->id_kategori_tindakan = null;
        $this->is_active = null;
        $this->tarif = null;
    }

    public function restoreValue(){
        $this->setMenu('edit', $this->tindakan_id);
    }
}
