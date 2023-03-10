<div class="form-body">
    <input type="hidden" wire:model="id_tindakan" name="id_tindakan">
    <div class="row">
            <div class="col-md-4">
                <label>Nama Produsen</label>
            </div>
            <div class="col-12 form-group">
                <input type="text" id="nama_produsen" class="form-control" name="nama_produsen" wire:model.defer="nama_produsen">
            </div>
            <div class="col-md-4">
                <label>Catatan</label>
            </div>
            <div class="col-12 form-group">
                <textarea class="form-control ckeditor" name="catatan" id="catatan" cols="30" rows="10">{{ html_entity_decode($catatan) }}</textarea>
            </div>
        <div class="col-sm-12 d-flex justify-content-end">
            <button type="button" class="btn btn-light-secondary me-1 mb-1" wire:click="setMenu('index')">Cancel</button>
            <button type="button" class="btn btn-light-secondary me-1 mb-1 btn-restore">Reset</button>
            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
        </div>
    </div>
</div>
