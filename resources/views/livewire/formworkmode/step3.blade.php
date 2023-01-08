<div class="tab" id="step-3" style="height: 100%;">

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
    <div class="tab-content" id="tab-tabContent" style="height: 65vh;">
        <div style="height:100%;" class="tab-pane fade active show" id="tab-rekammedis" role="tabpanel"
            aria-labelledby="tab-rekammedis-tab">
            <p style="text-align: center;"><i class="bi bi-calendar2-check-fill" style="font-size: 88px;"></i> <br> Tidak ada Data Rekam Medis pada Pasien Ini {{ inDevelopmentIndicator() }}</p>
        </div>
        <div style="height:100%;" class="tab-pane fade" id="tab-layanan" role="tabpanel"
            aria-labelledby="tab-layanan-tab">
            <livewire:layanan-tindakan/>
        </div>
        <div style="height:100%;" class="tab-pane fade" id="tab-eresep" role="tabpanel"
            aria-labelledby="tab-eresep-tab">
            <livewire:layanan-e-resep/>
        </div>
        <div style="height:100%;" class="tab-pane fade" id="tab-konsul" role="tabpanel"
            aria-labelledby="tab-konsul-tab">
            <livewire:layanan-konsul/>
        </div>
        <div style="height:100%;" class="tab-pane fade" id="tab-rujukankeluar" role="tabpanel"
            aria-labelledby="tab-rujukankeluar-tab">
            <p style="text-align: center;"><i class="bi bi-calendar2-check-fill" style="font-size: 88px;"></i> <br> Sedang dalam tahap pengembangan {{ inDevelopmentIndicator() }}</p>
        </div>
    </div>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

    </script>
</div>
