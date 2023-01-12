<div class="tab" id="step-4" style="height: 100%;">
    <h4 class="card-title">Final</h4>

    <div class="btn-group me-1 mb-2">
        <div class="dropdown" style="margin-right: 0.5rem;">
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Cetak
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Semua</a>
                <a class="dropdown-item" href="#">Resep Obat</a>
                <a class="dropdown-item" href="#">Kwitansi</a>
                <a class="dropdown-item" href="#">Invoice</a>
            </div>
        </div>
        <div class="dropdown">
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Buat Surat
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Keterangan Sehat</a>
                <a class="dropdown-item" href="#">Keterangan Sakit</a>
                <a class="dropdown-item" href="#">Cuti</a>
                <a class="dropdown-item" href="#">Rujukan</a>
                <a class="dropdown-item" href="#">Persetujuan Tindakan</a>
                <a class="dropdown-item" href="#">Bebas Narkoba</a>
                <a class="dropdown-item" href="#">Bebas Buta Warna</a>
                <a class="dropdown-item" href="#">Bebas Covid-19</a>
            </div>
        </div>
    </div>

    <?php

    isset($dataLayananAtauTindakan) ? $dataLayananAtauTindakan : ($dataLayananAtauTindakan = []);
    isset($dataObatdanResep) ? $dataObatdanResep : ($dataObatdanResep = []);

    $totalTagihan = 0;
    if (count($dataLayananAtauTindakan) > 0) {
        foreach ($dataLayananAtauTindakan as $key => $value) {
            $totalTagihan += $value['tarif'];
        }
    }

    if (count($dataObatdanResep) > 0) {
        foreach ($dataObatdanResep['obat'] as $key => $value) {
            $subtotal = $value['harga_obats'][0]['harga'] * $value['jumlah'];
            $totalTagihan += $subtotal;
        }
    }
    ?>

    <div class="row">
        <div class="col-6">
            <table style="font-size: 11px;">
                <tr>
                    <td colspan="3">
                        <h4>Identitas Pasien</h4>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%; font-weight: bold;">Nama Pasien</td>
                    <td style="width: 1px;">:</td>
                    <td>{{ $dataPasien['patient_name'] }}
                        <?= $dataPasien['risiko_jatuh'] ? '<span class="badge bg-danger">Risiko Jatuh</span>' : '' ?>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{ App\Models\Regency::find($dataPasien['patient_birth_place'])->first()->name }}/
                        {{ $dataPasien['patient_birth_date'] }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $dataPasien['jenis_kelamin'] }}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; font-weight: bold;">Alamat</td>
                    <td style="vertical-align: top;">:</td>
                    <td>{{ $dataPasien['patient_address'] }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">No. Telp</td>
                    <td>:</td>
                    <td>{{ $dataPasien['patient_phone'] }}</td>
                </tr>
            </table>
        </div>
        <div class="col-6" style="text-align: right">
            <h5>Total Tagihan</h5>
            <h2 style="font-weight: 3rem;">{{ numberToIDR($totalTagihan) }}</h2>
            <p style="font-style: italic; font-size: 11px;"><b>Terbilang:</b> {{ terbilangInRupiah($totalTagihan) }}</p>
        </div>
    </div>
    <div class="table-responsive" style="margin-top: 16px;height: 43vh;">
        <table class="table">
            <thead style="position: sticky;
            top: 0;
            background: #b9b9b9;
            color: black;">
                <tr>
                    <td>No.</td>
                    <td>Jenis Pelayanan</td>
                    <td>Rincian</td>
                    <td>Tanggal Pelayanan</td>
                    <td>Qty</td>
                    <td>Tarif/Harga(Rp)</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                $no = 1;

                if (count($dataLayananAtauTindakan) > 0) {
                    foreach ($dataLayananAtauTindakan as $key => $value) {
                        $total += $value['tarif'];

                        echo '<tr>';
                        echo '<td>' . $no++ . '</td>';
                        echo '<td>Tindakan</td>';
                        echo '<td>' . $value['nama_tindakan'] . '</td>';
                        echo '<td>' . date('Y-m-d') . '</td>';
                        echo '<td>1</td>';
                        echo '<td>Rp.' . $value['tarif'] . '</td>';
                        echo '<td>Rp.' . $value['tarif'] . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
                <?php
                $total = 0;

                if (count($dataObatdanResep) > 0) {
                    foreach ($dataObatdanResep['obat'] as $key => $value) {
                        $subtotal = $value['harga_obats'][0]['harga'] * $value['jumlah'];
                        $total += $subtotal;

                        echo '<tr>';
                        echo '<td>' . $no++ . '</td>';
                        echo '<td>Obat</td>';
                        echo '<td>' . $value['nama_obat'] . '</td>';
                        echo '<td>' . date('Y-m-d') . '</td>';
                        echo '<td>' . $value['jumlah'] . '</td>';
                        echo '<td>Rp.' . $value['harga_obats'][0]['harga'] . '</td>';
                        echo '<td>Rp.' . $subtotal . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
                <tr>
                    <td>{{ $no }}</td>
                    <td>Konsultasi</td>
                    <td>Konsultasi Umum <span><button type="button" class="btn btn-sm btn-outline-success"
                                data-bs-toggle="modal" data-bs-target="#exampleModalScrollable"><i
                                    class="bi bi-eye"></i></button></span></td>
                    <td>{{ date('Y-m-d') }}</td>
                    <td>1</td>
                    <td>UNDEFINED</td>
                    <td>UNDEFINED</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                        Catatan Konsul/Kunjungan
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="preview_konsul"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Kembali</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#preview_konsul').html(window.editor.getData())
        })
    </script>
</div>
