<?php

if(!function_exists('generate_contrast_text')) {
    function generate_contrast_text($hexcolor)
    {
        $hexcolor = str_replace('#', '', $hexcolor);
        $r = hexdec(substr($hexcolor, 0, 2));
        $g = hexdec(substr($hexcolor, 2, 2));
        $b = hexdec(substr($hexcolor, 4, 2));
        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
        return ($yiq >= 128) ? 'black' : 'white';
    }
}

if(!function_exists('inDevelopmentIndicator')) {
    function inDevelopmentIndicator() {
        echo '<span data-bs-toggle="tooltip" data-bs-placement="top" title="Fitur Tidak Dapat Digunakan"><i class="bi bi-tools" style="margin-left: 1rem;"></i></span>';
    }
}

if(!function_exists('inDevelopmentBanner')) {
    function inDevelopmentBanner() {
        echo '<div class="alert alert-info alert-dismissible show fade" role="alert">
                <div style="margin-bottom: 0.50rem;">
                    <i class="bi bi-star" style="font-size: 28px;margin-right: 8px;"></i>
                    <strong>Sedang dalam proses Development!</strong>
                </div>
                Beberapa Fitur yang terdapat pada halaman ini tidak tersedia pada versi E-Klinik yang anda gunakan (ditandai dengan simbol <i class="bi bi-tools"></i>), silahkan hubungi developer untuk menjadi yang awal mencoba fitur early-development pada halaman ini agar bisa anda gunakan. Informasi lebih lanjut mengenai fitur ini bisa anda lihat pada <a href="#">Dokumentasi Early Feature</a> E-Klinik.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
}

if(!function_exists('numberToIDR')) {
    function numberToIDR($number) {
        return 'Rp. ' . number_format($number, 0, ',', '.');
    }
}

if(!function_exists('terbilangInRupiah')) {
    function terbilangInRupiah($number) {
        // buat array bilangan
        $bilangan = array(
            '',
            'Satu',
            'Dua',
            'Tiga',
            'Empat',
            'Lima',
            'Enam',
            'Tujuh',
            'Delapan',
            'Sembilan',
            'Sepuluh',
            'Sebelas'
        );

        // cek apakah bilangan kurang dari sama dengan 11
        if ($number < 12) {
            return $bilangan[$number];
        } else if ($number < 20) {
            // bilangan puluhan
            return $bilangan[$number - 10] . ' Belas';
        } else if ($number < 100) {
            // bilangan ratusan
            $hasil_bagi = (int)($number / 10);
            $hasil_mod = $number % 10;
            return trim(sprintf('%s Puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
        } else if ($number < 200) {
            // bilangan ribuan
            return sprintf('Seratus %s', terbilangInRupiah($number - 100));
        } else if ($number < 1000) {
            // bilangan ribuan
            $hasil_bagi = $number / 100;
            $hasil_mod = $number % 100;
            return trim(sprintf('%s Ratus %s', $bilangan[$hasil_bagi], terbilangInRupiah($hasil_mod)));
        } else if ($number < 2000) {
            // bilangan ribuan
            return trim(sprintf('Seribu %s', terbilangInRupiah($number - 1000)));
        } else if ($number < 1000000) {
            // bilangan jutaan
            $hasil_bagi = $number / 1000;
            $hasil_mod = $number % 1000;
            return sprintf('%s Ribu %s', terbilangInRupiah($hasil_bagi), terbilangInRupiah($hasil_mod));
        } else if ($number < 1000000000) {
            // bilangan milyaran
            $hasil_bagi = $number / 1000000;
            $hasil_mod = $number % 1000000;
            return trim(sprintf('%s Juta %s', terbilangInRupiah($hasil_bagi), terbilangInRupiah($hasil_mod)));
        } else if ($number < 1000000000000) {
            // bilangan trilyunan
            $hasil_bagi = $number / 1000000000;
            $hasil_mod = fmod($number, 1000000000);
            return trim(sprintf('%s Milyar %s', terbilangInRupiah($hasil_bagi), terbilangInRupiah($hasil_mod)));
        } else if ($number < 1000000000000000) {
            // bilangan quadrilyunan
            $hasil_bagi = $number / 1000000000000;
            $hasil_mod = fmod($number, 1000000000000);
            return trim(sprintf('%s Trilyun %s', terbilangInRupiah($hasil_bagi), terbilangInRupiah($hasil_mod)));
        } else {
            return 'Wow...';
        }
    }
}

if(!function_exists('terbilangInRupiahWithCurrency')) {
    function terbilangInRupiahWithCurrency($number) {
        return terbilangInRupiah($number) . ' Rupiah';
    }
}

