<div class="tab" id="step-3" style="height: 100%;display: flex;flex-direction: column;">

    <style>
        .save-status i {
            position: absolute;
            top: 15px;
            font-size: 6px;
            right: -4px;
        }

        .nav-tabs .nav-link {
            position: relative;
        }
    </style>

    <h4 class="card-title">Detail Kunjungan</h4>
    <div class="info-pasien">
        <i class="bi bi-person-vcard-fill" style="opacity: 0.1;
        position: absolute;
        z-index: 0;
        font-size: 10rem;
        left: -11px;
        top: -52px;"></i>
        <?php
            if (isset($dataPasien['id'])) {
                $findJenisPatientId = App\Models\JenisPatient::where('id', $dataPasien['jenis_pasien_id'])->first();
                echo '<span class="badge bg-success" style="float: right; background-color: '.$findJenisPatientId->color_code.'; margin-left: 0.5rem;">'.$findJenisPatientId->nama_jenis_pasien.'</span>';
            } else {
                echo '<span class="badge bg-secondary" style="float: right; margin-left: 0.5rem;">Bukan Member</span>';
            }
        ?>
        <?= $dataPasien['risiko_jatuh'] ? '<span class="badge bg-danger" style="float: right;">Risiko Jatuh</span>' : '' ?>
        <h5 style="font-weight: 400; margin: 0;">{{ $dataPasien['patient_name'] }} <span><?= $dataPasien['jenis_kelamin'] == 'Laki-laki' ? '<i class="bi bi-gender-male"></i>' : '<i class="bi bi-gender-female"></i>' ?></span></h5>
        <p class="m-0" style="font-size: 11px;">{{$dataPasien['patient_birth_place_name']}}/{{ $dataPasien['patient_birth_date']  }}</p>
        <p class="m-0" style="font-size: 11px;">{{ $dataPasien['patient_address'] }}</p>
    </div>
    <div wire:ignore style="height: 100%;">
        <ul class="nav nav-tabs" id="tab" role="tablist" aria-orientation="vertical" style="margin-bottom: 13px;">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="tab-rekammedis-tab" data-bs-toggle="pill" href="#tab-rekammedis"
                    role="tab" aria-controls="tab-rekammedis" aria-selected="true">Rekam Medis</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-layanan-tab" data-bs-toggle="pill" href="#tab-layanan"
                    role="tab" aria-controls="tab-layanan" aria-selected="false" tabindex="-1">Layanan <span class="save-status"></span></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-eresep-tab" data-bs-toggle="pill" href="#tab-eresep"
                    role="tab" aria-controls="tab-eresep" aria-selected="false"
                    tabindex="-1">E-Resep <span class="save-status"></span></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-konsul-tab" data-bs-toggle="pill" href="#tab-konsul"
                    role="tab" aria-controls="tab-konsul" aria-selected="false"
                    tabindex="-1">Konsul <span class="save-status"></span></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-rujukankeluar-tab" data-bs-toggle="pill" href="#tab-rujukankeluar"
                    role="tab" aria-controls="tab-rujukankeluar" aria-selected="false"
                    tabindex="-1">Rujukan Keluar <span class="save-status"></span></a>
            </li>
        </ul>
        <div class="tab-content" id="tab-tabContent" style="height: 90%;">
            <div style="height:100%;" class="tab-pane fade active show" id="tab-rekammedis" role="tabpanel"
                aria-labelledby="tab-rekammedis-tab">
                @include('livewire.formworkmode.layanan.rekam-medis')
            </div>
            <div style="height:100%;" class="tab-pane fade" id="tab-layanan" role="tabpanel"
                aria-labelledby="tab-layanan-tab">
                @include('livewire.formworkmode.layanan.tindakan')
            </div>
            <div style="height:100%;" class="tab-pane fade" id="tab-eresep" role="tabpanel"
                aria-labelledby="tab-eresep-tab">
                @include('livewire.formworkmode.layanan.e-resep')
            </div>
            <div style="height:100%;" class="tab-pane fade" id="tab-konsul" role="tabpanel"
                aria-labelledby="tab-konsul-tab">
                @include('livewire.formworkmode.layanan.konsul')
            </div>
            <div style="height:100%;" class="tab-pane fade" id="tab-rujukankeluar" role="tabpanel"
                aria-labelledby="tab-rujukankeluar-tab">
                @include('livewire.formworkmode.layanan.rujukan-keluar')
            </div>
        </div>
    </div>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

    </script>
</div>
