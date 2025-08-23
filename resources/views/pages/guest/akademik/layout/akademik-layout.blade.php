@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <div class="relative h-64 md:h-80 lg:h-screen bg-cover bg-center"
        style="background-image: url('{{ $heroImage ?? 'https://placehold.co/1920x1080/2d3748/e2e8f0?text=Latar+Belakang+Sekolah' }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <div class="relative h-full flex items-end justify-between p-4 sm:p-8 lg:p-20">
            <div class="w-full md:w-2/3">
                <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight">
                    {{ $heroTitle ?? 'Judul Halaman Akademik' }}
                </h1>
            </div>
            <div class="hidden md:flex flex-col items-center gap-y-5">
                <a href="https://www.facebook.com/darulihsan" target="_blank" rel="noopener noreferrer"
                    class="border-2 border-white rounded-full p-2 hover:bg-white hover:text-blue-800 transition-colors duration-300">
                    <i class="fab fa-facebook-f fa-fw text-xl text-white"></i>
                </a>
                <a href="https://www.instagram.com/darulihsan_sragen" target="_blank" rel="noopener noreferrer"
                    class="border-2 border-white rounded-full p-2 hover:bg-white hover:text-pink-600 transition-colors duration-300">
                    <i class="fab fa-instagram fa-fw text-xl text-white"></i>
                </a>
                <a href="https://www.youtube.com/@darulihsan_sragen" target="_blank" rel="noopener noreferrer"
                    class="border-2 border-white rounded-full p-2 hover:bg-white hover:text-red-600 transition-colors duration-300">
                    <i class="fab fa-youtube fa-fw text-xl text-white"></i>
                </a>
            </div>
        </div>
    </div>

    <main>

        {{-- Section Tentang  --}}
        <div class="bg-white py-12 md:py-20 px-4 sm:px-8 lg:px-20">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800">@yield('tentang_title')</h2>
                <p class="text-base md:text-lg text-gray-600 mt-6 text-justify leading-relaxed">
                    @yield('tentang_body')
                </p>
            </div>
        </div>

        {{-- Section Visi Misi --}}
        <div class="bg-gray-50 py-12 md:py-20 px-4 sm:px-8 lg:px-20">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                {{-- Visi --}}
                <div class="p-6">
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Visi Sekolah</h3>
                    <p class="text-base md:text-lg text-gray-600 italic">
                        "@yield('visi_body')"
                    </p>
                </div>
                {{-- Misi --}}
                <div class="p-6">
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Misi Sekolah</h3>
                    <ul class="space-y-3">
                        @yield('misi_list')
                    </ul>
                </div>
            </div>
        </div>

        {{-- Section Tujuan --}}
        <div class="bg-white py-12 md:py-20 px-4 sm:px-8 lg:px-20">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center mb-10">Tujuan Sekolah</h2>
                <div class="space-y-4">
                    <ol class="list-decimal list-outside ml-5 space-y-4 text-gray-600">
                        @yield('tujuan_list')
                    </ol>
                </div>
            </div>
        </div>
    </main>


    @include('components.footer')
@endsection
