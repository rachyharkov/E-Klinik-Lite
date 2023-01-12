<div style="height: 100%; display: flex; gap: 15px;">
    <div style="width: 25%;height: 100%;display: flex;flex-direction: column;" class="inputan-dummy-form-resep">
        <div class="d-flex" style="justify-content: space-between">
            <div class="input-group input-group-sm" style="width: 49%;">
                <input type="text" class="form-control" placeholder="Berat" aria-label="Berat Badan" aria-describedby="input-bb" onkeyup="$('#bb_pasien').val($(this).val())" value="{{ $dataObatdanResep ? $dataObatdanResep['berat_badan'] : '' }}">
                <span class="input-group-text" id="input-bb">KG</span>
            </div>
            <div class="input-group input-group-sm" style="width: 49%;">
                <input type="text" class="form-control" placeholder="Tinggi" aria-label="Berat Badan" aria-describedby="input-bb" onkeyup="$('#tb_pasien').val($(this).val())" value="{{ $dataObatdanResep ? $dataObatdanResep['tinggi_badan'] : '' }}">
                <span class="input-group-text" id="input-bb">CM</span>
            </div>
        </div>
        <div class="form-group mt-2">
            <label for="alergi-vertical">Alergi Obat</label>
            <input type="text" id="alergi-vertical" class="form-control form-control-sm" name="alergi_obat" value="{{ $dataObatdanResep ? $dataObatdanResep['alergi_obat'] : '' }}" onkeyup="$('#alergi_obat').val($(this).val())">
        </div>
        <div class="form-group mt-2">
            <label for="fungsi_ginjal-vertical">Ganguan Fungsi Ginjal?</label>
            <select class="form-select form-control-sm" id="fungsi_ginjal-vertical" name="gangguan_fungsi_ginjal" onchange="$('#gangguan_fungsi_ginjal').val($(this).val())">
                <option value="0"
                @php
                    if($dataObatdanResep) {
                        if($dataObatdanResep['gangguan_fungsi_ginjal'] == 0) {
                            echo 'selected';
                        }
                    }
                @endphp
                >Tidak</option>
                <option value="1"
                @php
                    if($dataObatdanResep) {
                        if($dataObatdanResep['gangguan_fungsi_ginjal'] == 1) {
                            echo 'selected';
                        }
                    }
                @endphp
                >Ya</option>
            </select>
        </div>
        <div class="form-group">
            <div class="form-check form-check-sm">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input form-check-primary form-check-glow" name="puasa" id="pasienBerpuasa" style="transform: scale(0.7) translate(4px, -5px);" onchange="$('#puasa').val($(this).is(':checked') ? 1 : 0)"
                    @php
                        if($dataObatdanResep) {
                            if($dataObatdanResep['puasa'] == 1) {
                                echo 'checked';
                            }
                        }
                    @endphp
                    >
                    <label class="form-check-label" for="pasienBerpuasa">Puasa?</label>
                </div>
            </div>
        </div>
        <div class="receipt-preview" style="height: 100%;border: 1px gray dashed;">
            <p>Tinjau Resep</p>
        </div>
    </div>
    <div style="width: 75%;
    height: 100%;
    display: flex;
    flex-direction: column;">
        <livewire:search-obat />
        <form id="form-resep" style="display: flex;
        flex-direction: column;
        height: 100%;">
            <input type="hidden" name="bb_pasien" id="bb_pasien" value="{{ $dataObatdanResep ? $dataObatdanResep['berat_badan'] : '' }}">
            <input type="hidden" name="tb_pasien" id="tb_pasien" value="{{ $dataObatdanResep ? $dataObatdanResep['tinggi_badan'] : '' }}">
            <input type="hidden" name="alergi_obat" id="alergi_obat" value="{{ $dataObatdanResep ? $dataObatdanResep['alergi_obat'] : '' }}">
            <input type="hidden" name="gangguan_fungsi_ginjal" id="gangguan_fungsi_ginjal" value="{{ $dataObatdanResep ? $dataObatdanResep['gangguan_fungsi_ginjal'] : '' }}">
            <input type="hidden" name="puasa" id="puasa" value="{{ $dataObatdanResep ? $dataObatdanResep['puasa'] : 0 }}">
            <ul style="height: 34vh;
            list-style: none;
            padding: 0;
            overflow-y: scroll;
            flex: 1 0 auto;" class="list-obat-untuk-pasien cool-scroll">
                @if($dataObatdanResep)
                    @foreach ($dataObatdanResep['obat'] as $key => $item)
                        <li class="obat-item-pasien garis-pemisah-custom" style="width: 100%;display: flex;flex-direction: row;justify-content: space-between;padding: 13px 5px;" data-obat_id="{{ $item['id'] }}">
                            <div>
                                <h5 style="font-size: 15px;">{{ $item['nama_obat'] }}</h5>
                                <input type="text" class="form-control form-control-sm" name="aturan_pakai[]" placeholder="Input dosis/aturan pakai" value="{{ $item['aturan_pakai'] }}">
                                <input type="hidden" class="form-control form-control-sm" name="obat_id[]" value="{{ $item['id'] }}">
                            </div>
                            <div>
                                <h5 style="font-size: 15px; font-weight: 500; text-align: right;">Rp. {{ $item['harga_obats'][0]['harga'] }}/{{ $item['satuan_obats']['nama_satuan_obat'] }}</h5>
                                <div class="form-group has-icon-right" style="transform: scale(0.7);width: 97px;margin: 0;float: right;">
                                    <div style="position: relative;">
                                        <input type="text" class="form-control" name="jumlah[]" placeholder="Jumlah" style="text-align: right;padding-right: 27px;" value="{{ $item['jumlah'] }}">
                                        <div class="form-control-icon" style="padding-left: 0px;padding-right: 5px;">
                                            <i class="bi bi-x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li style="text-align: center; color: gray; width: 80%;margin: auto;">
                        <i class="bi bi-capsule" style="font-size: 20px; margin-top: 3rem;"></i><br>
                        Pilih obat untuk pasien dengan mengetik nama obat di kolom pencarian terlebih dahulu lalu pilih
                    </li>
                @endif
            </ul>
            <button type="submit" class="btn btn-primary" style="height: 8%;">Simpan</button>
        </form>
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
                            <input type="text" class="form-control form-control-sm" name="aturan_pakai[]" placeholder="Input dosis/aturan pakai">
                            <input type="hidden" class="form-control form-control-sm" name="obat_id[]" value="${obat_id}">
                        </div>
                        <div>
                            <h5 style="font-size: 15px; font-weight: 500; text-align: right;">Rp. ${harga}/${satuan_obat}</h5>
                            <div class="form-group has-icon-right" style="transform: scale(0.7);width: 97px;margin: 0;float: right;">
                                <div style="position: relative;">
                                    <input type="text" class="form-control" name="jumlah[]" placeholder="Jumlah" style="text-align: right;padding-right: 27px;">
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
                udahDiSaveApaBelom('belum','tab-eresep-tab')
            })

            $(document).on('click', '.btn-hapus-obat', function() {
                $(this).parent().parent().remove();

                if ($('.list-obat-untuk-pasien').find('.obat-item-pasien').length == 0) {
                    $('.list-obat-untuk-pasien').append(`<li style="text-align: center; color: gray; width: 80%;margin: auto;">
                        <i class="bi bi-capsule" style="font-size: 20px; margin-top: 3rem;"></i><br>
                        Pilih obat untuk pasien dengan mengetik nama obat di kolom pencarian terlebih dahulu lalu pilih
                    </li>`)
                }
                udahDiSaveApaBelom('belum', 'tab-eresep-tab')
            })

            // detect any changes inside form form-resep
            $('#form-resep').on('keyup change paste', 'input, select, textarea', function(){
                udahDiSaveApaBelom('belum', 'tab-eresep-tab')
            });

            $('.inputan-dummy-form-resep').on('keyup change paste', 'input, select, textarea, checkbox', function(){
                udahDiSaveApaBelom('belum', 'tab-eresep-tab')
            });

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

            $(document).on('submit', '#form-resep', function(e) {
                e.preventDefault();

                var thissubmitbutton = $(this).find('button[type="submit"]')

                thissubmitbutton.attr('disabled', true)

                var form = $(this);

                var obat = [];

                form.find('.obat-item-pasien').each(function() {
                    var obat_id = $(this).data('obat_id');
                    var jumlah = $(this).find('input[name="jumlah[]"]').val();
                    var aturan_pakai = $(this).find('input[name="aturan_pakai[]"]').val();

                    obat.push({
                        'obat_id': obat_id,
                        'jumlah': jumlah,
                        'aturan_pakai': aturan_pakai,
                    })
                })

                var data = {
                    'obat': obat,
                    'berat_badan': form.find('#bb_pasien').val(),
                    'tinggi_badan': form.find('#tb_pasien').val(),
                    'alergi_obat': form.find('#alergi_obat').val(),
                    'gangguan_fungsi_ginjal': form.find('#gangguan_fungsi_ginjal').val(),
                    'puasa': form.find('#puasa').val(),
                }

                @this.saveDataObatResep(data).then(() => {
                    udahDiSaveApaBelom('udah', 'tab-eresep-tab')
                    Toast.fire({
                        icon: 'success',
                        title: 'Resep berhasil disimpan'
                    })

                    thissubmitbutton.removeAttr('disabled')
                })
            })
        })

    </script>
</div>
