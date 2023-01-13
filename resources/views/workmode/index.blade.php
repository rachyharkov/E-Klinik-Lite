@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Work Mode')

@section('content')
    @include('workmode.style')
    <section class="section" style="height: 100%;">
        {{ inDevelopmentBanner() }}
        <livewire:formworkmode />
    </section>
    <livewire:antrian-patient-widget/>
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

            $(document).on('click', '#toggle-patient-done-list', function() {
                $('#pasien-terlayani-wrapper').toggleClass('hide');
            })

            $('#toggle-patient-done-list').click()
        });

    </script>
@endpush
