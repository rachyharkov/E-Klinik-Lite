<div style="height: 100%;">
    <div class="tindakan-wrapper d-flex" style="height: 100%;">
        <div class="tab-layanan-search-tindakan-wrapper" style="width: 25%; height: 100%;">
            <livewire:search-tindakan />
        </div>
        <div class="tab-layanan-tindakan-untuk-pasien" style="width: 75%; height: 100%;">
            <form style="display: flex;
            justify-content: space-evenly;
            flex-direction: column;
            height: 100%;">
                <h4 style="margin-left: 1rem;margin-top: 1rem;">Tindakan Untuk Pasien</h4>
                <div class="list-of-tindakan-terhadap-pasien">
                    <ul class="droppable cool-scroll" style="height: 50vh;width: 100%;padding: 0 10px;overflow-y:scroll"></ul>
                </div>
                <button type="submit" class="btn btn-success btn-sm" style="width: 100%;">Simpan</button>
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
                    }
                });
            })

            $(document).on('click', '.btn-remove-from-list', function() {
                $(this).parent().remove();
            });
        })
    </script>
</div>
