@props(['active', 'icon', 'link', 'name'])

@php
$uri1 = request()->segment(1);
// echo $uri;
$active_submenu = null;
if ($uri1 == strtolower($name)) {
    $active_submenu = true;
    // echo $active_submenu;
}

$classes = ($active ?? false)
            ? 'sidebar-item  active'
            : 'sidebar-item';
// get uri segment
@endphp

@if ($slot->isNotEmpty())
    <li class="{{ $classes }} {{ $active_submenu ? 'active' : '' }} has-sub">
        <a href="#" class='sidebar-link'>
            <i class="{{ $icon }}"></i>
            <span>{{ $name }}</span>
        </a>
        <ul class="submenu {{ $active_submenu ? 'active' : '' }}">
            {{ $slot }}
        </ul>
    </li>
@else
    <li class="{{ $classes }}">
        <a href="{{ $link }}" class='sidebar-link'>
            <i class="{{ $icon }}"></i>
            <span>{{ $name }}</span>
        </a>
    </li>
@endif
