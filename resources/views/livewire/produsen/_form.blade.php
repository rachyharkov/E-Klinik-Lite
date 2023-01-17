<div class="patient-detail">
    <form class="form-produsen" action="{{ $action }}" method="POST">
        @if($menu == 'edit')
            @include('livewire.produsen.form._edit')
        @elseif($menu == 'create')
            @include('livewire.produsen.form._create')
        @endif
    </form>

    <script>
        $(document).ready(function() {

            function loadCKEditor() {
                ClassicEditor
                    .create(document.querySelector('#catatan'))
                    .then(newEditor => {
                        window.editor = newEditor

                        newEditor.model.document.on('change:data', () => {
                            newEditor.updateSourceElement();
                        });
                    })
                    .catch( error => {console.error( error );});
            }

            if(window.editor) {
                window.editor.destroy()
            }

            loadCKEditor()

            //in form-produsen, if user start typing on specified only with invalid-feedback, then remove invalid-feedback
            $('.form-produsen').on('keyup', '.is-invalid', function() {
                $(this).removeClass('is-invalid');
            });


            @if($menu == 'edit')
                $(document).on('click','.btn-restore', function() {
                    Swal.fire({
                        title: 'Kembalikan ke Semula?',
                        text: "Data yang sudah diubah akan dikembalikan ke semula!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, kembalikan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.call('restoreValue').then(() => {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Data berhasil dikembalikan ke semula!',
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    timer: 3000
                                })
                                loadCKEditor()
                            })
                        }
                    })
                })
            @endif

            $('.form-produsen').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var data = form.serialize();
                data += '&_token={{ csrf_token() }}';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function(response) {
                        // trigger event setMenu with parameter 'index'
                        window.livewire.emit('setMenu', 'index');

                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            timer: 3000
                        })
                    },
                    error: function(response) {
                        console.log(response);
                        Swal.fire({
                            title: 'Error!',
                            text: response.responseJSON.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                        // make input to red
                        $.each(response.responseJSON.errors, function(key, value) {
                            var input = $('[name=' + key + ']');
                            input.addClass('is-invalid');
                            input.closest('.form-group').find('.invalid-feedback').remove();
                            input.closest('.form-group').append(
                                '<div class="invalid-feedback">' + value + '</div>'
                            );
                        });
                    }
                });
            });
        });
    </script>


</div>
