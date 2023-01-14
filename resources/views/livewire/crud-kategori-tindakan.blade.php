<div>
    <style>
        .box {
            border-radius: 4px;
            padding-bottom: 160px;
            position: relative;
            background-color: #f2f2f2;
            transition: 0.5s;
            overflow: hidden;
            cursor:
        }

        .box:hover {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            transition: 0.5s;
        }

        .theme-dark .box {
            background-color: #222234c9;
        }

        .box .info-overview {
            position: absolute;
            right: -70px;
            bottom: 20px;
            display: flex;
            flex-direction: column;
            height: 82px;
            justify-content: flex-end;
            transition: cubic-bezier(0.075, 0.82, 0.165, 1) 0.5s;
            z-index: 0;
            font-size: 14px;
        }

        .box .info-overview span {
            text-align: left;
            word-spacing: 30px;
            transition: cubic-bezier(0.075, 0.82, 0.165, 1) 0.5s;
            position: relative;
        }

        .box .info-overview span.badge i {
            font-size: 0.8rem;
            color: white;
            position: relative;
            margin-right: 6px;
            left: 0px;
            top: -1px;
            transition: cubic-bezier(0.075, 0.82, 0.165, 1) 0.5s;
        }

        .box:hover .info-overview {
            right: 0.5rem;
            transition: cubic-bezier(0.075, 0.82, 0.165, 1) 0.5s;
        }

        .box:hover .info-overview span {
            word-spacing: normal;
            transition: cubic-bezier(0.075, 0.82, 0.165, 1) 0.5s;
        }

        .box:hover .info-overview span.badge i {
            font-size: 0;
            transition: cubic-bezier(0.075, 0.82, 0.165, 1) 0.5s;
        }

        .box i.bg-icon {
            transform : translate(50%, -50%) scale(1);
            color: #9b9b9d3d;
            transition: 0.5s;
            position: absolute;
            left: 6%;
            top: 11%;
            font-size: 7rem;
        }

        .box:hover i.bg-icon {
            transform : translate(50%, -50%) scale(1.2) !important;
            color: #9b9b9dbf;
            transition: 0.5s;
        }

        .theme-dark .box i {
            color: #353552bf;
        }

        .theme-dark .box:hover i {
            color: #64647ebf;
            transform : translate(50%, -50%) scale(1.2) !important;
            transition: 0.5s;
        }

        .box.add-btn h4 {
            position: absolute;
            left: 35%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-size: 19px;
            font-weight: 500;
        }

        .box.member-item h4 {
            position: absolute;
            left: 60%;
            width: 100%;
            top: 30%;
            transform: translate(-50%, -50%);
            font-size: 19px;
            font-weight: 500;
        }

        .box:hover h4 {
            transition: 0.5s;
            font-weight: bold;
        }

        .dropdown-action {
            position: absolute;
            right: 0.7rem;
            top: 0.5rem;
            z-index: 1;
        }

        .theme-dark .dropdown-action {
            position: absolute !important;
            right: 0.7rem;
            top: 0.5rem;
            z-index: 1;
        }


        .col-lg-3, .col-md-3, .col-xs-6{
            margin-top: 30px !important;
        }
    </style>
    <div class="card" style="min-height: 80vh;">
        <div class="card-header">
            <h3 class="card-title">{{ $titlenya }}</h3>
        </div>
        <div class="card-body">
            {{ inDevelopmentBanner() }}
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xs-6 ">
                        <div class="box add-btn">
                            <i class="bi bi-person-plus-fill bg-icon"></i>
                            <h4>Tambah Baru</h4>
                        </div>
                    </div>
                    @if($data_counter)
                        @foreach ($data_counter as $count)
                            <div class="col-lg-3 col-md-3 col-xs-6" style="position: relative;">
                                <div class="dropdown dropdown-action">
                                    <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="position: unset;">
                                        <i class="bi bi-three-dots-vertical" style="color: #fff;"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="{{ route('tindakan.index', ['search' => $count['nama_kategori_tindakan']]) }}">Lihat Tindakan</a></li>
                                        <li><a class="dropdown-item" href="#">Migrasi {{ inDevelopmentIndicator() }}</a></li>
                                        <li><a class="dropdown-item" href="#">Ubah Nama {{ inDevelopmentIndicator() }}</a></li>
                                        <li><a class="dropdown-item" href="#">Hapus {{ inDevelopmentIndicator() }}</a></li>
                                    </ul>
                                </div>
                                <div class="box member-item" style="background-color: {{ $count['color'] }}">
                                    <i class="bi bi-people-fill bg-icon"></i>
                                    <h4 style="color: {{ generate_contrast_text($count['color']) }};">{{ $count['nama_kategori_tindakan'] }}</h4>
                                    <div class="info-overview">
                                        <span class="badge bg-info"><i class="bi bi-journal-medical"></i>{{ $count['jumlah'] }} Tindakan</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
