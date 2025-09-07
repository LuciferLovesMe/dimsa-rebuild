@extends('layouts.profle-layout')

@section('title', 'Profil Pondok')
@section('content')
    <div class="flex flex-col">

        <h1 class="font-bold text-2xl md:text-3xl lg:text-4xl">Sejarah Pondok</h1>
        <h2 class="font-semibold my-3 text-sm md:text-md lg:text-xl">Sejarah singkat pondok pesantren Darul
            Ihsan
            Muhammadiyah Sragen
        </h2>
        <p class="text-gray-700 text-justify text-sm md:text-base lg:text-lg">Pondok Pesantren Darul Ihsan Muhammadiyah
            Sragen
            (DIMSA)
            memiliki perjalanan panjang yang
            dimulai
            sejak
            tahun 1989,
            dengan tujuan mencetak kader persyarikatan Muhammadiyah yang unggul di Kabupaten Sragen. Melalui sejumlah
            inovasi
            dan perkembangan yang signifikan, DIMSA telah tumbuh menjadi lembaga pendidikan yang mengintegrasikan ilmu umum
            dan
            ilmu agama, dengan berbagai perubahan dan kemajuan fasilitas serta jenjang pendidikan.

        </p>
        <div class="flex justify-center my-8">
            <img src="https://placehold.co/1200x300/e2e8f0/334155?text=Image" alt="Placeholder Selayang Pandang"
                class="w-full rounded-lg shadow-md">
        </div>
        <h2 class="font-semibold text-lg md:text-xl lg:text-2xl">Awal Pendirian</h2>
        <p class="text-gray-700 text-justify mt-3 mb-6 text-sm md:text-base lg:text-lg">Pada tahun 1989, Pimpinan Daerah
            Muhammadiyah
            Kabupaten Sragen di bawah
            kepemimpinan Ustadz KH
            Muthiudin, B.Sc, mulai menginisiasi pentingnya penyiapan kader untuk keberlanjutan persyarikatan Muhammadiyah di
            Sragen. Sebagai langkah awal, direncanakanlah study banding ke beberapa pondok pesantren Muhammadiyah, di
            antaranya Ponpes Paciran Lamongan, Ponpes Al-Mukmin, dan Ponpes Darul Arqom Garut, dengan Ustadz Drs. KH. Sururi
            sebagai penanggung jawab. Nama awal yang digunakan adalah Pondok Pesantren Muhammadiyah Sragen (PPMS), yang
            menerapkan konsep pondok kalong, di mana santri menempuh pendidikan formal di luar pondok pada pagi hari dan
            belajar agama di pondok pada malam hari. Lokasi pertama PPMS adalah di Jalan Yos Sudarso, yang sekarang menjadi
            Gedung Dakwah PDM Sragen.</p>

        <h2 class="font-semibold text-lg md:text-xl lg:text-2xl">Perkembangan Pendidikan dan Pendirian DIMSA</h2>
        <p class="text-gray-700 text-justify mt-3 text-sm md:text-base lg:text-lg">Seiring waktu, jumlah santri terus
            bertambah, meskipun
            pondok belum memiliki tanah
            sendiri,
            sehingga beberapa kali berpindah lokasi. Pada tahun 1997, PDM Sragen mendapatkan wakaf tanah dari Bapak Ihsan
            Triyono, seorang tokoh Majelis Dikdasmen, di Dusun Pringan, Karangtengah, Sragen, yang menjadi lokasi tetap
            pondok. Tahun 2001 menjadi momen penting ketika sistem pendidikan pondok berinovasi dari konsep pondok kalong
            menjadi sistem pendidikan terpadu. Berdirilah Madrasah Tsanawiyah (MTs) dengan nama resmi Ponpes Darul Ihsan
            Muhammadiyah Sragen (DIMSA), disusul dengan pendirian SMA Darul Ihsan pada tahun 2006 dan Madrasah Aliyah Darul
            Ihsan pada tahun 2022, menjadikan DIMSA sebagai pondok yang berpengaruh di Kabupaten Sragen dan sekitarnya.</p>
    </div>
    <hr class="my-10 border-t-2 border-gray-200">
    <div class="flex flex-row justify-between md:flex-row lg:justify-between">
        <div class="flex flex-col cursor-pointer md:w-1/2 lg:w-auto lg:mr-10"
            onclick="location.href='{{ route('guest.selayang-pandang') }}'">
            <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800"><i
                    class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
            <h1 class="font-bold text-sm md:text-base lg:text-lg">Selayang Pandang</h1>
        </div>
        <div class="flex flex-col items-end cursor-pointer md:w-1/2 lg:w-auto lg:ml-10"
            onclick="location.href='{{ route('guest.visi-misi') }}'">
            <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                    class="fa-solid fa-arrow-right ml-2"></i></p>
            <h1 class="font-bold text-sm md:text-base lg:text-lg">Visi & Misi</h1>
        </div>
    </div>
@endsection
