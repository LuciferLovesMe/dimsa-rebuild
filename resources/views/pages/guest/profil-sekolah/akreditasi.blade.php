@extends('layouts.profle-layout')
@section('title', 'Akreditasi')
@section('content')
    <h1 class="font-bold text-2xl md:text-3xl lg:text-4xl">Akreditasi</h1>
    <img src="{{ asset('images/akreditasi.webp') }}" alt="Akreditasi"
        class="w-full max-w-3xl mx-auto rounded-lg shadow-md my-6">
    <div class="mb-4">
        <h2 class="text-lg md:text-xl lg:text-2xl font-semibold">Peringkat A</h2>
        <p class="text-sm md:text-base lg:text-md text-gray-500">NO SK: 1453/BAN-SM/SK/2022</p>
    </div>
    <p class="text-justify text-sm md:text-base lg:text-lg text-gray-700 mb-6">
        Pondok Pesantren Darul Ihsan Muhammadiyah Sragen dengan bangga meraih akreditasi peringkat A (Unggul) dengan nilai
        97
        berdasarkan Surat Keputusan Badan Akreditasi Nasional Sekolah/Madrasah (BAN-SM) Nomor 1453/BAN-SM/SK/2022.
        Pencapaian ini menjadi bukti komitmen kami dalam menyediakan pendidikan berkualitas tinggi di SMP Darul Ihsan
        Muhammadiyah yang mendukung pertumbuhan akademik dan spiritual para siswa.
    </p>
    <hr class="my-10 border-t-2 border-gray-200">
    <div class="flex flex-row justify-between md:flex-row lg:justify-between">
        <div class="flex flex-col cursor-pointer md:w-1/2 lg:w-auto lg:mr-10"
            onclick="location.href='{{ route('guest.struktur-organisasi') }}'">
            <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800"><i
                    class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
            <h1 class="font-bold text-sm md:text-base lg:text-lg">Struktur Organisasi</h1>
        </div>
        <div class="flex flex-col items-end cursor-pointer md:w-1/2 lg:w-auto lg:ml-10"
            onclick="location.href='{{ route('guest.logo') }}'">
            <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                    class="fa-solid fa-arrow-right ml-2"></i></p>
            <h1 class="font-bold text-sm md:text-base lg:text-lg">Logo & Brand</h1>
        </div>
    </div>
@endsection
