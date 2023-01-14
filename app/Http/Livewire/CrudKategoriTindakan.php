<?php

namespace App\Http\Livewire;

use App\Models\KategoriTindakan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CrudKategoriTindakan extends Component
{
    public $titlenya = 'Kategori Tindakan';

    public $data_counter = null;

    public function mount() {
        $this->get_newest_count();
    }

    public function render()
    {
        return view('livewire.crud-kategori-tindakan');
    }

    public function get_newest_count() {
        $kategoriTindakan = KategoriTindakan::all();

        $data_count = [];

        foreach($kategoriTindakan as $key => $value) {
            $kategori_tindakan_id = $value->id;
            $nama_kategori_tindakan = $value->nama_kategori_tindakan;

            $dataTindakan = DB::table('tindakans')
                ->where('id_kategori_tindakan', $kategori_tindakan_id)
                ->count();


            $data_count[] = [
                'nama_kategori_tindakan' => $nama_kategori_tindakan,
                'jumlah' => $dataTindakan,
                'color' => '#f39c12'
            ];
        }

        $this->data_counter = $data_count;
    }
}
