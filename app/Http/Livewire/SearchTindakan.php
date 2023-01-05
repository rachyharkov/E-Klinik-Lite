<?php

namespace App\Http\Livewire;

use App\Models\Tindakan;
use Livewire\Component;

class SearchTindakan extends Component
{

    public $searchtindakankeyword = "" ;

    public function render()
    {
        sleep(1);

        $tindakansearchresult = Tindakan::where('nama_tindakan', 'like', '%' . $this->searchtindakankeyword . '%')->get();

        $data = [
            'tindakansearchresult' => $tindakansearchresult,
        ];

        return view('livewire.search-tindakan', $data);
    }
}
