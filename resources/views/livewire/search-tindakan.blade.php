<div style="display: flex;flex-direction: column;height: 100%;">
    <div>
        <div class="input-wrapper" style="position: relative;">
            <input wire:model.debounce.500ms="searchtindakankeyword" type="text" class="form-control" placeholder="Cari Tindakan" id="tab-layanan-search-tindakan" name="searchtindakankeyword"/>
            <div style="position: absolute;right: 3px;top: 1px;transform: scale(0.65);" wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-layanan-list-tindakan cool-scroll" style="overflow-y: scroll;height: 100%;">
        <ul style="list-style: none; padding: 0;">
            @if($tindakansearchresult)
                @if($tindakansearchresult->isEmpty())
                    <li style="text-align: center; margin-top: 2rem;"><i class="bi bi-cloud-haze2"></i> <br>Tidak ada data</li>
                @else
                    @foreach ($tindakansearchresult as $tindakannya)
                        <li class="draggable-element tindakan-item d-flex" style="position: relative;
                        padding: 4px 0px;">
                            <input type="hidden" name="tindakan_id[]" value="{{ $tindakannya->id }}">
                            <div style="margin: auto 5px;">
                                <i class="bi bi-grip-vertical" style="color: gray;"></i>
                            </div>
                            <div style="font-size: 14px;
                            max-width: 103px;
                            word-break: break-all;
                            font-weight: bold;">
                                {{ $tindakannya->nama_tindakan }}
                            </div>
                            <div style="position: absolute;
                            right: 11px;
                            bottom: 2px;
                            font-size: 11px;">
                                Rp.{{ $tindakannya->tarif }}
                            </div>
                        </li>
                    @endforeach
                @endif
            @endif
        </ul>
    </div>
</div>
