<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <h4 style="padding: 1rem 0;">Identitas Pasien</h4>
            <div class="col-md-4">
                <label>Nama Pasien</label>
            </div>
            <div class="col-12 form-group">
                <input type="text" id="patient-name" class="form-control" wire:model.defer="patient_name" name="patient_name">
            </div>
            <div class="col-md-4">
                <label>Jenis Kelamin</label>
            </div>
            <div class="col-12 form-group">
                <select class="form-select" id="jenis-kelamin" wire:model.defer="jenis_kelamin" name="jenis_kelamin">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Tempat Tanggal Lahir</label>
            </div>
            <div class="col-12 form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" id="tempat-lahir" class="form-control" wire:model.defer="patient_birth_place" name="patient_birth_place">
                    </div>
                    <div class="col-md-6">
                        <input type="date" id="tanggal-lahir" class="form-control" wire:model.defer="patient_birth_date" name="patient_birth_date">
                    </div>
                </div>
            </div>
            <div class="col-12 form-group">
                <div class="form-check">
                    <div class="checkbox">
                        <input type="checkbox" id="risiko-jatuh" class="form-check-input" checked="" wire:model.defer="risiko_jatuh" name="risiko_jatuh">
                        <label for="risiko-jatuh">Risiko Jatuh</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label>Status Pasien</label>
            </div>
            <div class="col-12 form-group">
                @foreach ($jenis_pasien_list as $jp)
                {{-- create radio --}}
                    <div class="form-check">
                        <input class="form-check-input" type="radio" wire:model.defer="jenis_pasien_id" name="jenis_pasien_id" id="jenis-pasien-{{ $jp->id }}"
                            value="{{ $jp->id }}">
                        <label class="form-check-label" for="jenis-pasien-{{ $jp->id }}">
                            {{ $jp->nama_jenis_pasien }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <h4 style="padding: 1rem 0;">Kontak Pasien</h4>
            <div class="col-md-4">
                <label>Alamat</label>
            </div>
            <div class="col-12 form-group">
                <textarea class="form-control" id="patient_address" wire:model.defer="patient_address" name="patient_address" rows="3"></textarea>
            </div>
            <div class="col-md-4">
                <label>No. Telepon</label>
            </div>
            <div class="col-12 form-group">
                <input type="text" id="no-telp" class="form-control" wire:model.defer="patient_phone" name="patient_phone">
            </div>
        </div>
        <div class="col-sm-12 d-flex justify-content-end">
            <button type="button" class="btn btn-light-secondary me-1 mb-1" wire:click="setMenu('index')">Cancel</button>
            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
        </div>
    </div>
</div>
