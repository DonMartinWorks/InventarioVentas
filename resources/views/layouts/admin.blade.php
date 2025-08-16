<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} &#124; {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- WireUI -->
    <wireui:scripts />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    @stack('css')
</head>

<body class="font-sans antialiased bg-gray-100">
    {{-- Header --}}
    @include('layouts.includes.admin.navigation')

    @include('layouts.includes.admin.sidebar')

    <div class="p-4 sm:ml-64">
        <div class="mt-14">
            {{-- @include('layouts.includes.admin.breadcrumb') --}}
        </div>

        @if (isset($actions))
            <div class="py-2">
                {{ $actions }}
            </div>
        @endif

        <div class="mt-4 p-4 border bg-gray-50 rounded-lg">
            {{ $slot }}
        </div>
    </div>

    @stack('modals')

    {{-- Flowbite --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    {{-- Font-Awesome --}}
    <script src="https://kit.fontawesome.com/765e97e328.js" crossorigin="anonymous"></script>

    @livewireScripts

    {{-- Sweet Alert --}}
    {{-- <x-plugins.sweet-alert /> --}}

    @stack('js')
</body>

</html>
