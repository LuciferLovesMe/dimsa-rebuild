@extends('layouts.profle-layout')

@section('title', 'Profil Pondok')
@section('content')
    <div class="flex flex-col">

        <h1 class="text-3xl font-bold">Sejarah Pondok</h1>
        <h2 class="text-xl font-semibold my-3">Sejarah singkat pondok pesantren Darul Ihsan Muhammadiyah Sragen
        </h2>
        <p class="text-justify">Pondok Pesantren Darul Ihsan Muhammadiyah Sragen (DIMSA) memiliki perjalanan panjang yang
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
        <h2 class="text-xl font-semibold">Awal Pendirian</h2>
        <p class="text-justify mt-3 mb-6">Pada tahun 1989, Pimpinan Daerah Muhammadiyah Kabupaten Sragen di bawah
            kepemimpinan Ustadz KH
            Muthiudin, B.Sc, mulai menginisiasi pentingnya penyiapan kader untuk keberlanjutan persyarikatan Muhammadiyah di
            Sragen. Sebagai langkah awal, direncanakanlah study banding ke beberapa pondok pesantren Muhammadiyah, di
            antaranya Ponpes Paciran Lamongan, Ponpes Al-Mukmin, dan Ponpes Darul Arqom Garut, dengan Ustadz Drs. KH. Sururi
            sebagai penanggung jawab. Nama awal yang digunakan adalah Pondok Pesantren Muhammadiyah Sragen (PPMS), yang
            menerapkan konsep pondok kalong, di mana santri menempuh pendidikan formal di luar pondok pada pagi hari dan
            belajar agama di pondok pada malam hari. Lokasi pertama PPMS adalah di Jalan Yos Sudarso, yang sekarang menjadi
            Gedung Dakwah PDM Sragen.</p>

        <h2 class="text-xl font-semibold">Perkembangan Pendidikan dan Pendirian DIMSA</h2>
        <p class="text-justify mt-3">Seiring waktu, jumlah santri terus bertambah, meskipun pondok belum memiliki tanah
            sendiri,
            sehingga beberapa kali berpindah lokasi. Pada tahun 1997, PDM Sragen mendapatkan wakaf tanah dari Bapak Ihsan
            Triyono, seorang tokoh Majelis Dikdasmen, di Dusun Pringan, Karangtengah, Sragen, yang menjadi lokasi tetap
            pondok. Tahun 2001 menjadi momen penting ketika sistem pendidikan pondok berinovasi dari konsep pondok kalong
            menjadi sistem pendidikan terpadu. Berdirilah Madrasah Tsanawiyah (MTs) dengan nama resmi Ponpes Darul Ihsan
            Muhammadiyah Sragen (DIMSA), disusul dengan pendirian SMA Darul Ihsan pada tahun 2006 dan Madrasah Aliyah Darul
            Ihsan pada tahun 2022, menjadikan DIMSA sebagai pondok yang berpengaruh di Kabupaten Sragen dan sekitarnya.</p>
    </div>
    <hr class="my-10 border-t-2 border-gray-200">
    <div class="flex flex-row justify-between">
        <div class="flex flex-col cursor-pointer" onclick="location.href='{{ route('selayang-pandang') }}'">
            <p class="text-sm text-gray-600 hover:text-gray-800"><i class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
            <h1 class="text-xl font-bold">Selayang Pandang</h1>
        </div>
        <div class="flex flex-col items-end cursor-pointer" onclick="location.href='{{ route('visi-misi') }}'">
            <p class="text-sm text-gray-600 hover:text-gray-800">Berikutnya<i class="fa-solid fa-arrow-right ml-2"></i></p>
            <h1 class="text-xl font-bold">Visi & Misi</h1>
        </div>
    </div>
@endsection
