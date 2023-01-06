<div class="search-obat-wrapper" style="position: relative;">
    <div class="input-group mb-3" style="z-index: 2;">
        <span class="input-group-text" id="basic-addon1" style="line-height: 0;" wire:loading.remove><i class="bi bi-search"></i></span>
        <span class="input-group-text" id="basic-addon1" style="line-height: 1;" wire:loading>
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </span>

        <input type="text" class="form-control" placeholder="Cari Obat (min. 3 Karakter)" aria-label="Cari Obat" id="searchbox-obat" aria-describedby="button-addon2" wire:model.debounce.800ms="term">
    </div>
    @if($obatsearchresult)
    <ul class="list-group list-group-flush cool-scroll list-of-obat" style="overflow-y: scroll;
    width: 100%;
    max-height: 30vh;
    list-style: none;
    padding-top: 0px;
    margin-top: 0px;
    position: absolute;
    top: 37px;
    transition: all 0.5s ease-in-out;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;">
            @if($obatsearchresult->isEmpty())
                <li class="list-group obatnya" style="display: flex;
                flex-direction: row;
                padding: 7px;
                width: 100%;
                justify-content: space-between;">
                    <div>
                        <h5>Obat tidak ditemukan</h5>
                    </div>
                </li>
            @else
                @foreach ($obatsearchresult as $obatnya)
                    <li class="list-group obatnya" style="display: flex;
                    flex-direction: row;
                    padding: 7px;
                    width: 100%;
                    justify-content: space-between;">
                        <div>
                            <h5>{{ $obatnya->nama_obat }} <span style="font-size: 11px; font-weight: 300;">Rp.{{ $obatnya->harga_obats[0]->harga }} <label class="badge bg-secondary">{{$obatnya->harga_obats[0]->nama_jenis_pasien }}</label></span></h5>
                            <table style="font-size: 10px;">
                                <tr>
                                    <td style="font-weight: bold;">Kategori</td>
                                    <td>:</td>
                                    <td>{{ $obatnya->kategori_obats->nama_kategori_obat }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Jenis Penggunaan</td>
                                    <td>:</td>
                                    <td>{{ $obatnya->jenis_penggunaan_obats->nama_jenis_penggunaan_obat }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Satuan</td>
                                    <td>:</td>
                                    <td>{{ $obatnya->satuan_obats->nama_satuan_obat }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Stok</td>
                                    <td>:</td>
                                    <td>{{ $obatnya->stok_obats[0]->stok }} <i class="bi bi-check-circle-fill" style="color: green;"></i></td>
                                </tr>
                            </table>
                        </div>
                        <div class="action" style="line-height: 6;">
                            @if(in_array($obatnya->id, $dataobatuntukpasiennya))
                                <p style="font-size: 13px; color: gray;">Sudah ditambahkan</p>
                            @else
                                <button type="button" class="btn btn-primary btn-setobatnya btn-sm" style="font-size: 13px;
                                line-height: 0;
                                padding: 10px;" wire:click="setObatUntukPasien({{ $obatnya->id }})">Tambah</button>
                            @endif
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    @endif
    <script>
        $(document).ready(function(){
            // out of .list-of-obat, click anywhere to hide the list
            $(document).click(function(e) {
                if (!$(e.target).is('.list-of-obat, .list-of-obat *')) {
                    $('.list-of-obat').hide();
                }
            });

            $(document).on('click','.btn-setobatnya', function() {
                $(this).attr('disabled', true);
            })

            window.addEventListener('status-nambahin-obat', event => {
                var statusnya = event.detail.statusnya;

                if(statusnya == 'selesai') {
                    $('.btn-setobatnya').attr('disabled', false);
                } else {
                    $('.btn-setobatnya').attr('disabled', true);
                }

                console.log('Status Nambahin Obat: ' + statusnya);
            })
        });
    </script>
</div>
