<div class="tab card" id="step-2" style="height: 85%;">
    <style>
        .btn-edit {
            display: none;
        }
        .table-editable tbody tr:hover .btn-edit {
            display: inline-block;
            margin: 0;
            padding: 0 7px;
            font-size: 12px;
            color: gray;
        }
    </style>
    <div class="card-header">
        <h4 class="card-title">Identitas Pasien</h4>
    </div>
    <div class="form form-vertical">
        @if($isMember == 1)
            <div class="form-body">
                <div class="row">
                    <div class="col-12">
                        <livewire:search-patient />
                        @if($dataPasien != null)
                            <div class="patient-detail">
                                <table class="table table-editable" style="margin-top: 2rem;">
                                    <form class="form-pasien-edit" wire:submit.prevent="savePatientData">
                                        <input type="hidden" name="id" value="{{ $dataPasien['id'] }}">
                                        <tbody>
                                            <tr class="item-info">
                                                <td style="font-weight: bold; width: 130px;">Nama</td>
                                                <td style="width: 1px;">:</td>
                                                <td style="display: flex;">
                                                    <livewire:input-live
                                                        property_name="patient_name"
                                                        value="{{ $dataPasien['patient_name'] }}"
                                                        type_input="text"
                                                        key="1"
                                                    />
                                                </td>
                                            </tr>
                                            <tr class="item-info">
                                                <td style="font-weight: bold; width: 130px;">Jenis Kelamin</td>
                                                <td style="width: 1px;">:</td>
                                                <td style="display: flex;">
                                                   <livewire:input-live
                                                        property_name="jenis_kelamin"
                                                        value="{{ $dataPasien['jenis_kelamin'] }}"
                                                        type_input="select"
                                                        options="Laki-laki|Perempuan"
                                                        key="2"
                                                    />
                                                </td>
                                            </tr>
                                            <tr class="item-info">
                                                <td style="font-weight: bold; width: 130px;">Alamat</td>
                                                <td style="width: 1px;">:</td>
                                                <td style="display: flex;">
                                                    <livewire:input-live
                                                        property_name="patient_address"
                                                        value="{{ $dataPasien['patient_address'] }}"
                                                        type_input="text"
                                                        key="3"
                                                    />
                                                </td>
                                            </tr>
                                            <tr class="item-info">
                                                <td style="font-weight: bold; width: 130px;">No. Telp</td>
                                                <td style="width: 1px;">:</td>
                                                <td style="display: flex;">
                                                    <livewire:input-live
                                                        property_name="patient_phone"
                                                        value="{{ $dataPasien['patient_phone'] }}"
                                                        type_input="text"
                                                        key="4"
                                                    />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="form-body">
                <div class="row">
                    <div class="col-6">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nama-pasien">Nama Pasien</label>
                                <input wire:model.debounce.800ms="dataPasien.patient_name" type="text" id="nama-pasien" class="form-control" name="nama_pasien" autocomplete="off" placeholder="Misalnya: John Doe">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nama-pasien">Jenis Kelamin</label>
                                <select wire:model.debounce.800ms="dataPasien.jenis_kelamin" type="text" id="jenis-kelamin" class="form-control" name="jenis_kelamin" autocomplete="off" placeholder="Misalnya: John Doe">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <div class="checkbox">
                                    <input wire:model.debounce.800ms="dataPasien.risiko_jatuh" type="checkbox" id="risiko-jatuh" class="form-check-input" checked="" name="risiko_jatuh">
                                    <label for="risiko-jatuh">Risiko Jatuh</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea wire:model.debounce.800ms="dataPasien.patient_address" id="alamat" rows="3" class="form-control" name="alamat" placeholder="Alamat" autocomplete="off"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nomor-telpon">Nomor Telepon</label>
                                <input wire:model.debounce.800ms="dataPasien.patient_phone" type="number" id="nomor-telpon" class="form-control" name="nomor_telpon" placeholder="08xxxxxxxx" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
