@extends('layouts.app')

@section('title', 'Pangkalan Data Pasien')

@section('page-title')
    <div class="row">

    </div>
@endsection


@section('content')
    <style>
        div.dataTables_wrapper div.dataTables_filter {
            display: inline-block;
            float: right;
            margin: 5px;
        }

        #dataTable_length {
            display: inline-block;
            margin: 5px 20px;
        }

        #filterJenisPasienSelect {
            display: inline-block;
            padding-left: 30px;
            float: right;
            padding-top: 5px;
        }
    </style>

    <section class="section">
        <livewire:crud-pasien />
    </section>
@endsection

@push('js')
    <script>

        $(document).on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                            url: "{{ route('pasien.destroy', ':id') }}".replace(':id', id),
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    icon: 'success',
                                    timer: 3000
                                })
                                $('#dataTable').DataTable().ajax.reload();
                            },
                            error: function(response) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.message,
                                    icon: 'error',
                                    timer: 3000
                                })
                            }
                        })
                    })
                },
                allowOutsideClick: false
            })
        })

        function initSelectJenisPasien() {
            $('#filterJenisPasienSelect').html(`
                <select id="filterJenisPasien" class="form-select form-select-sm" name="filterJenisPasien">
                    <option value="">Semua Jenis Pasien</option>
                    @foreach ($jenisPasien as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_jenis_pasien }}</option>
                    @endforeach
                </select>
            `);

            // add event listener for select filter
            $('#filterJenisPasien').on('change', function() {
                // do query filterJenisPasien?=value

                var value = $(this).val();
                var url = "{{ route('pasien.index') }}";
                if (value != '') {
                    url += "?filterJenisPasien=" + value;
                }
                $('#dataTable').DataTable().ajax.url(url).load();

            })
        }

        function loadTable() {

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pasien.index') }}",
                columns: [{
                        data: 'patient_name',
                        name: 'patient_name'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        render: function(data) {
                            if (data == 'Laki-laki') {
                                return '<i class="bi bi-gender-male" style="font-size: 16px; color:#1e90ff;"></i>';
                            } else {
                                return '<i class="bi bi-gender-female" style="font-size: 16px; color:#ff1493;"></i>';
                            }
                        }
                    },
                    {
                        data: 'patient_address',
                        name: 'patient_address'
                    },
                    {
                        data: 'risiko_jatuh',
                        name: 'risiko_jatuh',
                        render: function(data) {
                            if (data == 1) {
                                return '<span class="badge bg-danger">Ya</span>';
                            } else {
                                return '<span class="badge bg-success">Tidak</span>';
                            }
                        }
                    },
                    {
                        data: 'jenis_pasien',
                        name: 'jenis_pasien',
                        render: function(data) {
                            return `<span class="badge" style="background-color: ${data.color_code}"">${data.nama_jenis_pasien}</span>`;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            // parse date using luxon
                            const date = luxon.DateTime.fromISO(data).toFormat('dd LLL yyyy');
                            return date;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                responsive: true,
                language: {
                    lengthMenu: '_MENU_ items/page',
                },
                dom: 'Blfr<"#filterJenisPasienSelect">tip',
                // button with livewire action
                buttons: [{
                    text: 'Tambah Pasien',
                    action: function(e, dt, node, config) {
                        window.livewire.emit('setMenu', 'create');
                    }
                }],
                order: [
                    [4, 'desc']
                ],
                initComplete: function() {
                    initSelectJenisPasien();
                },
            });
        }


        // refresh datatable when livewire action is called
        window.addEventListener('initTableNya', event => {
            loadTable();
        })

        // load datatable
        loadTable();
    </script>
@endpush
