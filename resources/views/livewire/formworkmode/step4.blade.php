<div class="tab" id="step-4" style="height: 100%;">
    <h4 class="card-title">Final</h4>
    <div style="width: 100%; text-align: center;">
        <p style="margin: 0;">Mode View</p>
        <div class="btn-group" style="margin: auto; transform: scale(0.8);">
            <button class="btn btn-secondary" type="button">Simple</button>
            <button class="btn btn-secondary" type="button">One-to-One</button>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <table class="table table-borderless">
                <tr>
                    <td colspan="3"><h4>Identitas Pasien</h4></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Nama Pasien</td>
                    <td style="width: 1px;">:</td>
                    <td>{{ $dataPasien['patient_name'] }} <?= $dataPasien['risiko_jatuh'] ? '<span class="badge bg-danger">Risiko Jatuh</span>' : '' ?></td>
                </tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{ App\Models\Regency::find($dataPasien['patient_birth_place'])->first()->name }}/ {{ $dataPasien['patient_birth_date'] }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $dataPasien['jenis_kelamin'] }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $dataPasien['patient_address'] }}</td>
                </tr>
                <tr>
                    <td>No. Telp</td>
                    <td>:</td>
                    <td>{{ $dataPasien['patient_phone'] }}</td>
                </tr>
            </table>
        </div>
        <div class="col-6">
            <table class="table table-borderless">
                <tr>
                    <td colspan="3"><h4>Keadaan Pasien</h4></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Tinggi Badan</td>
                    <td style="width: 1px;">:</td>
                    <td>{{ $dataObatdanResep['berat_badan'].' kg' }}></td>
                </tr>
                <tr>
                    <td>Tinggi Badan</td>
                    <td>:</td>
                    <td>{{ $dataObatdanResep['tinggi_badan'].' cm' }}</td>
                </tr>
                <tr>
                    <td>Alergi Obat</td>
                    <td>:</td>
                    <td>{{ $dataObatdanResep['alergi_obat'] }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $dataObatdanResep['gangguan_fungsi_ginjal'] }}</td>
                </tr>
                <tr>
                    <td>Puasa</td>
                    <td>:</td>
                    <td>{{ $dataObatdanResep['puasa'] }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-6">

            <h4>Layanan Klinik</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 1px;">No</th>
                        <th>Nama Tindakan</th>
                        <th style="width: 20%;">Tarif</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $total = 0;
                        $no = 1;

                        isset($dataLayananAtauTindakan) ? $dataLayananAtauTindakan : $dataLayananAtauTindakan = [];

                        if (count($dataLayananAtauTindakan) > 0) {
                            foreach ($dataLayananAtauTindakan as $key => $value) {
                                $total += $value['tarif'];

                                echo '<tr>';
                                    echo '<td>' . $no++ . '</td>';
                                    echo '<td>'. $value['nama_tindakan'] . '</td>';
                                    echo '<td>Rp.' . $value['tarif'] . '</td>';
                                echo '</tr>';
                            }
                            echo '<tr style="font-weight: bold;">';
                                    echo '<td colspan="2" class="text-right">Total</td>';
                                    echo '<td>Rp.' . $total . '</td>';
                                echo '</tr>';
                        } else {
                            echo '<tr>';
                                echo '<td colspan="3" class="text-center">Tidak ada data</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-6">

            <h4>Obat & Resep</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 1px;">No</th>
                        <th>Nama Obat</th>
                        <th style="width: 20%;">Jumlah</th>
                        <th style="width: 20%;">Harga</th>
                        <th style="width: 20%;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $total = 0;
                        $no = 1;

                        isset($dataObatdanResep) ? $dataObatdanResep : $dataObatdanResep = [];

                        if (count($dataObatdanResep) > 0) {
                            foreach ($dataObatdanResep['obat'] as $key => $value) {
                                $subtotal = $value['harga_obats'][0]['harga'] * $value['jumlah'];
                                $total += $subtotal;

                                echo '<tr>';
                                    echo '<td>' . $no++ . '</td>';
                                    echo '<td>'. $value['nama_obat'] . '<br><p style="font-size: 11px; margin: 0;">'.$value['aturan_pakai'].'</p></td>';
                                    echo '<td>' . $value['jumlah'] . 'x</td>';
                                    echo '<td>Rp.' . $value['harga_obats'][0]['harga'] . '</td>';
                                    echo '<td>Rp.' . $subtotal . '</td>';
                                echo '</tr>';
                            }
                            echo '<tr style="font-weight: bold;">';
                                    echo '<td colspan="4" class="text-right">Total</td>';
                                    echo '<td>Rp.' . $total . '</td>';

                                echo '</tr>';
                        } else {
                            echo '<tr>';
                                echo '<td colspan="5" class="text-center">Tidak ada data</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h4>Catatan Konsul/Kunjungan</h4>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Detail</td>
                        <td style="width: 20%;">Tarif</td>
                    </tr>
                    <tr>
                        <td><div id="preview_konsul"></div></td>
                        <td>Rp. 30800</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#preview_konsul').html(window.editor.getData())
        })
    </script>
</div>
