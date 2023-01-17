<div class="form-body">
    <div class="row">
        <div class="col-md-4">
            <label>Nama Produsen</label>
        </div>
        <div class="col-12 form-group">
            <input type="text" id="nama_produsen" class="form-control" name="nama_produsen" value="">
        </div>
        <div class="col-md-4">
            <label>Catatan</label>
        </div>
        <div class="col-12 form-group">
            <textarea class="form-control ckeditor" name="catatan" id="catatan" cols="30" rows="10"></textarea>
        </div>
        <div class="col-sm-12 d-flex justify-content-end">
            <button type="button" class="btn btn-light-secondary me-1 mb-1" wire:click="setMenu('index')">Cancel</button>
            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
        </div>
    </div>
</div>
