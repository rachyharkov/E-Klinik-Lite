@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Pangkalan Data Pasien</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Pasien</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection


@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm" id="dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Pasien</th>
                                <th>JK</th>
                                <th>Alamat</th>
                                <th>Risiko Jatuh</th>
                                <th>Ter-registrasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
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
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                responsive: true,
            });
        });
    </script>
@endpush
