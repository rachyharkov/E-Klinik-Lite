<?php

namespace App\Http\Livewire;

use App\Models\Obat;
use Livewire\Component;

class LayananEResep extends Component
{

    public $obatuntukpasien = null;
    public $detailObat = null;

    protected $listeners = [
        'setDataObat',
    ];

    public function render()
    {
        return view('livewire.layanan-e-resep');
    }

    public function setDataObat($data)
    {
        $this->obatuntukpasien = $data;

        foreach ($this->obatuntukpasien['obat'] as $key => $value) {
            $dataObat = Obat::with([
                'harga_obats',
                'satuan_obats',
            ])->where('id', $value['obat_id'])->first();

            $this->detailObat[$key] = $dataObat;
        }

        $this->emitUp('saveDataObat', $this->obatuntukpasien);
    }
}
