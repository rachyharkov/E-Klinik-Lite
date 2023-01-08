<?php

if(!function_exists('generate_contrast_text'))
{
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

if(!function_exists('inDevelopmentWarning'))
{
    function inDevelopmentWarning() {
        echo '<span data-bs-toggle="tooltip" data-bs-placement="top" title="Fitur Tidak Dapat Digunakan"><i class="bi bi-tools" style="float:right;"></i></span>';
    }
}
