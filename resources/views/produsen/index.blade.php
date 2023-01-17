@extends('layouts.app')

@section('title', 'produsen')

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
    </style>

    <section class="section">
        <livewire:crud-produsen />
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
                            url: "{{ route('produsen.destroy', ':id') }}".replace(':id', id),
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
                                console.log(response);
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.responseJSON.message,
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

        function loadTable() {

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('produsen.index') }}",
                columns: [{
                        data: 'nama_produsen',
                        name: 'nama_produsen'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        render: function(data) {
                            // parse date using luxon
                            const date = luxon.DateTime.fromISO(data).toFormat('dd/MM/yyyy HH:mm:ss');
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
                dom: 'Blfrtip',
                // button with livewire action
                buttons: [{
                    text: 'Tambah Produsen',
                    action: function(e, dt, node, config) {
                        window.livewire.emit('setMenu', 'create');
                    }
                }],
                order: [
                    [1, 'desc']
                ],
                initComplete: function() {
                    @if(isset($search))
                        $('#dataTable_filter input').val("{{ $search }}");

                        // trigger search
                        $('#dataTable_filter input').trigger('keyup');
                    @endif
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
