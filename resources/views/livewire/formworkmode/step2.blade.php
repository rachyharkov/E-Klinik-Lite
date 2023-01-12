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
                        @if($dataPasien['id'] != null)
                            <div class="patient-detail">
                                <table class="table table-editable" style="margin-top: 2rem;">
                                    <input type="hidden" name="id" value="{{ $dataPasien['id'] }}">
                                    <tbody>
                                        <tr class="item-info">
                                            <td style="font-weight: bold; width: 130px;">Nama</td>
                                            <td style="width: 1px;">:</td>
                                            <td style="display: flex;">
                                                <p class="m-0">{{ $dataPasien['patient_name'] }}</p>
                                            </td>
                                        </tr>
                                        <tr class="item-info">
                                            <td style="font-weight: bold; width: 130px;">Tempat Lahir</td>
                                            <td style="width: 1px;">:</td>
                                            <td style="display: flex;">
                                                <p class="m-0">{{ $dataPasien['patient_birth_place'] }}</p>
                                            </td>
                                        </tr>
                                        <tr class="item-info">
                                            <td style="font-weight: bold; width: 130px;">Tanggal Lahir</td>
                                            <td style="width: 1px;">:</td>
                                            <td style="display: flex;">
                                                <p class="m-0">{{ $dataPasien['patient_birth_date'] }}</p>
                                            </td>
                                        </tr>
                                        <tr class="item-info">
                                            <td style="font-weight: bold; width: 130px;">Jenis Kelamin</td>
                                            <td style="width: 1px;">:</td>
                                            <td style="display: flex;">
                                                <p class="m-0">{{ $dataPasien['jenis_kelamin'] }}</p>
                                            </td>
                                        </tr>
                                        <tr class="item-info">
                                            <td style="font-weight: bold; width: 130px;">Alamat</td>
                                            <td style="width: 1px;">:</td>
                                            <td style="display: flex;">
                                                <p class="m-0">{{ $dataPasien['patient_address'] }}</p>
                                            </td>
                                        </tr>
                                        <tr class="item-info">
                                            <td style="font-weight: bold; width: 130px;">No. Telp</td>
                                            <td style="width: 1px;">:</td>
                                            <td style="display: flex;">
                                                <p class="m-0">{{ $dataPasien['patient_phone'] }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td>
                                                <div class="form-check">
                                                    <div class="checkbox">
                                                        <input wire:model.debounce.800ms="dataPasien.risiko_jatuh" type="checkbox" id="risiko-jatuh" class="form-check-input" checked="" name="risiko_jatuh">
                                                        <label for="risiko-jatuh">Risiko Jatuh</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="form-body">
                <div class="row" wire:ignore>
                    <div class="col-6">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nama-pasien">Nama Pasien</label>
                                <input wire:model.debounce.800ms="dataPasien.patient_name" type="text" id="nama-pasien" class="form-control" name="nama_pasien" autocomplete="off" placeholder="Misalnya: John Doe">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <label for="patient-birth-place">Tempat/Tanggal Lahir</label>
                                <div class="col-8">
                                    <div class="form-group">
                                        <select wire:model.debounce.800ms="dataPasien.patient_birth_place" type="text" id="patient-birth-place" class="form-control selectTize" name="patient_birth_place" autocomplete="off" placeholder="Nama Kabupaten/Kota">
                                            @foreach ($listDataDaerah as $dataDaerah)
                                                <option value="{{ $dataDaerah->id }}"
                                                    @php
                                                        if($dataPasien) {
                                                            isset($dataPasien['patient_birth_place']) ? $dataPasien['patient_birth_place'] == $dataDaerah->id ? print 'selected' : '' : '';
                                                        }
                                                    @endphp
                                                    >{{ $dataDaerah->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <input wire:model.debounce.800ms="dataPasien.patient_birth_date" type="date" id="patient-birth-date" class="form-control" name="patient_birth_date" autocomplete="off" placeholder="Tanggal Lahir">
                                </div>
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
                                <textarea wire:model.debounce.800ms="dataPasien.patient_address" id="alamat" rows="4" class="form-control" name="alamat" placeholder="Alamat" autocomplete="off"></textarea>
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
                @if($errors->any())
                    <div class="alert alert-danger mt-2 mb-0">
                        <h5 class="alert-heading">Terjadi Kesalahan</h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <script>
                $(document).ready(function() {
                    $('.selectTize').selectize({
                        sortField: 'text',
                        onChange: function(value) {
                            @this.set('dataPasien.patient_birth_place', value);
                        }
                    });
                });
            </script>
        @endif
    </div>
</div>
