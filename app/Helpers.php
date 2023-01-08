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
