@extends('layouts.app')

@section('title', 'DIMSA - Halaman Utama')

@php
    $heroData = [
        ['backgroundImage' => asset('images/thumbnail.jpeg'), 'headline' => 'APEL AWAL SEMESTER GENAP TP 2024/2025'],
        ['backgroundImage' => asset('images/mpls.webp'), 'headline' => 'MPLS TP 2024/2025'],
    ];

    $lastNews = [
        'image' => 'https://placehold.co/150x100/e2e8f0/334155?text=Kabar+Dimsa',
        'category' => 'Kabar Dimsa',
        'title' => 'Santri MA Dimsa Kibarkan Merah Putih di Puncak Lawu, Rayakan HUT RI ke-80 dengan Semangat Juang',
        'date' => '06 Agu, 2025',
        'url' => '#',
    ];

    $mitraData = [
        ['logo' => 'https://placehold.co/200x100/d1d5db/374151?text=Partner+1', 'name' => 'Partner 1'],
        ['logo' => 'https://placehold.co/200x100/d1d5db/374151?text=Partner+2', 'name' => 'Partner 2'],
        ['logo' => 'https://placehold.co/200x100/d1d5db/374151?text=Partner+3', 'name' => 'Partner 3'],
        ['logo' => 'https://placehold.co/200x100/d1d5db/374151?text=Partner+4', 'name' => 'Partner 4'],
        ['logo' => 'https://placehold.co/200x100/d1d5db/374151?text=Partner+5', 'name' => 'Partner 5'],
        ['logo' => 'https://placehold.co/200x100/d1d5db/374151?text=Partner+6', 'name' => 'Partner 6'],
        ['logo' => 'https://placehold.co/200x100/d1d5db/374151?text=Partner+7', 'name' => 'Partner 7'],
        ['logo' => 'https://placehold.co/200x100/d1d5db/374151?text=Partner+8', 'name' => 'Partner 8'],
    ];

    $agendaData = [
        'image' => 'https://placehold.co/400x250/e2e8f0/334155?text=Agenda+Dimsa',
        'title' => 'Dimsa Fantastic Show #4',
        'date' => '25 Desember 2024',
        'time' => '09:00 WIB',
        'location' => 'Hall Umar Bin Khattab',
    ];

    $news = [
        [
            'image' => 'https://placehold.co/150x100/ffd700/000000?text=info',
            'title' => 'Siswa DIMSA Raih Juara 1 Lomba Robotik Nasional',
            'date' => '10 September 2024',
            'url' => '#',
        ],

        [
            'image' => 'https://placehold.co/150x100/6495ed/ffffff?text=info',
            'title' => 'Kegiatan Bakti Sosial Santri DIMSA di Desa Tertinggal',
            'date' => '4 Agustus 2024',
            'url' => '#',
        ],

        [
            'image' => 'https://placehold.co/150x100/66cc00/000000?text=info',
            'title' => 'Kajian Rutin Ahad Pagi Bersama Ustadz Ahmad Fauzi',
            'date' => '2 Agustus 2024',
            'url' => '#',
        ],

        [
            'image' => 'https://placehold.co/150x100/ff69b4/ffffff?text=info',
            'title' => 'Tips Menghafal Al-Qur\'an dengan Metode Efektif',
            'date' => '31 Juli 2024',
            'url' => '#',
        ],
    ];

    $testimonials = [
        [
            'testimoni' =>
                'Pendidikan di DIMSA tidak hanya membentuk akademis, tetapi juga karakter. Saya belajar banyak tentang kepemimpinan, kemandirian, dan nilai-nilai Islam yang kuat.',
            'profile' => [
                'name' => 'Ahmad Fauzi',
                'graduate' => 'Alumni DIMSA 2020',
                'image' => 'https://placehold.co/100x100/000000/ffffff?text=Foto+Alumni',
            ],
        ],

        [
            'testimoni' =>
                'Lingkungan yang sangat mendukung untuk menghafal Al-Quran dan mendalami ilmu agama. Guru-gurunya sangat sabar dan berdedikasi. Pengalaman yang tak terlupakan.',
            'profile' => [
                'name' => 'Fatimah Az-Zahra',
                'graduate' => 'Alumni DIMSA 2021',
                'image' => 'https://placehold.co/100x100/000000/ffffff?text=Foto+Alumni',
            ],
        ],

        [
            'testimoni' =>
                'Saya mendapatkan bekal ilmu dunia dan akhirat yang seimbang. Program ekstrakurikulernya juga sangat beragam dan membantu mengembangkan bakat.',
            'profile' => [
                'name' => 'Ibrahim Malik',
                'graduate' => 'Alumni DIMSA 2019',
                'image' => 'https://placehold.co/100x100/000000/ffffff?text=Foto+Alumni',
            ],
        ],
    ];
