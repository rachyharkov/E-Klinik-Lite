<?php

namespace App\Http\Livewire;

use App\Models\JenisPatient;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CrudJenisPasien extends Component
{

    public $titlenya = 'Jenis Pasien';

    public $data_counter = null;

    public function mount() {
        $this->get_newest_count();
    }

    public function render()
    {
        return view('livewire.crud-jenis-pasien');
    }

    public function get_newest_count() {
        $jenisPasien = JenisPatient::all();

        $data_count = [];

        foreach($jenisPasien as $key => $value) {
            $jenis_pasien_id = $value->id;
            $nama_jenis_pasien = $value->nama_jenis_pasien;
            $color = $value->color_code;

            $jumlahPasien = null;
            if($jenis_pasien_id == 1) {
                $jumlahPasien = DB::table('patient_temps')->count();
            } else {
                $jumlahPasien = DB::table('patients')
                    ->where('jenis_pasien_id', $jenis_pasien_id)
                    ->count();
            }

            $dataObat = DB::table('allowed_supplies')
                ->where('jenis_pasien_id', $jenis_pasien_id)
                ->where('kategori_supply', 'obat')
                ->count();

            $dataTindakan = DB::table('allowed_supplies')
                ->where('jenis_pasien_id', $jenis_pasien_id)
                ->where('kategori_supply', 'tindakan')
                ->count();


            $data_count[] = [
                'nama_jenis_pasien' => $nama_jenis_pasien,
                'jumlah_obat' => $dataObat,
                'jumlah_tindakan' => $dataTindakan,
                'jumlah_pasien' => $jumlahPasien,
                'color' => $color
            ];
        }


        $this->data_counter = $data_count;
    }
}
