@extends('layouts.app')

@section('title', 'Kategori Tindakan')

@section('page-title')
    <div class="row">

    </div>
@endsection


@section('content')
    <section class="section">
        <livewire:crud-kategori-tindakan />
    </section>
@endsection

@push('js')
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endpush
