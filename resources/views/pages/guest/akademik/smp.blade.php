@extends('pages.guest.akademik.layout.akademik-layout')

@section('title', 'DIMSA - Akademik SMP')
@php
    View::share('heroImage', asset('images/smp-bg.webp'));
    View::share('heroTitle', 'Gabung di SMP Darul Ihsan Muhammadiyah Sragen Sekarang');
@endphp

{{-- Tentang --}}
@section('tentang_title', 'Tentang SMP Darul Ihsan Muhammadiyah Sragen')
@section('tentang_body')
    SMP di Pondok Pesantren Darul Ihsan Muhammadiyah Sragen dirancang untuk memberikan pendidikan komprehensif
    yang menggabungkan kurikulum nasional dengan pendidikan agama Islam yang mendalam. Program ini bertujuan
    untuk membentuk siswa dengan fondasi ilmu pengetahuan yang kuat, serta akhlak dan nilai-nilai keislaman yang
    kokoh. Dengan dukungan tenaga pendidik yang berpengalaman dan fasilitas yang memadai, kami memastikan bahwa
    para siswa SMP dapat mengembangkan potensi mereka baik secara akademis maupun spiritual, mempersiapkan
    mereka untuk melanjutkan pendidikan ke jenjang yang lebih tinggi dengan kepercayaan diri dan keterampilan
    yang relevan.
@endsection

{{-- Visi Misi --}}
@section('visi_body', 'Terbentuknya kader Muhammadiyah yang Islami, Berprestasi, dan Terampil')
@section('misi_list')
    <li class="flex items-start">
        <i class="fas fa-check-circle text-blue-600 mt-1 mr-3"></i>
        <span class="text-gray-600">Membudayakan dan membiasakan hidup Islami kepada Warga Sekolah.</span>
    </li>
    <li class="flex items-start">
        <i class="fas fa-check-circle text-blue-600 mt-1 mr-3"></i>
        <span class="text-gray-600">Mewujudkan pembelajaran yang aktif, inovatif, kreatif, edukatif,
            menyenangkan serta integratif.</span>
    </li>
    <li class="flex items-start">
        <i class="fas fa-check-circle text-blue-600 mt-1 mr-3"></i>
        <span class="text-gray-600">Membina dan memperdalam bidang akademik dan keagamaan sehingga berilmu
            pengetahuan luas dan berprestasi unggul.</span>
    </li>
    <li class="flex items-start">
        <i class="fas fa-check-circle text-blue-600 mt-1 mr-3"></i>
        <span class="text-gray-600">Mengembangkan keterampilan dalam Teknologi Informasi, Komputer, Seni
            Baca Al-Qur’an, Seni berpidato dan Berorganisasi.</span>
    </li>
@endsection

{{-- Tujuan --}}
@section('tujuan_list')
    <li>Menghasilkan santri yang berakidah lurus, berakhlakul karimah, serta beribadah yang benar
        berdasarkan Al-Qur’an dan As-Sunnah.</li>
    <li>Menyiapkan santri yang memiliki kepribadian Islam yang mantap, dan mampu menjadi kader dakwah
        Muhammadiyah.</li>
    <li>Terwujudnya proses pembelajaran yang aktif, inovatif, kreatif, edukatif, menyenangkan dan
        integratif.</li>
    <li>Menghasilkan santri yang berilmu pengetahuan luas, berprestasi dan mampu bersaing untuk melanjutkan
        ke jenjang pendidikan yang lebih tinggi.</li>
    <li>Menyiapkan santri yang mampu menjadi pelopor pelangsung dan penyempurna nilai-nilai Islam khususnya
        melalui pengalaman berorganisasi di ortom Muhammadiyah.</li>
    <li>Membekali santri dengan berbagai keterampilan seperti bahasa, komputer, seni baca Al-Qur’an dan
        jurnalistik.</li>
@endsection
