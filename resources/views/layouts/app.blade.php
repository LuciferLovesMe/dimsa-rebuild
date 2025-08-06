<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Judul Halaman Dinamis --}}
    <title>@yield('title', 'DIMSA')</title>

    {{-- Meta Tags Umum (SEO, dll) --}}
    {{-- <meta name="description" content="Deskripsi default aplikasi"> --}}

    {{-- Link ke CSS Utama (misal: dari Vite) --}}
    @vite('resources/css/app.css')

    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Jika ada CSS tambahan per halaman --}}
    @stack('styles')
</head>

<body class="font-sans">
    @include('components.navbar')

    {{-- Tempat untuk meletakkan konten utama halaman --}}

    <main>
        {{-- Konten Utama Halaman Akan Diletakkan di Sini --}}
        @yield('content')
    </main>

    {{-- Tempat untuk meletakkan Footer --}}
    {{-- @include('components.footer') --}}

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Script JS Utama (misal: dari Vite) --}}
    @vite('resources/js/app.js')

    {{-- Jika ada script tambahan per halaman --}}
    @stack('scripts')

</body>

</html>
