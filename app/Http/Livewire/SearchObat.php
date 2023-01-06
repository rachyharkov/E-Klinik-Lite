<?php

namespace App\Http\Livewire;

use App\Models\HargaObat;
use App\Models\Obat;
use Livewire\Component;
use App\Models\Search;

class SearchObat extends Component
{
    public $term = '';

    public function render()
    {
        sleep(1);

        $obatsearchresult = null;

        if($this->term != '') {
            // if $term text is more than 3 characters
            if(strlen($this->term) > 3) {
                $obatsearchresult = Obat::with([
                    'stok_obats',
                    'produsens',
                    'kategori_obats',
                    'satuan_obats',
                    'jenis_penggunaan_obats',
                    'merek_obats',
                    'harga_obats' => function($query) {
                        $query->join('jenis_patients', 'jenis_patients.id', '=', 'harga_obats.id_jenis_pasien')
                            ->select('harga_obats.*', 'jenis_patients.nama_jenis_pasien')->where('id_jenis_pasien', 1); // 1 = non-member
                    }
                ])->where('nama_obat', 'like', '%' . $this->term . '%')->get();
            }
        }

        $this->dispatchBrowserEvent('detectObatYangUdahDitambah', [
            'statusnya' => 'ayyy'
        ]);

        $data = [
            'obatsearchresult' => $obatsearchresult
        ];

        return view('livewire.search-obat', $data);
    }
}
