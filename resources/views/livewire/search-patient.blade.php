<div>
    <div class="search-pasien-bar" style="position: relative;">
        <style>
            .search-pasien-results {
                max-height: 40vh;
                overflow-y: scroll;
                box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
                position: absolute;
                width: 100%;
                z-index: 1;
                top: 18px;
                padding-top: 20px;
            }
        </style>
        <div class="input-group" style="z-index: 2;">
            <span class="input-group-text" id="basic-addon1" style="line-height: 0;"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" placeholder="Nomor Telepon atau Nama Pasien" aria-label="Nomor Telepon atau Nama Pasien" aria-describedby="button-addon2" wire:model.debounce.500ms="nama_pasien_yang_dicari">
        </div>
        @if ($nama_pasien_yang_dicari != "")
            <ul class="list-group search-pasien-results cool-scroll">
                <li class="list-group list-group-item pasien-item" wire:loading>
                    <div class="row">
                        <div class="col-12">
                            {{-- progress bar animated--}}
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </li>
                @if($searchPasienResults->isEmpty())
                    <li class="list-group list-group-item pasien-item">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-center">Pasien Tidak Ditemukan</p>
                            </div>
                        </div>
                    </li>
                @else
                    @foreach ($searchPasienResults as $value)
                        <li class="list-group list-group-item pasien-item" style="padding: 0;">
                            <button class="btn w-100" type="button" wire:click="selectPatient({{ $value->id }})">
                                <div class="d-flex">
                                    <div class="gender-indicator" style="margin: 0 15px 0 0 !important;">
                                        @if($value->jenis_kelamin == 'Laki-laki')
                                            <i class="bi bi-gender-male" style="font-size: 22px; color:rgb(65, 65, 197)"></i>
                                        @else
                                            <i class="bi bi-gender-female" style="font-size: 22px; color:rgb(248, 47, 255)"></i>
                                        @endif
                                    </div>
                                    <div class="patient-info-overview d-flex justify-content-between w-100">
                                        <h5 class="nama-pasien" style="font-size: 17px; line-height: 2; margin: 0;">{{ $value->patient_name }}</h5>
                                        <p class="nomor-telpon" style="margin: 0; font-size: 14px; line-height: 2;">{{ $value->patient_phone }}</p>
                                    </div>
                                </div>
                            </button>
                        </li>
                    @endforeach
                @endif
            </ul>
        @endif
    </div>
</div>
