<div class="search-obat-wrapper" style="position: relative;z-index: 2;">
    <div class="input-group-cust mb-3" style="z-index: 2;position: relative;">
        <input type="text" class="form-control" placeholder="Cari Obat (min. 3 Karakter)" aria-label="Cari Obat" id="searchbox-obat" aria-describedby="button-addon2" wire:model.debounce.800ms="term">

        {{-- spinner --}}
        <img src="{{ asset('images/ball-triangle.svg') }}" alt="" class="spinner-obat" style="position: absolute;
        top: -11px;
        right: -5px;
        transform: scale(0.4);" wire:loading />

    </div>
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
        @if($obatsearchresult)
            @if($obatsearchresult->isEmpty())
                <li class="list-group obatnya" style="padding: 10px 1rem;
                width: 100%;text-align:center;">
                    <div>
                        <h5>Obat tidak ditemukan</h5>
                    </div>
                </li>
            @else
                @foreach ($obatsearchresult as $obatnya)
                    <li class="list-group obatnya garis-pemisah-custom" style="display: flex;
                    flex-direction: row;
                    padding: 8px 20px;
                    width: 100%;
                    justify-content: space-between;"
                    data-idobat="{{ $obatnya->id }}"
                    >
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
                        <div class="action obat-search-action" style="line-height: 6;">
                            <button type="button" class="btn btn-primary btn-setobatnya anjay-effect btn-sm" style="font-size: 13px;
                            line-height: 0;
                            padding: 10px;"
                            id="add{{ $obatnya->id }}btn"
                            data-idobat="{{ $obatnya->id }}"
                            data-namaobat="{{ $obatnya->nama_obat }}"
                            data-hargaobat="{{ $obatnya->harga_obats[0]->harga }}"
                            data-jenispasien="{{ $obatnya->harga_obats[0]->nama_jenis_pasien }}"
                            data-kategoriobat="{{ $obatnya->kategori_obats->nama_kategori_obat }}"
                            data-jenispenggunaanobat="{{ $obatnya->jenis_penggunaan_obats->nama_jenis_penggunaan_obat }}"
                            data-satuanobat="{{ $obatnya->satuan_obats->nama_satuan_obat }}"
                            >Tambah</button>
                        </div>
                    </li>
                @endforeach
            @endif
        @endif
    </ul>
    <script>
        $(document).ready(function(){
            // out of .list-of-obat, click anywhere to hide the list
            $(document).click(function(e) {
                if (!$(e.target).is('.list-of-obat, .list-of-obat *')) {
                    $('.list-of-obat').hide();
                }
            });

            console.log('obat search result loaded');

            window.addEventListener('detectObatYangUdahDitambah', event => {

                $('.list-obat-untuk-pasien').find('.obat-item-pasien').each(function() {

                    var idobatyangudahditambah = $(this).data('obat_id')

                    $('.list-of-obat').find('.obatnya').each(function() {
                        var idobatyangdaripencarian = $(this).data('idobat');
                        var button = $(this).find('.obat-search-action').find('.btn-setobatnya');

                        if (idobatyangudahditambah == idobatyangdaripencarian) {
                            button.attr('disabled', true);
                            button.text('Telah ditambahkan');
                            console.log('obat sudah ada' + idobatyangudahditambah + ' | ' + idobatyangdaripencarian);
                        }
                    })
                })
            });
        });
    </script>
</div>
