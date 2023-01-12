@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Work Mode')

@section('content')
    @include('workmode.style')
    <section class="section" style="height: 100%;">
        {{ inDevelopmentBanner() }}
        <livewire:formworkmode />
    </section>
    <div id="pasien-terlayani-wrapper" class="cool-scroll">
        <button class="btn btn-primary" id="toggle-patient-done-list" type="button"></button>
        <div class="card" style="min-height: 100vh;">
            <div class="card-header d-flex">
                <i class="bi bi-list-check" style="font-size: 24px; margin-right: 1rem;"></i>
                <h4 class="card-title">Pasien Terlayani <br> <p style="font-size: 14px; margin: 0;">{{ date('d F Y') }}</p></h4>
                <button class="btn btn-outline-primary btn-sm" style="margin-left: auto;" onclick="alert('refreshed')">Refresh</button>
            </div>
            <div class="card-body" style="overflow-x: scroll;">
                <table class="table mb-0">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th colspan="2">Detail</th>
                    </tr>
                    @php
                        $arrayjeniskelamindancolor = [
                            'Laki-laki' => '#0d6efd',
                            'Perempuan' => '#d63384',
                        ];

                        $arrayjenislayanan = [
                            'Konsultasi' => '#6610f2',
                            'Rawat Jalan' => '#198754',
                            'Rawat Inap' => '#dc3545',
                        ];
                    @endphp
                    @for ($i = 10; $i >= 0; $i--)
                        <tr style="font-size: 13px;">
                            <td>{{ $i }}</td>
                            <td>John Doe</td>
                            <td>
                                43 Tahun <br>
                                @php
                                    $jenislayanan = array_rand($arrayjenislayanan);
                                    $jeniskelamin = array_rand($arrayjeniskelamindancolor);
                                @endphp
                                <span class="badge" style="background-color: {{ $arrayjeniskelamindancolor[$jeniskelamin] }};">{{ $jeniskelamin }}</span>
                                <span class="badge" style="background-color: {{ $arrayjenislayanan[$jenislayanan] }};">{{ $jenislayanan }}</span>
                            </td>
                            <td>
                                <div class="btn-group mb-1">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu" style="
                                            box-shadow: 0 0 0.5rem 0 rgba(0, 0, 0, 0.1);
                                        ">
                                            <a class="dropdown-item" href="#">Profil</a>
                                            <a class="dropdown-item" href="#">Edit Kunjungan</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Cetak Kwitansi</a>
                                            <a class="dropdown-item" href="#">Cetak Resep</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#prevBtn',function() {
                $(this).attr('disabled', true);
            })

            $(document).on('click', '#nextBtn',function() {
                $(this).attr('disabled', true);
            })

            $(document).on('click', '#btnEnd', function() {
                alert('Mengarahkan dari ulang...');
            })

            $(document).on('click', '#toggle-patient-done-list', function() {
                $('#pasien-terlayani-wrapper').toggleClass('hide');
            })

            $('#toggle-patient-done-list').click()
        });

    </script>
@endpush
