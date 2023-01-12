<div style="height: 100%;">
    <div class="tindakan-wrapper d-flex" style="height: 100%;">
        <div class="tab-layanan-search-tindakan-wrapper" style="width: 25%; height: 100%;">
            <livewire:search-tindakan />
        </div>
        <div class="tab-layanan-tindakan-untuk-pasien" style="width: 75%; height: 100%;">
            <form style="display: flex;
            justify-content: space-evenly;
            flex-direction: column;
            height: 100%;" id="form-layanan">
                <h4 style="margin-left: 1rem;margin-top: 1rem;">Tindakan Untuk Pasien</h4>
                <div class="list-of-tindakan-terhadap-pasien" style="height: 36vh;">
                    <ul class="droppable cool-scroll" style="height: 100%;width: 100%;padding: 0 10px;overflow-y: scroll;flex: 1;">
                        @if($dataLayananAtauTindakan)
                            @foreach ($dataLayananAtauTindakan as $tindakannya)
                                <li class="draggable-element tindakan-item d-flex" style="position: relative;
                                padding: 4px 0px;">
                                    <input type="hidden" name="tindakan_id[]" value="{{ $tindakannya['id'] }}">
                                    <div style="margin: auto 5px;">
                                        <i class="bi bi-grip-vertical" style="color: gray;"></i>
                                    </div>
                                    <div style="font-size: 14px;
                                    max-width: 103px;
                                    word-break: break-all;
                                    font-weight: bold;">
                                        {{ $tindakannya['nama_tindakan'] }}
                                    </div>
                                    <div style="position: absolute;
                                    right: 11px;
                                    bottom: 2px;
                                    font-size: 11px;">
                                        Rp.{{ $tindakannya['tarif'] }}
                                    </div>
                                    <span class="badge bg-danger btn-remove-from-list"><i class="bi bi-x"></i></span>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Simpan</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $('.tindakan-wrapper').on('mouseover', function() {

                $('.draggable-element').draggable({
                    helper: 'clone',
                    cursor: 'move',
                    cursorAt: {
                        top: 56,
                        left: 56
                    }
                });

                $('.droppable').droppable({
                    accept: '.draggable-element',
                    drop: function(event, ui) {
                        var draggable = ui.draggable;
                        var clone = draggable.clone();
                        clone.removeClass('draggable-element');
                        clone.addClass('dropped-element');
                        clone.draggable({
                            helper: 'clone',
                            cursor: 'move',
                            cursorAt: {
                                top: 56,
                                left: 56
                            },
                        });
                        $(this).append(clone);
                        $(clone).append('<span class="badge bg-danger btn-remove-from-list"><i class="bi bi-x"></i></span>');
                        udahDiSaveApaBelom('belum','tab-layanan-tab')
                    }
                });
            })

            $(document).on('click', '.btn-remove-from-list', function() {
                $(this).parent().remove();
                udahDiSaveApaBelom('belum','tab-layanan-tab')
            });

            $(document).on('submit', '#form-layanan', function(e) {
                e.preventDefault();

                var thissubmitbutton = $(this).find('button[type="submit"]')

                thissubmitbutton.attr('disabled', true)

                var dataTindakan = [];
                $('.list-of-tindakan-terhadap-pasien .tindakan-item').each(function() {
                    var tindakan_id = $(this).find('input[name="tindakan_id[]"]').val();

                    dataTindakan.push(tindakan_id)
                })

                console.log(dataTindakan);

                @this.saveDataLayananAtauTindakan(dataTindakan).then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Berhasil menyimpan data'
                    })

                    udahDiSaveApaBelom('udah','tab-layanan-tab')
                    thissubmitbutton.removeAttr('disabled')
                })

            })
        })
    </script>
</div>
