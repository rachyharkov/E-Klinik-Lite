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
        <ul style="height: 100%; list-style: none;">
            @if($listobatuntukpasien)
                @foreach ($listobatuntukpasien as $obatnya)
                    <li style="width: 100%; display: flex; flex-direction: row; justify-content: space-between; padding: 5px;">
                        <div>
                            <h5 style="font-size: 15px;">{{ $obatnya->nama_obat }}</h5>
                            <input type="text" class="form-control form-control-sm" name="aturan_pakai" placeholder="Input dosis/aturan pakai">
                            <button class="btn btn-sm btn-danger" wire:click="hapusObat({{ $obatnya->id }})" style="padding: 2px 9px;
                                font-size: 10px;
                                height: 20px;">Hapus</button>
                        </div>
                        <div>
                            <h5 style="font-size: 15px; font-weight: 500; text-align: right;">Rp. {{ number_format($obatnya->harga, 0, ',', '.') }}/{{ $obatnya->satuan_obats->nama_satuan_obat }}</h5>
                            <input type="text" class="form-control form-control-sm" name="jumlah" placeholder="Input jumlah">
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
        <button type="button" class="btn btn-primary">Simpan</button>
    </div>

    <script>
        window.addEventListener('status-hapus-obat', event => {
            alert(event.detail.statusnya);
        });
    </script>
</div>
