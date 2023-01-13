<div>
    <style>

        div.dataTables_wrapper div.dataTables_filter input {
            font-size: 19px;
            margin: 0;
        }

        div.dataTables_wrapper div.dataTables_filter label {
            width: 100%;
        }
        div.dataTables_wrapper div.dataTables_filter {
            display: inline-block;
            float: left;
            margin: 5px;
            width: 40%;
        }

        #dataTable_length {
            display: inline-block;
            margin: 5px 20px;
        }
        .dataTables_wrapper .dataTables_filter{
            float: left;
        }
        .dataTables_wrapper .dataTables_length{
            float: right;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            width: 100%;
        }
    </style>

    <div class="table-responsive">
        <table class="table table-sm" id="dataTable" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Layanan</th>
                    <th>Tanggal</th>
                    <th>Opsi</th>
                </tr>
            </thead>
        </table>
    </div>


    <script>

        function loadTable() {

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('rekam_medis.index', $dataPasien['id']) }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'layanan_klinik',
                        name: 'layanan_klinik',
                        render: function(data) {
                            if (data.length > 0) {
                                return data.map(function(item) {
                                    return `<span class="badge ${item.color}">${item.layanan}</span>`;
                                }).join(' ');
                            } else {
                                return `<span class="badge badge-secondary">Tidak ada Layanan</span>`;
                            }
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            // parse date using luxon
                            const date = luxon.DateTime.fromISO(data).toFormat('dd/mm/yyyy');
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
                lengthChange: false,
                "dom": "<'row'<'col-lg-12 col-md-12 col-xs-12'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                language: {
                    search: "",
                    searchPlaceholder: "Ketik Pencarian Disini",
                },
                pageLength: 10,
            });
        }

        // refresh datatable when livewire action is called
        window.addEventListener('initTableNya', event => {
            loadTable();
        })

        // load datatable
        loadTable();
    </script>
</div>
