<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-4">
                <label>Nama Tindakan</label>
            </div>
            <div class="col-12 form-group">
                <input type="text" id="patient-name" class="form-control" wire:model.defer="nama_tindakan" name="nama_tindakan">
            </div>
            <div class="col-md-4">
                <label>Jenis Tindakan</label>
            </div>
            <div class="col-12 form-group">
                <select wire:model.debounce.800ms="id_kategori_tindakan" type="text" id="id-kategori-tindakan" class="form-control selectTize" name="id_kategori_tindakan" autocomplete="off" placeholder="Kategori Tindakan">
                    @foreach ($kategori_tindakan_list as $kt)
                        <option value="{{ $kt->id }}"
                            @php
                                isset($dataTindakan['id_kategori_tindakan']) ? $dataTindakan['id_kategori_tindakan'] == $kt->id ? print 'selected' : '' : '';
                            @endphp
                            >{{ $kt->nama_kategori_tindakan }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Tarif</label>
            </div>
            <div class="col-12 form-group">
                <div class="form-group position-relative has-icon-left m-0">
                    <input type="number" name="tarif" class="form-control input-nominal" id="input-nominal" aria-label="Rupiah amount" wire:model.defer="tarif" min="0" required style="padding: 3px 4px 2px 2.5rem;">
                    <div class="form-control-icon">Rp.</div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 d-flex justify-content-end">
            <button type="button" class="btn btn-light-secondary me-1 mb-1" wire:click="setMenu('index')">Cancel</button>
            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
        </div>
    </div>
</div>
