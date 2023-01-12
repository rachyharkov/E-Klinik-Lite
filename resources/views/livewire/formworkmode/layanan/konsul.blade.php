<div style="height: 100%;">
    <style>

        .ck.ck-reset.ck-editor.ck-rounded-corners {
            height: 100%;
        }

        .ck-editor__editable {
            height: 450px;
        }
    </style>
    <form id="form-konsultasi" style="height: 100%; display: flex; flex-direction: column;">
        <textarea id="catatanKonsul">
            @if($dataKonsultasi != null)
                {{ html_entity_decode($dataKonsultasi) }}
            @else
                <h3>Keluhan</h3>
                <p><i>ketik keluhan pasien disini...</i></p>
                <h3>Diagnosa</h3>
                <p><i>ketik diagnosa disini...</i></p>
                <h3>Tindakan/Hasil</h3>
                <p><i>Ketik analisa terhadap tindakan yang diberikan, saran, hasil, dan lain-lain disini</i></p>
            @endif
        </textarea>
        <br>
        <table>
            <tbody>
                <tr>
                    <td>
                        <h5 style="margin: 0;">Tindakan</h5>
                    </td>
                    <td>:</td>
                    <td>Tidak ada Tindakan, klik disini untuk mulai menambahkan</td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary" style="width: 100%;margin-top: 30px;">Simpan</button>
    </form>
    <script>
        $(document).ready(function() {
            function loadCKEditor() {
                ClassicEditor
                    .create(document.querySelector('#catatanKonsul'))
                    .then(newEditor => {
                        window.editor = newEditor
                    })
                    .catch( error => {console.error( error );});
            }

            if(window.editor) {
                window.editor.destroy()
            }

            setTimeout(() => {
                loadCKEditor()
            }, 1000)

            $(document).on('submit', '#form-konsultasi', function(e) {
                e.preventDefault()

                var thissubmitbutton = $(this).find('button[type="submit"]')

                thissubmitbutton.attr('disabled', true)

                var editor_content = editor.getData()
                @this.saveDataKonsultasi(editor_content).then(() => {
                    udahDiSaveApaBelom('udah', 'tab-konsul-tab')
                    Toast.fire({
                        icon: 'success',
                        title: 'Berhasil menyimpan data'
                    })

                    thissubmitbutton.removeAttr('disabled')
                })

            })
        })

    </script>
</div>
