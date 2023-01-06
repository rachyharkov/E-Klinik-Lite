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
        $listobatuntukpasien = null;

        if (count($this->obatuntukpasien) > 0) {
            $listobatuntukpasien = Obat::with([
                'stok_obats',
                'produsens',
                'kategori_obats',
                'satuan_obats',
                'jenis_penggunaan_obats',
                'merek_obats',
                'harga_obats' => function ($query) {
                    $query->where('harga_obats.id_jenis_pasien', 1); // 1 = non-member
                }
            ])->whereIn('id', $this->obatuntukpasien)->get();
        }

        $data = [
            'listobatuntukpasien' => $listobatuntukpasien
        ];

        // dd($data);

        return view('livewire.layanan-e-resep', $data);
    }

    public function setObatUntukPasien($id)
    {
        if (in_array($id, $this->obatuntukpasien)) {
            $this->obatuntukpasien = array_diff($this->obatuntukpasien, [$id]);

        } else {
            array_push($this->obatuntukpasien, $id);
        }

        $this->emitTo('search-obat', 'listObatuntukPasien', $this->obatuntukpasien);
    }

    public function hapusObat($id)
    {
        $this->obatuntukpasien = array_diff($this->obatuntukpasien, [$id]);
        $this->emitTo('search-obat', 'listObatuntukPasien', $this->obatuntukpasien);
        $this->dispatchBrowserEvent('status-hapus-obat', ['statusnya' => 'selesai']);
    }
}
