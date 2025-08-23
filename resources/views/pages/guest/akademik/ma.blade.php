@extends('pages.guest.akademik.layout.akademik-layout')

@section('title', 'DIMSA - Akademik MA')

@php
    View::share('heroImage', asset('images/ma-bg.webp'));
    View::share('heroTitle', 'Gabung di MA Darul Ihsan Muhammadiyah Sragen Sekarang');
@endphp

@section('tentang_title', 'Tentang MA Darul Ihsan Muhammadiyah Sragen')
@section('tentang_body')
    MA di Pondok Pesantren Darul Ihsan Muhammadiyah Sragen menawarkan program pendidikan lanjutan yang mengintegrasikan
    pelajaran umum dan agama secara seimbang. Di tingkat MA, siswa dibekali dengan pengetahuan mendalam dan keterampilan
    berpikir kritis sambil memperkuat fondasi keimanan dan akhlak. Program ini dirancang untuk mempersiapkan siswa
    menghadapi tantangan masa depan dengan kompetensi akademis yang tinggi, kemampuan berbahasa asing, serta keterampilan
    tambahan seperti teknologi dan organisasi. Tujuan kami adalah mencetak lulusan yang cerdas, berprestasi, dan siap
    berkontribusi positif di masyarakat maupun dalam karier profesional mereka Quis aute iure reprehenderit in.
@endsection

@section('visi_body', 'Mencetak kader Ulama Muhammadiyah yang Bertaqwa, Berjiwa Leadership dan Berwawasan Global.')
@section('misi_list')
    <li class="flex items-start">
        <i class="fas fa-check-circle text-blue-600 mt-1 mr-3"></i>
        <span class="text-gray-600">Membentuk karakter siswa yang sesuai dengan al Qur’an dan as Sunnah.</span>
    </li>
    <li class="flex items-start">
        <i class="fas fa-check-circle text-blue-600 mt-1 mr-3"></i>
        <span class="text-gray-600">Membentuk kader persyarikatan yang siap menjadi pemimpin.</span>
    </li>
    <li class="flex items-start">
        <i class="fas fa-check-circle text-blue-600 mt-1 mr-3"></i>
        <span class="text-gray-600">Menjamin tenaga pendidik yang profesional dan inovatif.</span>
    </li>
    <li class="flex items-start">
        <i class="fas fa-check-circle text-blue-600 mt-1 mr-3"></i>
        <span class="text-gray-600">Memfasilitasi sarana dan prasarana pendidikan yang berkualitas dan nyaman.</span>
    </li>
    <li class="flex items-start">
        <i class="fas fa-check-circle text-blue-600 mt-1 mr-3"></i>
        <span class="text-gray-600">Mewujudkan pembelajaran yang menggembirakan dan berkemajuan.
        </span>
    </li>
@endsection

@section('tujuan_list')
    <li>
        Menghasilkan generasi yang berkualitas untuk memperoleh prestasi akademik maupun non akademik.
    </li>
    <li>
        Menghasilkan generasi yang disiplin dalam belajar sehingga memperoleh prestasi yang optimal.
    </li>
    <li>
        Menghasilkan generasi muda yang memiliki life skill sebagai bekal hidup mandiri.
    </li>
    <li>
        Menghasilkan generasi muda yang berperilaku islami dan berakhlak mulia baik di lingkungan madrasah maupun lingkungan
        masyarakat.
    </li>
    <li>
        Menghasilkan budaya Himmatu at Ta’allum, Leadership dan Uswah Hasnah di lingkungan Madrasah.
    </li>
@endsection
