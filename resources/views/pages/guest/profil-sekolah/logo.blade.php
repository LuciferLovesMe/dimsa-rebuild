@extends('layouts.profle-layout')
@section('title', 'Logo & Brand')
@section('content')
    {{-- Main title with responsive margin --}}
    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">Logo & Brand</h1>

    {{-- Responsive grid: 1 col on mobile, 2 on small screens, 4 on large screens --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- Card Item 1: Logo Yayasan --}}
        <div class="flex flex-col items-center p-6 bg-white border border-gray-200 rounded-lg shadow-sm text-center">
            <h3 class="font-bold text-gray-800 mb-4">Logo Yayasan</h3>
            <img src="{{ asset('images/logo_pondok.png') }}" alt="Logo Yayasan" class="w-32 h-32 object-contain mb-4">
            <a href="{{ asset('images/logo_pondok.png') }}" download="Logo Yayasan.png"
                class="w-full mt-auto flex items-center justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-800 bg-gray-200 opacity-75 hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500/80 transition-colors">
                <i class="fa-solid fa-file-arrow-down mr-2"></i>
                Unduh File
            </a>
        </div>

        {{-- Card Item 2: Logo SMP --}}
        <div class="flex flex-col items-center p-6 bg-white border border-gray-200 rounded-lg shadow-sm text-center">
            <h3 class="font-bold text-gray-800 mb-4">Logo SMP</h3>
            <img src="{{ asset('images/logo_smp.png') }}" alt="Logo SMP" class="w-32 h-32 object-contain mb-4">
            <a href="{{ asset('images/logo_smp.png') }}" download="Logo SMP.png"
                class="w-full mt-auto flex items-center justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-800 bg-gray-200 opacity-75 hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500/80 transition-colors">
                <i class="fa-solid fa-file-arrow-down mr-2"></i>
                Unduh File
            </a>
        </div>

        {{-- Card Item 3: Logo MA --}}
        <div class="flex flex-col items-center p-6 bg-white border border-gray-200 rounded-lg shadow-sm text-center">
            <h3 class="font-bold text-gray-800 mb-4">Logo MA</h3>
            <img src="{{ asset('images/logo_ma.png') }}" alt="Logo MA" class="w-32 h-32 object-contain mb-4">
            <a href="{{ asset('images/logo_ma.png') }}" download="Logo MA.png"
                class="w-full mt-auto flex items-center justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-800 bg-gray-200 opacity-75 hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500/80 transition-colors">
                <i class="fa-solid fa-file-arrow-down mr-2"></i>
                Unduh File
            </a>
        </div>

        {{-- Card Item 4: Logo Branding --}}
        <div class="flex flex-col items-center p-6 bg-white border border-gray-200 rounded-lg shadow-sm text-center">
            <h3 class="font-bold text-gray-800 mb-4">Logo Branding</h3>
            <img src="{{ asset('images/dimsa_blue.png') }}" alt="Logo Branding" class="w-32 h-32 object-contain mb-4">
            <a href="{{ asset('images/dimsa_blue.png') }}" download="Logo Branding DIMSA.png"
                class="w-full mt-auto flex items-center justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-800 bg-gray-200 opacity-75 hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500/80 transition-colors">
                <i class="fa-solid fa-file-arrow-down mr-2"></i>
                Unduh File
            </a>
        </div>

    </div>
    <hr class="my-10 border-t-2 border-gray-200">
    <div class="flex flex-row justify-between md:flex-row lg:justify-between">
        <div class="flex flex-col cursor-pointer md:w-1/2 lg:w-auto lg:mr-10"
            onclick="location.href='{{ route('guest.akreditasi') }}'">
            <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800"><i
                    class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
            <h1 class="font-bold text-sm md:text-base lg:text-lg">Akreditasi</h1>
        </div>
        <div class="flex flex-col items-end cursor-pointer md:w-1/2 lg:w-auto lg:ml-10"
            onclick="location.href='{{ route('landing-page') }}'">
            <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                    class="fa-solid fa-arrow-right ml-2"></i></p>
            <h1 class="font-bold text-sm md:text-base lg:text-lg">Landing Page</h1>
        </div>
    </div>
@endsection
