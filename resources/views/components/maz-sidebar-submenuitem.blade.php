@props(['active', 'icon', 'link', 'name'])

@php
$active = null;
$uri1 = request()->segment(1);
$lastSegment = collect(explode('/', $link))->last();

if ($uri1 == $lastSegment) {
    $active = true;
}

$classes = $active
            ? 'submenu-item  active'
            : 'submenu-item';
@endphp

<li class="{{ $classes }}">
    <a href="{{ $link }}" class='submenu-link'>{{ $name }}</a>
</li>
