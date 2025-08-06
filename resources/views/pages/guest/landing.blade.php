@extends('layouts.app')

{{-- Isi judul halaman yang spesifik untuk halaman ini --}}
@section('title', 'DIMSA - Halaman Utama')

@section('content')
    <section id="hero" class="hero w-full h-screen bg-cover bg-center"
        style="background-image: url('{{ asset('images/thumbnail.jpeg') }}');">
        <div class="flex items-center justify-center h-full bg-black bg-opacity-50">
            <div class="text-center text-white p-8">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang di DIMSA</h1>
                <p class="text-lg md:text-xl mb-8">Ponpes Darul Ihsan Muhammadiyah Sragen</p>
    </section>

    <section id="tentang" class="mx-20 py-16 sm:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col lg:flex-row gap-12">

                <div class="w-full lg:w-1/3 self-start">
                    <div class="lg:sticky top-24">
                        <p class="text-sm text-gray-500 mb-2">Selayang Pandang</p>

                        <img src="https://placehold.co/600x400/e2e8f0/334155?text=Foto+Mudir" alt="Foto Mudir Ponpes DIMSA"
                            class="w-full h-72 object-cover rounded-xl shadow-lg">
                    </div>
                </div>

                <div class="w-full lg:w-2/3 flex flex-col gap-y-6">
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">
                        Sambutan Mudir Ponpes DIMSA
                    </h1>
                    <p class="text-base text-gray-600 leading-relaxed text-justify">
                        Selamat datang di Pondok Pesantren Darul Ihsan Muhammadiyah Sragen, tempat di mana pendidikan dan
                        pengembangan karakter santri menjadi prioritas utama. Kami percaya bahwa pendidikan adalah fondasi
                        yang membentuk masa depan individu dan masyarakat. Di Pondok Pesantren Darul Ihsan, kami berkomitmen
                        untuk menciptakan lingkungan belajar yang positif dan inspiratif, di mana setiap santri dapat
                        mengembangkan potensi diri mereka secara maksimal.
                    </p>

                    <a href="#"
                        class="inline-block w-full sm:w-auto text-center px-6 py-3 font-medium text-gray-800 border border-gray-800 rounded-lg hover:bg-gray-800 hover:text-white transition-colors duration-200 mt-auto">
                        Selengkapnya &gt;
                    </a>
                </div>


            </div>
        </div>
    </section>

    <section id="video-profile" class="h-screen bg-gray-100 flex flex-col items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-5xl text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-8">
                Video Profile
            </h2>
            <div class="rounded-lg shadow-xl overflow-hidden">
                <iframe class="w-full aspect-video" src="https://www.youtube.com/embed/U25Nbeyfn8A?start=2"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>

    <section id="lembaga-akademik" class="mx-20 py-16 sm:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <p class="text-sm text-gray-500 mb-2">Lembaga Akademik</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 mt-4">

                    <!-- SMP -->
                    <a href="#" class="group no-underline">
                        <div class="flex flex-col gap-3">
                            <div class="overflow-hidden rounded-xl">
                                <img src="https://placehold.co/800x600/a5b4fc/1e293b?text=Gedung+SMP"
                                    alt="Gedung SMP Darul Ihsan"
                                    class="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="flex flex-col items-start gap-2">
                                <h4 class="text-white bg-blue-800 px-6 py-2 rounded-full text-lg font-semibold">
                                    SMP
                                </h4>
                                <h4 class="text-xl font-semibold text-gray-900">
                                    Darul Ihsan Muhammadiyah Sragen
                                </h4>
                            </div>
                        </div>
                    </a>

                    <!-- MA -->
                    <a href="#" class="group no-underline">
                        <div class="flex flex-col gap-3">
                            <div class="overflow-hidden rounded-xl">
                                <img src="https://placehold.co/800x600/6ee7b7/1e293b?text=Gedung+MA"
                                    alt="Gedung MA Darul Ihsan"
                                    class="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="flex flex-col items-start gap-2">
                                <h4 class="text-white bg-green-700 px-6 py-2 rounded-full text-lg font-semibold">
                                    MA
                                </h4>
                                <h4 class="text-xl font-semibold text-gray-900">
                                    Darul Ihsan Muhammadiyah Sragen
                                </h4>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </section>

    <section id="kerja-sama" class="py-16 sm:py-24 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-sm text-gray-500 mb-2 text-center">Kerja Sama</p>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 text-center mb-12">
                Dipercaya oleh Mitra Terkemuka
            </h2>
            <div class="relative w-full overflow-hidden group">
                <div class="absolute top-0 left-0 z-10 w-24 h-full bg-gradient-to-r from-gray-50 to-transparent"></div>
                <div class="absolute top-0 right-0 z-10 w-24 h-full bg-gradient-to-l from-gray-50 to-transparent"></div>

                <div class="flex flex-nowrap scrolling-logos">
                    <!-- Set Logo Pertama (untuk di-loop) -->
                    <img src="https://placehold.co/200x100/d1d5db/374151?text=Partner+1" alt="Logo Partner 1"
                        class="h-12 sm:h-16 mx-8 flex-shrink-0">
                    <img src="https://placehold.co/200x100/d1d5db/374151?text=Partner+2" alt="Logo Partner 2"
                        class="h-12 sm:h-16 mx-8 flex-shrink-0">
                    <img src="https://placehold.co/200x100/d1d5db/374151?text=Partner+3" alt="Logo Partner 3"
                        class="h-12 sm:h-16 mx-8 flex-shrink-0">
                    <img src="https://placehold.co/200x100/d1d5db/374151?text=Partner+4" alt="Logo Partner 4"
                        class="h-12 sm:h-16 mx-8 flex-shrink-0">
                    <img src="https://placehold.co/200x100/d1d5db/374151?text=Partner+5" alt="Logo Partner 5"
                        class="h-12 sm:h-16 mx-8 flex-shrink-0">
                    <img src="https://placehold.co/200x100/d1d5db/374151?text=Partner+6" alt="Logo Partner 6"
                        class="h-12 sm:h-16 mx-8 flex-shrink-0">

                    <!-- Set Logo Kedua (Duplikat untuk efek seamless) -->
                    <img src="https://placehold.co/200x100/d1d5db/374151?text=Partner+1" alt="Logo Partner 1"
                        class="h-12 sm:h-16 mx-8 flex-shrink-0">
                    <img src="https://placehold.co/200x100/d1d5db/374151?text=Partner+2" alt="Logo Partner 2"
                        class="h-12 sm:h-16 mx-8 flex-shrink-0">
                    <img src="https://placehold.co/200x100/d1d5db/374151?text=Partner+3" alt="Logo Partner 3"
                        class="h-12 sm:h-16 mx-8 flex-shrink-0">
                    <img src="https://placehold.co/200x100/d1d5db/374151?text=Partner+4" alt="Logo Partner 4"
                        class="h-12 sm:h-16 mx-8 flex-shrink-0">
                    <img src="https://placehold.co/200x100/d1d5db/374151?text=Partner+5" alt="Logo Partner 5"
                        class="h-12 sm:h-16 mx-8 flex-shrink-0">
                    <img src="https://placehold.co/200x100/d1d5db/374151?text=Partner+6" alt="Logo Partner 6"
                        class="h-12 sm:h-16 mx-8 flex-shrink-0">
                </div>
            </div>
        </div>
    </section>

    <section id="agenda" class="px-20 bg-slate-900 text-white py-16 sm:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <header class="mb-8">
                <h5 class="text-base font-semibold text-slate-300">Agenda DIMSA</h5>
            </header>
            <main class="flex flex-col md:flex-row md:items-end md:justify-between gap-12">
                <!-- Kolom Teks -->
                <article class="w-full md:w-1/2 flex flex-col gap-4">
                    <h2 class="text-3xl sm:text-4xl font-bold">Dimsa Fantastic Show #4</h2>
                    <p class="text-lg text-slate-300">25 Jan 2024 - 09:00 WIB</p>
                    <p class="flex items-center gap-2 text-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        Hall Umar Bin Khattab
                    </p>
                </article>
                <!-- Kolom Gambar -->
                <article class="w-full md:w-1/2">
                    <img src="https://placehold.co/800x600/1e293b/ffffff?text=Acara+Agenda" alt="Foto Acara Agenda DIMSA"
                        class="w-full h-96 object-cover rounded-xl shadow-lg">
                </article>
            </main>
        </div>
    </section>

    <!-- Section Berita Terbaru -->
    <section id="berita" class="mx-20 py-16 sm:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <header class="flex justify-between items-center mb-8">
                <h3 class="text-3xl sm:text-4xl font-bold text-gray-800">Apa yang terjadi di DIMSA</h3>
                <a href="#" class="text-blue-600 hover:underline font-medium whitespace-nowrap">Selengkapnya
                    &gt;</a>
            </header>
            <main class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                <!-- Kolom Kiri: Artikel Utama -->
                <article class="w-full lg:w-2/3 group cursor-pointer">
                    <div class="overflow-hidden rounded-xl mb-4">
                        <img src="https://placehold.co/1200x800/94a3b8/1e293b?text=Berita+Utama" alt="Berita Utama"
                            class="w-full h-[500px] object-cover transition-transform duration-300 group-hover:scale-105">
                    </div>
                    <p class="text-sm text-gray-500 mb-2 select-none">Kabar Dimsa &bull; 06 Agu, 2025</p>
                    <h3 class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors select-none">
                        Judul Berita Utama yang Menarik Perhatian Pembaca</h3>
                </article>
                <!-- Kolom Kanan: Daftar Artikel Lainnya -->
                <article class="w-full lg:w-1/3 flex flex-col gap-y-6">
                    <!-- Berita 1 -->
                    <div class="flex gap-4 w-full group cursor-pointer">
                        <img src="https://placehold.co/400x400/bbf7d0/1e293b?text=Info" alt="Berita 1"
                            class="w-1/3 h-32 object-cover rounded-xl">
                        <div class="w-2/3 flex flex-col justify-center">
                            <p class="text-xs text-gray-500 mb-1 select-none">Prestasi &bull; 05 Agu, 2025</p>
                            <h6
                                class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors select-none">
                                Siswa DIMSA Raih Juara 1 Lomba Robotik Nasional</h6>
                        </div>
                    </div>
                    <!-- Berita 2 -->
                    <div class="flex gap-4 w-full group cursor-pointer">
                        <img src="https://placehold.co/400x400/fecaca/1e293b?text=Info" alt="Berita 2"
                            class="w-1/3 h-32 object-cover rounded-xl">
                        <div class="w-2/3 flex flex-col justify-center">
                            <p class="text-xs text-gray-500 mb-1 select-none">Kegiatan &bull; 04 Agu, 2025</p>
                            <h6
                                class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors select-none">
                                Kegiatan Bakti Sosial di Desa Binaan Berjalan Sukses</h6>
                        </div>
                    </div>
                    <!-- Berita 3 -->
                    <div class="flex gap-4 w-full group cursor-pointer">
                        <img src="https://placehold.co/400x400/c7d2fe/1e293b?text=Info" alt="Berita 3"
                            class="w-1/3 h-32 object-cover rounded-xl">
                        <div class="w-2/3 flex flex-col justify-center">
                            <p class="text-xs text-gray-500 mb-1 select-none">Kajian &bull; 03 Agu, 2025</p>
                            <h6
                                class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors select-none">
                                Kajian Rutin Membahas Pentingnya Akhlak dalam Islam</h6>
                        </div>
                    </div>
                    <!-- Berita 4 -->
                    <div class="flex gap-4 w-full group cursor-pointer">
                        <img src="https://placehold.co/400x400/fde68a/1e293b?text=Info" alt="Berita 4"
                            class="w-1/3 h-32 object-cover rounded-xl">
                        <div class="w-2/3 flex flex-col justify-center">
                            <p class="text-xs text-gray-500 mb-1 select-none">Artikel &bull; 02 Agu, 2025</p>
                            <h6
                                class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors select-none">
                                Tips Menghafal Al-Quran dengan Metode Terkini</h6>
                        </div>
                    </div>
                </article>
            </main>
        </div>
    </section>

    <!-- Section Testimoni Alumni -->
    <section id="testimoni" class="mx-20 py-16 sm:py-24 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <header class="flex justify-between items-center mb-8">
                <h3 class="text-3xl sm:text-4xl font-bold text-gray-800">Testimoni Alumni</h3>
                <a href="#" class="text-blue-600 hover:underline font-medium whitespace-nowrap">Selengkapnya
                    &gt;</a>
            </header>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimoni 1 -->
                <div class="flex flex-col bg-white p-8 rounded-xl shadow-lg">
                    <p class="text-gray-600 italic flex-grow">"Pendidikan di DIMSA tidak hanya membentuk akademis, tetapi
                        juga karakter. Saya belajar banyak tentang kepemimpinan, kemandirian, dan nilai-nilai Islam yang
                        kuat."</p>
                    <div class="flex items-center gap-4 mt-6 pt-6 border-t border-gray-200">
                        <img src="https://placehold.co/100x100/e0e7ff/3730a3?text=A" alt="Foto Alumni 1"
                            class="w-16 h-16 object-cover rounded-full">
                        <div>
                            <h6 class="font-semibold text-gray-900">Ahmad Fauzi</h6>
                            <p class="text-sm text-gray-500">Alumni 2020</p>
                        </div>
                    </div>
                </div>
                <!-- Testimoni 2 -->
                <div class="flex flex-col bg-white p-8 rounded-xl shadow-lg">
                    <p class="text-gray-600 italic flex-grow">"Lingkungan yang sangat mendukung untuk menghafal Al-Quran
                        dan mendalami ilmu agama. Guru-gurunya sangat sabar dan berdedikasi. Pengalaman yang tak
                        terlupakan."</p>
                    <div class="flex items-center gap-4 mt-6 pt-6 border-t border-gray-200">
                        <img src="https://placehold.co/100x100/dcfce7/15803d?text=F" alt="Foto Alumni 2"
                            class="w-16 h-16 object-cover rounded-full">
                        <div>
                            <h6 class="font-semibold text-gray-900">Fatimah Az-Zahra</h6>
                            <p class="text-sm text-gray-500">Alumni 2021</p>
                        </div>
                    </div>
                </div>
                <!-- Testimoni 3 -->
                <div class="flex flex-col bg-white p-8 rounded-xl shadow-lg">
                    <p class="text-gray-600 italic flex-grow">"Saya mendapatkan bekal ilmu dunia dan akhirat yang seimbang.
                        Program ekstrakurikulernya juga sangat beragam dan membantu mengembangkan bakat."</p>
                    <div class="flex items-center gap-4 mt-6 pt-6 border-t border-gray-200">
                        <img src="https://placehold.co/100x100/ffedd5/9a3412?text=I" alt="Foto Alumni 3"
                            class="w-16 h-16 object-cover rounded-full">
                        <div>
                            <h6 class="font-semibold text-gray-900">Ibrahim Malik</h6>
                            <p class="text-sm text-gray-500">Alumni 2019</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Penerimaan & Literasi -->
    <section class="py-16 sm:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-center items-center gap-8">
                <!-- Kartu Penerimaan Santri Baru -->
                <div
                    class="group relative w-full md:w-[450px] h-[550px] bg-green-800 hover:bg-green-900 rounded-2xl p-8 text-white flex flex-col justify-end overflow-hidden cursor-pointer transition-colors duration-300">
                    <div
                        class="absolute top-14 left-[-150px] group-hover:left-[-80px] transition-all duration-500 ease-in-out">
                        <div class="flex items-center gap-3">
                            <p class="bg-white text-blue-900 font-semibold p-3 rounded-lg whitespace-nowrap">SMP Darul
                                Ihsan</p><img src="https://placehold.co/50x50/091e6f/ffffff?text=S" alt="Icon Gedung"
                                class="bg-blue-900 p-2 rounded-lg w-12 h-12">
                        </div>
                    </div>
                    <div
                        class="absolute top-32 right-[-150px] group-hover:right-[-80px] transition-all duration-500 ease-in-out">
                        <div class="flex items-center gap-3"><img src="https://placehold.co/50x50/ffffff/091e6f?text=M"
                                alt="Icon Gedung" class="bg-white p-2 rounded-lg w-12 h-12">
                            <p class="bg-white text-blue-900 font-semibold p-3 rounded-lg whitespace-nowrap">Muhammadiyah
                            </p>
                        </div>
                    </div>
                    <div>
                        <p class="text-xl">Penerimaan</p>
                        <h5 class="text-3xl font-bold">Santri Baru</h5>
                    </div>
                </div>
                <!-- Kartu Ruang Literasi -->
                <div
                    class="group relative w-full md:w-[450px] h-[550px] bg-gray-100 hover:bg-blue-50 rounded-2xl p-8 flex flex-col justify-start overflow-hidden cursor-pointer transition-colors duration-300">
                    <div class="text-gray-800">
                        <h5 class="text-3xl font-bold">Ruang Literasi</h5>
                        <p class="text-xl text-gray-600">Darul Ihsan Muhammadiyah</p>
                    </div>
                    <img src="https://placehold.co/350x350/ffffff/000000?text=Buku+1" alt="Buku Putih"
                        class="absolute w-[350px] bottom-[-150px] left-[-30px] group-hover:bottom-[-140px] group-hover:left-[-40px] transition-all duration-500 ease-in-out z-10">
                    <img src="https://placehold.co/500x500/fecdd3/000000?text=Buku+2" alt="Buku Pink"
                        class="absolute w-[500px] bottom-[-60px] right-[-25px] group-hover:bottom-[-40px] group-hover:right-0 transition-all duration-500 ease-in-out z-20">
                    <img src="https://placehold.co/480x480/bfdbfe/000000?text=Buku+3" alt="Buku Biru"
                        class="absolute w-[480px] bottom-[-160px] right-[-130px] group-hover:bottom-[-140px] group-hover:right-[-120px] transition-all duration-500 ease-in-out z-30">
                </div>
            </div>
        </div>
    </section>

    <!-- Section Donasi -->
    <section class="pb-16 sm:pb-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div
                    class="flex flex-col md:flex-row items-center bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl shadow-lg w-full max-w-4xl overflow-hidden">
                    <div class="p-8 md:p-12 text-left w-full md:w-7/12">
                        <img src="https://placehold.co/50x50/ffffff/000000?text=L" alt="Logo Lazismu" class="w-12 mb-4">
                        <h2 class="text-2xl md:text-3xl font-bold text-black">Salurkan Harta Terbaikmu,<br>Raih Berkah
                            Ilahi.</h2>
                        <button
                            class="mt-6 bg-black text-white font-semibold py-3 px-8 rounded-lg hover:bg-gray-800 transition-colors">Donasi
                            Sekarang</button>
                    </div>
                    <div class="hidden md:block w-full md:w-5/12">
                        <img src="https://placehold.co/400x300/ffffff/000000?text=Donasi" alt="Kotak Donasi"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')
@endsection
