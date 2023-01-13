<div class="tab" id="step-4" style="height: 100%;">
    <h4 class="card-title">Final</h4>
    <?php

    $dataPembayaran['totalBiaya'] = 0;
    if (!empty($dataTindakan)) {
        foreach ($dataTindakan as $key => $value) {
            $dataPembayaran['totalBiaya'] += $value['tarif'];
        }
    }

    if (!empty($dataObatdanResep)) {
        foreach ($dataObatdanResep as $key => $value) {
            $subtotal = $value['harga_obats'][0]['harga'] * $value['jumlah'];
            $dataPembayaran['totalBiaya'] += $subtotal;
        }
    }

    $dataPembayaran['totalBiaya'] += $biayaKonsultasi;

    $dataPembayaran['totalBiaya'] -= $dataPembayaran['diskonBiaya'];
    ?>

    <div class="invoice-wrapper" style="max-width: 920px; margin: auto; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; padding: 0 2rem 1rem 2rem; border-top: 12px solid rgb(43, 39, 99); overflow: hidden;">
        <div class="row" style="position: relative;">
            <div class="col-sm-6" style="z-index: 2;">
                <img src="{{ asset('images/logo/logo_accent.svg') }}" alt="logo" style="width: 80px; height: 100px;margin-left: 15px;">
            </div>
            <div class="col-sm-6">
                <div class="row" style="font-size: 12px;">
                    <div class="col-lg-4"><i class="bi bi-envelope-fill"></i><br>eklinik@gmail.com</div>
                    <div class="col-lg-4"><i class="bi bi-envelope-fill"></i><br>eklinik@gmail.com</div>
                    <div class="col-lg-4"><i class="bi bi-envelope-fill"></i><br>eklinik@gmail.com</div>
                </div>
            </div>
            <div class="header-invoice-bg" style="    position: absolute;
            height: 97px;
            width: 300px;
            min-width: 250px;
            -webkit-transform: skewX(-35deg);
            transform: skewX(-35deg);
            top: 0px;
            left: -100px;
            border-color: rgba(0, 122, 255, 0.2);
            background-color: rgba(0, 122, 255, 0.1);
            border: 1px solid #dbdfea;
                ">
            </div>
        </div>
        <h1 style="width: 100%; margin-top: 1.25rem; font-weight: 200;">Ringkasan Kunjungan</h1>
        <div class="row mt-3">
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
            <div class="col-6" style="text-align: right;position: relative;">
                <h5>Biaya Akhir</h5>
                <h2 style="z-index: 2;">{{ numberToIDR($dataPembayaran['totalBiaya']) }}</h2>
                <p style="font-style: italic; font-size: 11px;"><b>Terbilang:</b> {{ terbilangInRupiahWithCurrency($dataPembayaran['totalBiaya']) }}</p>
                <div class="header-invoice-bg" style="position: absolute;
                height: 51px;
                width: 100%;
                min-width: 250px;
                -webkit-transform: skewX(-35deg);
                transform: skewX(-35deg);
                top: 24px;
                right: -62px;
                border-color: rgba(0, 122, 255, 0.2);
                background-color: rgba(0, 122, 255, 0.1);
                border: 1px solid #dbdfea;">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">

                <table style="font-size: 11px; margin-top: 1rem;">
                    <tr>
                        <td colspan="3">
                            <h4>Keadaan Pasien</h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 30%; font-weight: bold;">Berat Badan</td>
                        <td style="width: 1px;">:</td>
                        <td>{{ $dataKeadaanPasien['berat_badan'] }} Kg</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Tinggi Badan</td>
                        <td>:</td>
                        <td>{{ $dataKeadaanPasien['tinggi_badan'] }} Cm</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Alerti Obat</td>
                        <td>:</td>
                        <td>{{ $dataKeadaanPasien['alergi_obat'] }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Gangguan Fungsi Ginjal</td>
                        <td>:</td>
                        <td>{{ $dataKeadaanPasien['gangguan_fungsi_ginjal'] }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Puasa</td>
                        <td>:</td>
                        <td>{{ $dataKeadaanPasien['puasa'] }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-6">

            </div>
        </div>
        <div class="row">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Jenis Pelayanan</td>
                        <td>Rincian</td>
                        <td>Tanggal</td>
                        <td>Qty</td>
                        <td>Tarif/Harga(Rp)</td>
                        <td style="width: 18%;">Subtotal</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $no = 1;

                    if (!empty($dataTindakan)) {
                        foreach ($dataTindakan as $key => $value) {
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

                    if (!empty($dataObatdanResep)) {
                        foreach ($dataObatdanResep as $key => $value) {
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
                        <td><a href='#' data-bs-toggle="modal" data-bs-target="#exampleModalScrollable" >Konsultasi Umum</a></td>
                        <td>{{ date('Y-m-d') }}</td>
                        <td>1</td>
                        <td>Rp.{{ $biayaKonsultasi }}</td>
                        <td>Rp.{{ $biayaKonsultasi }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr style="">
                        <td colspan="2" rowspan="5" style="vertical-align: top;">
                            <p>Dibayar oleh <span><input type="text" class="form-control form-control-sm" id="input-dibayar-oleh" aria-describedby="dibayarOleh" wire:model.debounce.600ms="dataPembayaran.dibayarOleh" placeholder="Pasien"></span></p>
                            <select class="form-select form-select-sm" aria-label="Pilih metode pembayaran" wire:model.debounce.600ms="dataPembayaran.metodePembayaran">
                                <option value="">Pilih metode pembayaran</option>
                                <?php
                                    $metodePembayaran = App\Models\MetodePembayaran::all();
                                    foreach ($metodePembayaran as $key => $value) {
                                        echo '<option value="' . $value->id . '">' . $value->nama_metode_pembayaran . '</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        <td colspan="3" rowspan="5" style="position: relative;">
                            @if($dataPembayaran['dibayarPasien'] >= $dataPembayaran['totalBiaya'])
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Pasien melunasi tagihan ini" style="position: absolute;
                                right: 17px;
                                bottom: 0;
                                font-size: 30px;"><i class="bi bi-check-circle-fill text-success" style="margin: auto;"></i></span>
                            @else
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Akan Masuk ke Daftar Tagihan" style="position: absolute;
                                right: 17px;
                                bottom: 0;
                                font-size: 30px;"><i class="bi bi-exclamation-circle-fill text-warning" style="margin: auto;"></i></span>
                            @endif
                        </td>
                        <td style="text-align: right; font-weight: bold;">Total</td>
                        <td style="font-weight: bold;">{{ numberToIDR($dataPembayaran['totalBiaya'] + $dataPembayaran['diskonBiaya']) }}</td>
                    </tr>
                    <tr style="">
                        <td style="text-align: right; font-weight: bold;">Diskon</td>
                        <td>
                            <div class="form-group position-relative has-icon-left m-0">
                                <input type="number" class="form-control input-diskon input-nominal" id="input-diskon"
                                aria-label="Rupiah amount" wire:model.debounce.600ms="dataPembayaran.diskonBiaya" min="0"
                                max="{{ $dataPembayaran['totalBiaya'] }}" required style="padding: 3px 4px 2px 2.5rem;">
                                <div class="form-control-icon">Rp.</div>
                            </div>
                        </td>
                    </tr>
                    <tr style="    background: #435ebe;
                    color: white;
                    font-size: 20px;
                ">
                        <td style="text-align: right; font-weight: bold;">Final Total</td>
                        <td style="font-weight: bold;">{{ numberToIDR($dataPembayaran['totalBiaya']) }}</td>
                        <input type="hidden" id="total-tagihan" value="{{ $dataPembayaran['totalBiaya'] }}">
                    </tr>
                    <tr style="">
                        <td style="text-align: right; font-weight: bold;">Dibayar</td>
                        <td>
                            <div class="form-group position-relative has-icon-left m-0">
                                <input type="number" class="form-control input-dibayar input-nominal" id="input-dibayar"
                                aria-label="Rupiah amount" wire:model.debounce.600ms="dataPembayaran.dibayarPasien" min="0"
                                max="{{ $dataPembayaran['totalBiaya'] }}" required style="padding: 3px 4px 2px 2.5rem;">
                                <div class="form-control-icon">Rp.</div>
                            </div>
                        </td>
                    </tr>
                    <tr style="    background: #435ebe;
                    color: white;
                    font-size: 20px;
                ">
                        <td style="text-align: right; font-weight: bold;">Tagihan</td>
                        <td style="font-weight: bold;">{{ numberToIDR($dataPembayaran['totalBiaya'] - $dataPembayaran['dibayarPasien']) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
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
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        $(document).ready(function() {
            $('#preview_konsul').html(window.editor.getData())

            $(document).on('change keyup paste input','.input-diskon', function(e) {

                if ($(this).val() < 0) {
                    $(this).val(0)
                }

                // do not allowed strin
                if (isNaN($(this).val())) {
                    $(this).val(0)
                }

                // delete leading zero if exist
                if ($(this).val().charAt(0) == 0) {
                    $(this).val($(this).val().substring(1))
                    if ($(this).val() == '') {
                        $(this).val(0)
                    }
                }

                if ($(this).val() > {{ $dataPembayaran['totalBiaya'] + $dataPembayaran['diskonBiaya'] }}) {
                    $(this).val({{ $dataPembayaran['totalBiaya'] + $dataPembayaran['diskonBiaya'] }})
                }
            })

            $(document).on('change keyup paste input','.input-dibayar', function(e) {

                if ($(this).val() < 0) {
                    return
                }

                // do not allowed strin
                if (isNaN($(this).val())) {
                    return
                }

                if ($(this).val() == '') {
                    $(this).val(0)
                }

                // delete leading zero if exist
                if ($(this).val().charAt(0) == 0) {

                    if ($(this).val().length == 1) {
                        $(this).val(0)
                        return
                    }

                    $(this).val($(this).val().substring(1))
                }


                var totalBiaya = parseInt($('#total-tagihan').val())
                var thisVal = parseInt($(this).val())

                if (thisVal > totalBiaya) {
                    $(this).val(totalBiaya)
                }

            })

        })
    </script>
</div>
