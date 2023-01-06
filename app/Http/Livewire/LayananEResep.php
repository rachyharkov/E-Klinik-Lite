<?php

namespace App\Http\Livewire;

use App\Models\Obat;
use Livewire\Component;

class LayananEResep extends Component
{

    public $obatuntukpasien = [];

    protected $listeners = [
        'setObatUntukPasien',
    ];

    public function render()
    {
        return view('livewire.layanan-e-resep');
    }
}
