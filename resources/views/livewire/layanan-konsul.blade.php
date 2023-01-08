<div class="height: 100%;">
    <form id="form-konsultasi">
        <textarea id="summernoteGejala" placeholder="Tulis pesan anda disini"></textarea>
        <br>
        <table>
            <tbody>
                <tr>
                    <td><h5 style="margin: 0;">Tindakan</h5></td>
                    <td>:</td>
                    <td>Tidak ada Tindakan, klik disini untuk mulai menambahkan</td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary" style="width: 100%;margin-top: 30px;">Simpan</button>
    </form>
    <script>
        $(document).ready(function() {
            $("#summernoteGejala").summernote({
                tabsize: 2,
                height: 450,
                disableResizeEditor: true,
                callbacks: {
                    onBlur: function() {
                        udahDiSaveApaBelom('belum', 'tab-konsul-tab')
                    }
                }
            })

            $(document).on('submit', '#form-konsultasi', function(e) {
                e.preventDefault()
                udahDiSaveApaBelom('udah', 'tab-konsul-tab')
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil menyimpan data'
                })
            })
        })
    </script>
</div>
