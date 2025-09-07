@extends('layouts.profle-layout')
@section('title', 'Struktur Organisasi')
@section('content')
    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-5">Struktur Organisasi</h1>
    <img src="{{ asset('images/struktur-organisasi-dimsa.webp') }}" alt="struktur organisasi"
        class="w-full max-w-4xl mx-auto rounded-lg shadow-md">
    <hr class="my-10 border-t-2 border-gray-200">
    <div class="flex flex-row justify-between">
        <div class="flex flex-col cursor-pointer" onclick="location.href='{{ route('guest.visi-misi') }}'">
            <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800"><i
                    class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
            <h1 class="text-lg md:text-xl font-bold">Visi & Misi</h1>
        </div>
        <div class="flex flex-col items-end cursor-pointer" onclick="location.href='{{ route('guest.akreditasi') }}'">
            <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                    class="fa-solid fa-arrow-right ml-2"></i>
            </p>
            <h1 class="text-lg md:text-xl font-bold">Akreditasi</h1>
        </div>
    </div>
@endsection
