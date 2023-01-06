<div style="height: 100%; display: flex; gap: 15px;">
    <div style="width: 25%;height: 100%;display: flex;flex-direction: column;">
        <div class="d-flex" style="justify-content: space-between">
            <div class="input-group input-group-sm" style="width: 49%;">
                <input type="text" class="form-control" placeholder="Berat" aria-label="Berat Badan" aria-describedby="input-bb">
                <span class="input-group-text" id="input-bb">KG</span>
            </div>
            <div class="input-group input-group-sm" style="width: 49%;">
                <input type="text" class="form-control" placeholder="Tinggi" aria-label="Berat Badan" aria-describedby="input-bb">
                <span class="input-group-text" id="input-bb">CM</span>
            </div>
        </div>
        <div class="form-group mt-2">
            <label for="alergi-vertical">Alergi Obat</label>
            <input type="text" id="alergi-vertical" class="form-control form-control-sm" name="alergi_obat">
        </div>
        <div class="form-group mt-2">
            <label for="fungsi_ginjal-vertical">Ganguan Fungsi Ginjal?</label>
            <select class="form-select form-control-sm" id="fungsi_ginjal-vertical" name="ganguan_fungsi_ginjal">
                <option value="0">Tidak</option>
                <option value="1">Ya</option>
            </select>
        </div>
        <div class="form-group">
            <div class="form-check form-check-sm">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input form-check-primary form-check-glow" checked="" name="puasa" id="pasienBerpuasa" style="transform: scale(0.7) translate(4px, -5px);">
                    <label class="form-check-label" for="pasienBerpuasa">Puasa?</label>
                </div>
            </div>
        </div>
        <div class="receipt-preview" style="height: 100%;border: 1px gray dashed;">
            <p>Tinjau Resep</p>

        </div>
    </div>
    <div style="width: 75%; height:100%; display: flex; flex-direction: column;">
        <livewire:search-obat />
        <ul style="height: 100%; list-style: none; padding: 0;overflow-y: scroll;" class="list-obat-untuk-pasien cool-scroll">
            <li style="text-align: center; color: gray; width: 80%;margin: auto;">
                <i class="bi bi-capsule" style="font-size: 20px; margin-top: 3rem;"></i><br>
                Pilih obat untuk pasien dengan mengetik nama obat di kolom pencarian terlebih dahulu lalu pilih
            </li>
        </ul>
        <button type="button" class="btn btn-primary">Simpan</button>
    </div>

    <script>

        $(document).ready(function() {
            $(document).on('click','.btn-setobatnya', function() {

                var obat_id = $(this).data('idobat');
                var nama_obat = $(this).data('namaobat');
                var harga = $(this).data('hargaobat');
                var satuan_obat = $(this).data('satuanobat');

                $(this).attr('disabled', true).text('Telah ditambahkan');

                var str = `
                    <li class="obat-item-pasien garis-pemisah-custom" style="width: 100%;display: flex;flex-direction: row;justify-content: space-between;padding: 13px 5px;" data-obat_id="${obat_id}">
                        <div>
                            <h5 style="font-size: 15px;">${nama_obat}</h5>
                            <input type="text" class="form-control form-control-sm" name="aturan_pakai" placeholder="Input dosis/aturan pakai">
                        </div>
                        <div>
                            <h5 style="font-size: 15px; font-weight: 500; text-align: right;">Rp. ${harga}/${satuan_obat}</h5>
                            <div class="form-group has-icon-right" style="transform: scale(0.7);width: 97px;margin: 0;float: right;">
                                <div style="position: relative;">
                                    <input type="text" class="form-control" placeholder="Jumlah" style="text-align: right;padding-right: 27px;">
                                    <div class="form-control-icon" style="padding-left: 0px;padding-right: 5px;">
                                        <i class="bi bi-x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                `

                if ($('.list-obat-untuk-pasien').find('.obat-item-pasien').length <= 0) {
                    $('.list-obat-untuk-pasien').html(str);
                } else {
                    // check if obat is in the list
                    var isObatInList = false;
                    $('.list-obat-untuk-pasien').find('.obat-item-pasien').each(function() {
                        if ($(this).data('obat_id') == obat_id) {
                            isObatInList = true;
                        }
                    })

                    if (!isObatInList) {
                        $('.list-obat-untuk-pasien').append(str);
                    }
                }
            })

            $(document).on('click', '.btn-hapus-obat', function() {
                $(this).parent().parent().remove();

                if ($('.list-obat-untuk-pasien').find('.obat-item-pasien').length == 0) {
                    $('.list-obat-untuk-pasien').append(`<li style="text-align: center; color: gray; width: 80%;margin: auto;">
                        <i class="bi bi-capsule" style="font-size: 20px; margin-top: 3rem;"></i><br>
                        Pilih obat untuk pasien dengan mengetik nama obat di kolom pencarian terlebih dahulu lalu pilih
                    </li>`)
                }
            })

            $.contextMenu({
                selector: '.obat-item-pasien',
                callback: function(key, options) {
                    var m = "clicked: " + key;
                    window.console && console.log(m) || alert(m);
                },
                items: {
                    "delete": {
                        name: "Delete",
                        icon: "delete",
                        callback: function(key, options) {
                            $(this).remove();
                        }
                    },
                }
            });
        })

    </script>
</div>
