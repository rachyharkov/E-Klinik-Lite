<div id="pasien-terlayani-wrapper" class="cool-scroll">
    <button class="btn btn-primary" id="toggle-patient-done-list" type="button"></button>
    <div class="card" style="min-height: 100vh;">
        <div class="card-header d-flex">
            <h4 class="card-title">Pasien Terlayani <br> <p style="font-size: 14px; margin: 0;">{{ date('d F Y') }}</p></h4>
            <button class="btn btn-outline-primary" id="btn-refresh-antrian-list" style="margin-left: auto; transform: scale(0.6);" wire:click="refreshAntrian" wire:loading.remove>
                <i class="bi bi-arrow-clockwise"></i>
            </button>
        </div>
        <div class="card-body" style="overflow-x: scroll;">
            <table class="table mb-0">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th colspan="2">Detail</th>
                </tr>
                @php
                    $arrayjeniskelamindancolor = [
                        'Laki-laki' => '#0d6efd',
                        'Perempuan' => '#d63384',
                    ];
                    $i = 1;
                @endphp
                @foreach ($antrianList as $al)
                    <tr style="font-size: 13px;" class="{{ $i == 1 ? 'slide-to-left' : '' }}">
                        <td>{{ $al->urutan }}</td>
                        <td>{{ $al->patient->patient_name }}</td>
                        <td>
                            @php
                                foreach($arrayjeniskelamindancolor as $key => $jknya) {
                                    if ($key == $al->jenis_kelamin) {
                                        echo '<span class="badge" style="background-color: '.$jknya.';">'.$key.'</span>';
                                    }
                                }
                            @endphp
                        </td>
                        <td>
                            <div class="btn-group mb-1">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" style="
                                        box-shadow: 0 0 0.5rem 0 rgba(0, 0, 0, 0.1);
                                    ">
                                        <a class="dropdown-item" href="#">Profil</a>
                                        <a class="dropdown-item" href="#">Edit Kunjungan</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Cetak Kwitansi</a>
                                        <a class="dropdown-item" href="#">Cetak Resep</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </table>
        </div>
    </div>
</div>
