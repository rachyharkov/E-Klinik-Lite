<?php

namespace App\Http\Livewire;

use App\Models\Produsen;
use Livewire\Component;

class CrudProdusen extends Component
{
    public $menu = null;
    public $titlenya = null;
    public $produsen_id, $nama_produsen, $catatan, $created_at, $updated_at;
    public $produsen_list;
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
        return view('livewire.crud-produsen');
    }

    public function setMenu($menu, $id = null)
    {
        $this->menu = $menu;

        if($this->menu == 'index') {
            $this->titlenya = 'Data Produsen';
            $this->dispatchBrowserEvent('initTableNya', ['message' => 'ayaya']);
            $this->cleanForm();
        }
        if($this->menu == 'create') {
            $this->titlenya = 'Tambah';
            $this->produsen_list = Produsen::all();
            $this->action = route('produsen.store');
        }
        if($this->menu == 'edit') {
            $this->titlenya = 'Edit';
            $dataProdusen = Produsen::find($id);
            $this->produsen_id = $dataProdusen->id;
            $this->nama_produsen = $dataProdusen->nama_produsen;
            $this->catatan = $dataProdusen->catatan;
            $this->created_at = $dataProdusen->created_at;
            $this->updated_at = $dataProdusen->updated_at;
            $this->action = route('produsen.update', $id);
        }
        if($this->menu == 'show') {
            $dataProdusen = Produsen::find($id);
            $this->titlenya = 'Detail Pasien ' . $dataProdusen->nama_produsen;
            $this->produsen_id = $dataProdusen->id;
            $this->nama_produsen = $dataProdusen->nama_produsen;
            $this->created_at = $dataProdusen->created_at;
            $this->updated_at = $dataProdusen->updated_at;
            $this->catatan = $dataProdusen->catatan;

        }
    }

    public function cleanForm()
    {
        $this->produsen_id = null;
        $this->nama_produsen = null;
        $this->catatan = null;
        $this->created_at = null;
        $this->updated_at = null;
    }

    public function restoreValue(){
        $this->setMenu('edit', $this->produsen_id);
    }
}
