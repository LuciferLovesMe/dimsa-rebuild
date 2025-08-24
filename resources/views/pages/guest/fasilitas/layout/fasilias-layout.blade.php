@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <div class="relative h-64 md:h-80 lg:h-[75vh]  bg-cover bg-center" style="background-image: url('@yield('heroImage', 'https://placehold.co/1920x1080/2d3748/e2e8f0?text=Background')');">
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <div class="relative h-full flex items-end justify-between p-4 sm:p-8 lg:p-20">
            <div class="w-full md:w-2/3">
                <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight">
                    @yield('heroTitle', 'Judul Halaman Fasilitas')
                </h1>
                <p class="text-white mt-4 md:w-3/4 lg:w-1/2 xl:w-2/3">
                    @yield('heroDesc', 'Deskripsi singkat mengenai fasilitas.')
                </p>
            </div>
        </div>
    </div>

    {{-- Main Content Slot --}}
    <main>
        @yield('main-content')
    </main>

    @include('components.footer')
@endsection
