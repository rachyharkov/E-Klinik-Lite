<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        @include('layouts.partials.styles')
    </head>
    <body>
        <div id="app">
            @include('layouts.partials.sidebar')

            <div id="main" class='layout-navbar'>
                @include('layouts.partials.header')
                <div id="main-content" style="padding-top: 0;">

                    <div class="page-heading">
                        <div class="page-title">
                            @yield('page-title')
                        </div>
                        @yield('content')
                    </div>

                    @include('layouts.partials.footer')
                </div>
            </div>
        </div>

        <!-- Scripts -->
        @include('layouts.partials.scripts')

    </body>
</html>
