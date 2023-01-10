<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LayananKonsul extends Component
{
    public $catatanKonsultasi = null;

    protected $listeners = [
        'setCatatanKonsultasi',
        'loadCKEditornya'
    ];

    public function render()
    {
        return view('livewire.layanan-konsul');
    }

    public function setCatatanKonsultasi($data) {
        $this->catatanKonsultasi = $data;
        // dd($this->catatanKonsultasi);
        $this->emitUp('saveDataKonsultasi', $this->catatanKonsultasi);
        $this->dispatchBrowserEvent('initCKEditorNya', ['catatanKonsul' => $this->catatanKonsultasi]);
    }
}
