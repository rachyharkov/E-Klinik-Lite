<?php

namespace App\Http\Livewire;

use App\Models\Tindakan;
use Livewire\Component;

class LayananTindakan extends Component
{
    public $tindakanuntukpasien = null;
    public $detailTindakan = null;

    protected $listeners = [
        'saveDataTindakan',
    ];

    public function render()
    {
        return view('livewire.layanan-tindakan');
    }

    public function saveDataTindakan($data)
    {
        $this->tindakanuntukpasien = $data;
        $dataTindakan = null;
        foreach ($data as $value) {
            $dataTindakan[] = Tindakan::find($value);

        }

        $this->detailTindakan = $dataTindakan;
        // dd($this->detailTindakan);

        $this->emitUp('saveDataLayananAtauTindakan', $this->detailTindakan);
    }

}