@endphp

@section('content')
    {{-- Hero Section --}}
    <section id="hero" x-data="{
        slides: {{ json_encode($heroData) }},
        activeSlide: 0,
        interval: null,
        startSlideshow() {
            this.interval = setInterval(() => {
                this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            }, 10000);
        }
    }" x-init="startSlideshow()"
        class="hero w-full h-screen relative overflow-hidden">

        <!-- Background Slides -->
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index" x-transition:enter="transition-opacity ease-in-out duration-1000"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in-out duration-1000" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full bg-cover bg-center"
                :style="`background-image: url('${slide.backgroundImage}')`">
            </div>
        </template>

        <!-- Overlay and Content -->
        <div
            class="relative flex flex-col justify-end h-full bg-gradient-to-t from-black/60 via-black/20 to-transparent p-4 sm:p-8 lg:p-20">

            {{-- Wrapper untuk konten bawah --}}
            <div class="flex w-full items-end justify-between">
                {{-- Konten Utama Hero (Kiri Bawah) --}}
                <div class="w-full md:w-1/2 lg:w-2/5">
                    {{-- Judul Utama (Dinamis) --}}
                    <div class="relative h-24 mb-4">
                        <template x-for="(slide, index) in slides" :key="index">
                            <h1 x-show="activeSlide === index"
                                x-transition:enter="transition-opacity ease-in-out duration-1000"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition-opacity ease-in-out duration-1000 absolute"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight">
                                <span x-text="slide.headline"></span>
                            </h1>
                        </template>
                    </div>

                    {{-- Widget Berita Terbaru (Statis) --}}
                    <div
                        class="bg-slate-900/30 backdrop-blur-lg text-white p-4 rounded-xl shadow-lg flex items-center gap-4">
                        <img src="{{ $lastNews['image'] }}" alt="Berita Terbaru"
                            class="w-32 h-24 object-cover rounded-lg flex-shrink-0">
                        <div class="flex flex-col">
                            <p class="bg-white text-blue-800 text-xs font-semibold px-3 py-1 rounded-full self-start mb-2">
                                {{ $lastNews['category'] }}</p>
                            <h3 class="text-sm font-semibold leading-tight">{{ $lastNews['title'] }}</h3>
                            <a href="{{ $lastNews['url'] }}"
                                class="text-xs text-white/80 hover:underline mt-2 inline-block">Lihat Detail &gt;</a>
                        </div>
                    </div>
                </div>

                {{-- Ikon Media Sosial (Statis) --}}
                <div class="hidden md:flex flex-col items-center gap-y-4">
                    <a href="#"
                        class="bg-black/40 text-white rounded-full p-2 hover:bg-white hover:text-blue-800 transition-colors">
                        <i class="fab fa-facebook-f fa-fw text-lg"></i>
                    </a>
                    <a href="#"
                        class="bg-black/40 text-white rounded-full p-2 hover:bg-white hover:text-pink-600 transition-colors">
                        <i class="fab fa-instagram fa-fw text-lg"></i>
                    </a>
                    <a href="#"
                        class="bg-black/40 text-white rounded-full p-2 hover:bg-white hover:text-red-600 transition-colors">
                        <i class="fab fa-youtube fa-fw text-lg"></i>
                    </a>
                    <a href="#"
                        class="bg-black/40 text-white rounded-full p-2 hover:bg-white hover:text-black transition-colors">
                        <i class="fab fa-tiktok fa-fw text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="py-16 sm:py-20 md:py-24">
        <div class="container mx-auto px-4 sm:px-8 lg:px-20">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                <div class="w-full lg:w-1/3 self-start">
                    <div class="lg:sticky top-24">
                        <p class="text-xs sm:text-sm text-gray-500 mb-2">Selayang Pandang</p>
                        <img src="{{ asset('images/pimpinan.webp') }}" alt="Foto Mudir Ponpes DIMSA"
                            class="w-full h-48 sm:h-72 object-cover rounded-xl shadow-lg">
                    </div>
                </div>
                <div class="w-full lg:w-2/3 flex flex-col gap-y-4 sm:gap-y-6">
                    <h1 class="text-xl sm:text-3xl md:text-4xl font-bold text-gray-800">
                        Sambutan Mudir Ponpes DIMSA
                    </h1>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed text-justify">
                        Selamat datang di Pondok Pesantren Darul Ihsan Muhammadiyah Sragen, tempat di mana pendidikan dan
                        pengembangan karakter santri menjadi prioritas utama. Kami percaya bahwa pendidikan adalah fondasi
                        yang membentuk masa depan individu dan masyarakat. Di Pondok Pesantren Darul Ihsan, kami berkomitmen
                        untuk menciptakan lingkungan belajar yang positif dan inspiratif, di mana setiap santri dapat
                        mengembangkan potensi diri mereka secara maksimal.
                    </p>
                    <a href="{{ route('selayang-pandang') }}"
                        class="inline-block w-full sm:w-auto text-center px-4 sm:px-6 py-2 sm:py-3 font-medium text-gray-800 border border-gray-800 rounded-lg hover:bg-gray-800 hover:text-white transition-colors duration-200 mt-auto">
                        Selengkapnya &gt;
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="video-profile" class="bg-gray-100 py-16 sm:py-20 md:py-24">
        <div class="container mx-auto px-4 sm:px-8 lg:px-20 text-center">
            <h2 class="text-xl sm:text-3xl md:text-4xl font-bold text-gray-800 mb-4 sm:mb-8">
                Video Profile
            </h2>
            <div class="max-w-5xl mx-auto rounded-lg shadow-xl overflow-hidden">
                <iframe class="w-full aspect-video" src="https://www.youtube.com/embed/U25Nbeyfn8A?start=2"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>

    <section id="lembaga-akademik" class="py-16 sm:py-20 md:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-8 lg:px-20">
            <p class="text-xs sm:text-sm text-gray-500 mb-2">Lembaga Akademik</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-12 mt-4">

                <!-- SMP -->
                <a href="#" class="group no-underline">
                    <div class="flex flex-col gap-2 sm:gap-3">
                        <div class="overflow-hidden rounded-xl">
                            <img src="{{ asset('images/smp-bg.webp') }}" alt="Gedung SMP Darul Ihsan"
                                class="w-full h-40 sm:h-72 object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="flex flex-col items-start gap-1 sm:gap-2">
                            <h4
                                class="text-white bg-blue-800 px-4 sm:px-6 py-1 sm:py-2 rounded-full text-base sm:text-lg font-semibold">
                                SMP
                            </h4>
                            <h4 class="text-lg sm:text-xl font-semibold text-gray-900">
                                Darul Ihsan Muhammadiyah Sragen
                            </h4>
                        </div>
                    </div>
                </a>

                <!-- MA -->
                <a href="#" class="group no-underline">
                    <div class="flex flex-col gap-2 sm:gap-3">
                        <div class="overflow-hidden rounded-xl">
                            <img src="{{ asset('images/ma-bg.webp') }}" alt="Gedung MA Darul Ihsan"
                                class="w-full h-40 sm:h-72 object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="flex flex-col items-start gap-1 sm:gap-2">
                            <h4
                                class="text-white bg-green-700 px-4 sm:px-6 py-1 sm:py-2 rounded-full text-base sm:text-lg font-semibold">
                                MA
                            </h4>
                            <h4 class="text-lg sm:text-xl font-semibold text-gray-900">
                                Darul Ihsan Muhammadiyah Sragen
                            </h4>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </section>

    @if (!empty($mitraData))
        <section id="kerja-sama" class="py-16 sm:py-20 md:py-24 bg-gray-50">
            <div class="container mx-auto px-4 sm:px-8 lg:px-20">
                <p class="text-xs sm:text-sm text-gray-500 mb-2 text-center">Kerja Sama</p>
                <h2 class="text-xl sm:text-3xl md:text-4xl font-bold text-gray-800 text-center mb-6 sm:mb-12">
                    Dipercaya oleh Mitra Terkemuka
                </h2>
                <div class="relative w-full overflow-hidden group">
                    <div
                        class="absolute top-0 left-0 z-10 w-12 sm:w-24 h-full bg-gradient-to-r from-gray-50 to-transparent">
                    </div>
                    <div
                        class="absolute top-0 right-0 z-10 w-12 sm:w-24 h-full bg-gradient-to-l from-gray-50 to-transparent">
                    </div>

                    <div
                        class="flex flex-nowrap @if (count($mitraData) > 6) animate-scroll @else justify-center @endif">
                        {{-- Loop pertama untuk logo asli --}}
                        @foreach ($mitraData as $mitra)
                            <img src="{{ $mitra['logo'] }}" alt="Logo {{ $mitra['name'] }}"
                                class="h-12 sm:h-16 mx-8 flex-shrink-0">
                        @endforeach

                        {{-- Loop kedua (duplikat) hanya jika animasi aktif --}}
                        @if (count($mitraData) > 6)
                            @foreach ($mitraData as $mitra)
                                <img src="{{ $mitra['logo'] }}" alt="Logo {{ $mitra['name'] }}"
                                    class="h-12 sm:h-16 mx-8 flex-shrink-0">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Agenda --}}
    <section id="agenda" class="bg-slate-900 text-white py-16 sm:py-20 md:py-24">
        <div class="container mx-auto px-4 sm:px-8 lg:px-20">
            <header class="mb-4 sm:mb-8">
                <h5 class="text-sm sm:text-base font-semibold text-slate-300">Agenda DIMSA</h5>
            </header>
            <main class="flex flex-col md:flex-row md:items-end md:justify-between gap-8 md:gap-12">
                <!-- Kolom Teks -->
                <article class="w-full md:w-1/2 flex flex-col gap-2 sm:gap-4">
                    <h2 class="text-xl sm:text-3xl md:text-4xl font-bold">{{ $agendaData['title'] }}</h2>
                    <p class="text-base sm:text-lg text-slate-300">{{ $agendaData['date'] }} - {{ $agendaData['time'] }}
                    </p>
                    <p class="flex items-center gap-2 text-slate-200 text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $agendaData['location'] }}
                    </p>
                </article>
                <!-- Kolom Gambar -->
                <article class="w-full md:w-1/2">
                    <img src="{{ $agendaData['image'] }}" alt="Foto Acara Agenda DIMSA"
                        class="w-full h-48 sm:h-96 object-cover rounded-xl shadow-lg">
                </article>
            </main>
        </div>
    </section>

    <!-- Section Berita Terbaru -->
    <section id="berita" class="py-16 sm:py-20 md:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-8 lg:px-20">
            <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-8 gap-2">
                <h3 class="text-xl sm:text-3xl md:text-4xl font-bold text-gray-800">Apa yang terjadi di DIMSA</h3>
                <a href="#"
                    class="text-blue-600 hover:underline font-medium whitespace-nowrap text-sm sm:text-base hidden sm:block">Selengkapnya
                    &gt;</a>
            </header>
            <main class="flex flex-col lg:flex-row gap-6 lg:gap-12">
                <!-- Kolom Kiri: Artikel Utama -->
                <article class="w-full lg:w-2/3 group cursor-pointer">
                    <div class="overflow-hidden rounded-xl mb-2 sm:mb-4">
                        <img src="{{ $lastNews['image'] }}" alt="Berita Utama"
                            class="w-full h-40 sm:h-[500px] object-cover transition-transform duration-300 group-hover:scale-105">
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mb-1 sm:mb-2 select-none">Kabar Dimsa &bull;
                        {{ $lastNews['date'] }}
                    </p>
                    <h3
                        class="text-lg sm:text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors select-none">
                        {{ $lastNews['title'] }}</h3>
                </article>

                <!-- Kolom Kanan: Daftar Artikel Lainnya -->
                <article class="w-full lg:w-1/3 flex flex-col gap-y-4 sm:gap-y-6">
                    @foreach ($news as $new)
                        <div class="flex gap-4 w-full group cursor-pointer">
                            <img src="{{ $new['image'] }}" alt="Berita 1"
                                class="w-1/3 h-24 sm:h-32 object-cover rounded-xl">
                            <div class="w-2/3 flex flex-col justify-center">
                                <p class="text-xs text-gray-500 mb-1 select-none">Kabar Dimsa &bull;
                                    {{ $new['date'] }}</p>
                                <h6
                                    class="text-sm sm:text-base font-semibold text-gray-800 group-hover:text-blue-600 transition-colors select-none">
                                    {{ $new['title'] }}</h6>
                            </div>
                        </div>
                    @endforeach
                </article>
            </main>
            <!-- Tombol Selengkapnya untuk Mobile -->
            <div class="mt-8 text-center sm:hidden">
                <a href="#"
                    class="text-blue-600 hover:underline font-medium whitespace-nowrap text-sm sm:text-base">Selengkapnya
                    &gt;</a>
            </div>
        </div>
    </section>

    <!-- Section Testimoni Alumni -->
    <section id="testimoni" class="py-16 sm:py-20 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-8 lg:px-20">
            <header class="flex flex-col sm:flex-row justify-between items-center mb-4 sm:mb-8 gap-2">
                <h3 class="text-xl sm:text-3xl md:text-4xl font-bold text-gray-800 text-center sm:text-left">Testimoni
                    Alumni</h3>
                <a href="#"
                    class="text-blue-600 hover:underline font-medium whitespace-nowrap text-sm sm:text-base hidden sm:block">Selengkapnya
                    &gt;</a>
            </header>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-8">

                @foreach ($testimonials as $testi)
                    <div class="flex flex-col bg-white p-8 rounded-xl shadow-lg">
                        <p class="text-gray-600 italic flex-grow">"{{ $testi['testimoni'] }}"</p>
                        <div class="flex items-center gap-4 mt-6 pt-6 border-t border-gray-200">
                            <img src="{{ $testi['profile']['image'] }}" alt="Foto Alumni"
                                class="w-16 h-16 object-cover rounded-full">
                            <div>
                                <h6 class="font-semibold text-gray-900">{{ $testi['profile']['name'] }}</h6>
                                <p class="text-sm text-gray-500">{{ $testi['profile']['graduate'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Tombol Selengkapnya untuk Mobile -->
            <div class="mt-8 text-center sm:hidden">
                <a href="#"
                    class="text-blue-600 hover:underline font-medium whitespace-nowrap text-sm sm:text-base">Selengkapnya
                    &gt;</a>
            </div>
        </div>
    </section>

    <section class="py-16 sm:py-20 md:py-24">
        <div class="container mx-auto px-4 sm:px-8 lg:px-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-8">
                <!-- Kartu Penerimaan Santri Baru -->
                <a href="#"
                    class="group relative w-full h-[550px] bg-green-800 hover:bg-green-900 rounded-2xl p-8 text-white flex flex-col justify-end overflow-hidden cursor-pointer transition-colors duration-300">
                    <div class="absolute top-8 -left-16 group-hover:left-4 transition-all duration-500 ease-in-out">
                        <div class="flex items-center gap-3">
                            <p class="bg-white text-blue-900 font-semibold p-3 rounded-lg whitespace-nowrap">SMP Darul
                                Ihsan</p><img src="{{ asset('images/buliding2.svg') }}" alt="Icon Gedung"
                                class="bg-blue-900 p-2 rounded-lg w-12 h-12">
                        </div>
                    </div>
                    <div class="absolute top-24 -right-16 group-hover:right-4 transition-all duration-500 ease-in-out">
                        <div class="flex items-center gap-3"><img src="{{ asset('images/buildings.svg') }}"
                                alt="Icon Gedung" class="bg-white p-2 rounded-lg w-12 h-12">
                            <p class="bg-white text-blue-900 font-semibold p-3 rounded-lg whitespace-nowrap">Muhammadiyah
                            </p>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <p class="text-xl">Penerimaan</p>
                        <h5 class="text-3xl font-bold">Santri Baru</h5>
                    </div>
                </a>
                <!-- Kartu Ruang Literasi -->
                <a href="#"
                    class="group relative w-full h-[550px] bg-gray-100 hover:bg-blue-50 rounded-2xl p-8 flex flex-col justify-start overflow-hidden cursor-pointer transition-colors duration-300">
                    <div class="text-gray-800">
                        <h5 class="text-3xl font-bold">Ruang Literasi</h5>
                        <p class="text-xl text-gray-600">Darul Ihsan Muhammadiyah</p>
                    </div>
                    <img src="{{ asset('images/whitebook.svg') }}" alt="Buku Putih"
                        class="absolute w-[350px] bottom-[-150px] left-[-30px] group-hover:bottom-[-140px] group-hover:left-[-40px] transition-all duration-500 ease-in-out z-10">
                    <img src="{{ asset('images/pinkbook.svg') }}" alt="Buku Pink"
                        class="absolute w-[500px] bottom-[-60px] right-[-25px] group-hover:bottom-[-40px] group-hover:right-0 transition-all duration-500 ease-in-out z-20">
                    <img src="{{ asset('images/bluebook.svg') }}" alt="Buku Biru"
                        class="absolute w-[480px] bottom-[-160px] right-[-130px] group-hover:bottom-[-140px] group-hover:right-[-120px] transition-all duration-500 ease-in-out z-30">
                </a>
                <!-- Kartu Donasi -->
                <div class="lg:col-span-2">
                    <div
                        class="flex flex-col md:flex-row items-center bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl shadow-lg w-full overflow-hidden">
                        <div class="p-8 md:p-12 text-left w-full md:w-7/12">
                            <img src="{{ asset('images/lazismu.svg') }}" alt="Logo Lazismu" class="w-12 mb-4">
                            <h2 class="text-2xl md:text-3xl font-bold text-black">Salurkan Harta Terbaikmu,<br>Raih
                                Berkah
                                Ilahi.</h2>
                            <button
                                class="mt-6 bg-black text-white font-semibold py-3 px-8 rounded-lg hover:bg-gray-800 transition-colors">Donasi
                                Sekarang</button>
                        </div>
                        <div class="hidden md:block w-full md:w-5/12 h-64 md:h-auto">
                            <img src="{{ asset('images/donasi.svg') }}" alt="Kotak Donasi"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')
@endsection

@push('styles')
    <style>
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-scroll {
            animation: scroll 40s linear infinite;
        }
    </style>
@endpush
