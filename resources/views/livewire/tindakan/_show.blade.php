<div>
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: 20% 20% 20% 20% 20%;
        }
        .grid-container .grid-item {
            text-align: center;
            font-size: 30px;
            padding: 8px;
            width: 100%;
        }

        .grid-container .grid-item .btn {
            width: 100%;
            height: 120px;
        }
    </style>
    <div class="row">
        <div class="col-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab"
                    aria-controls="v-pills-home" aria-selected="true">Informasi</a>
                <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile"
                    role="tab" aria-controls="v-pills-profile" aria-selected="false" tabindex="-1">Tarif</a>
                <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-messages"
                    role="tab" aria-controls="v-pills-messages" aria-selected="false" tabindex="-1">Statistik</a>
                <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-settings"
                    role="tab" aria-controls="v-pills-settings" aria-selected="false" tabindex="-1">Lainnya</a>
                <a class="nav-link text-danger" id="v-pills-exit-tab" wire:click.prevent="setMenu('index')" role="tab" style="cursor: pointer;">Kembali</a>
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel"
                    aria-labelledby="v-pills-home-tab">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Nama Tindakan</td>
                                <td>:</td>
                                <td>
                                    {{ $nama_tindakan }}
                                </td>
                            </tr>
                            <tr>
                                <td>Kategori Tindakan</td>
                                <td>:</td>
                                <td>{{ $id_kategori_tindakan }}</td>
                            </tr>
                            <tr>
                                <td>Tarif</td>
                                <td>:</td>
                                <td>{{ $tarif }}</td>
                            </tr>
                            <tr>
                                <td>Is Active</td>
                                <td>:</td>
                                <td>{{ $is_active }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div style="height: 300px; text-align: center;">
                        <i class="bi bi-wrench-adjustable" style="font-size: 7rem;"></i>
                        <h3>Sedang dalam Tahap Pengembangan</h3>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <div style="height: 300px; text-align: center;">
                        <i class="bi bi-wrench-adjustable" style="font-size: 7rem;"></i>
                        <h3>Sedang dalam Tahap Pengembangan</h3>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <div class="grid-container">
                        <div class="grid-item">
                            <button class="btn btn-outline-secondary" style="display: flex;flex-direction: column;justify-content: center;" wire:click="setMenu('edit',{{ $tindakan_id }})">
                                <i class="bi bi-pencil-square" style="height: 70%;font-size: 45px;width: 100%;"></i>
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
