@extends('pages.guest.berita.layout.berita-layout')

@section('heroImage', asset('images/berita.webp'))
@section('heroTitle', 'Dimsa Dalam Berita')
@section('heroDesc', 'Berita terbaru seputar DIMSA.')
@section('main-content')

    @php
        $allNews = [
            [
                'image' => 'https://placehold.co/1200x800/94a3b8/1e293b?text=Berita+Utama',
                'category' => 'Kabar Dimsa',
                'title' => 'Judul Berita Utama yang Menarik Perhatian Pembaca',
                'date' => '06 Agu, 2025',
                'excerpt' =>
                    'Ini adalah ringkasan singkat dari berita utama. Konten ini dirancang untuk memberikan gambaran umum kepada pembaca tentang apa yang dibahas dalam artikel lengkap...',
                'url' => '#',
                'featured' => true,
            ],
            [
                'image' => 'https://placehold.co/400x300/bbf7d0/1e293b?text=Info',
                'category' => 'Prestasi',
                'title' => 'Siswa DIMSA Raih Juara 1 Lomba Robotik Nasional',
                'date' => '05 Agu, 2025',
                'url' => '#',
                'featured' => false,
            ],
            [
                'image' => 'https://placehold.co/400x300/fecaca/1e293b?text=Info',
                'category' => 'Kegiatan',
                'title' => 'Kegiatan Bakti Sosial di Desa Binaan Berjalan Sukses',
                'date' => '04 Agu, 2025',
                'url' => '#',
                'featured' => false,
            ],
            [
                'image' => 'https://placehold.co/400x300/c7d2fe/1e293b?text=Info',
                'category' => 'Kajian',
                'title' => 'Kajian Rutin Membahas Pentingnya Akhlak dalam Islam',
                'date' => '03 Agu, 2025',
                'url' => '#',
                'featured' => false,
            ],
            [
                'image' => 'https://placehold.co/400x300/fde68a/1e293b?text=Info',
                'category' => 'Artikel',
                'title' => 'Tips Menghafal Al-Quran dengan Metode Terkini',
                'date' => '02 Agu, 2025',
                'url' => '#',
                'featured' => false,
            ],
            [
                'image' => 'https://placehold.co/400x300/e9d5ff/1e293b?text=Info',
                'category' => 'Pengumuman',
                'title' => 'Jadwal Ujian Akhir Semester Genap Telah Dirilis',
                'date' => '01 Agu, 2025',
                'url' => '#',
                'featured' => false,
            ],
            [
                'image' => 'https://placehold.co/400x300/fed7aa/1e293b?text=Info',
                'category' => 'Olahraga',
                'title' => 'Tim Futsal DIMSA Menjuarai Turnamen Antar Sekolah',
                'date' => '31 Jul, 2025',
                'url' => '#',
                'featured' => false,
            ],
            [
                'image' => 'https://placehold.co/400x300/a7f3d0/1e293b?text=Info',
                'category' => 'Seni',
                'title' => 'Pameran Kaligrafi Karya Santri DIMSA Dibuka untuk Umum',
                'date' => '30 Jul, 2025',
                'url' => '#',
                'featured' => false,
            ],
            [
                'image' => 'https://placehold.co/400x300/f9a8d4/1e293b?text=Info',
                'category' => 'Kesehatan',
                'title' => 'Penyuluhan Kesehatan Gigi dan Mulut untuk Santri',
                'date' => '29 Jul, 2025',
                'url' => '#',
                'featured' => false,
            ],
            [
                'image' => 'https://placehold.co/400x300/facc15/1e293b?text=Info',
                'category' => 'Teknologi',
                'title' => 'Workshop Coding untuk Santri Kelas Cyber',
                'date' => '28 Jul, 2025',
                'url' => '#',
                'featured' => false,
            ],
        ];

        $featuredNews = null;
        $otherNews = [];
        foreach ($allNews as $newsItem) {
            if ($newsItem['featured']) {
                $featuredNews = $newsItem;
            } else {
                $otherNews[] = $newsItem;
            }
        }
    @endphp

    <div class="p-4 sm:p-8 lg:p-20 bg-white">
        <div class="max-w-7xl mx-auto" x-data="{
            allNews: {{ json_encode($otherNews) }},
            currentPage: 1,
            itemsPerPage: 6,
            get paginatedNews() {
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = start + this.itemsPerPage;
                return this.allNews.slice(start, end);
            },
            get totalPages() {
                return Math.ceil(this.allNews.length / this.itemsPerPage);
            },
            changePage(page) {
                if (page < 1 || page > this.totalPages) return;
                this.currentPage = page;
            }
        }">

            {{-- Berita Utama --}}
            @if ($featuredNews)
                <div class="mb-12 group">
                    <a href="{{ $featuredNews['url'] }}" class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <div class="overflow-hidden rounded-xl">
                            <img src="{{ $featuredNews['image'] }}" alt="{{ $featuredNews['title'] }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-blue-600">{{ $featuredNews['category'] }}</p>
                            <h2 class="text-3xl font-bold text-gray-900 mt-2 group-hover:text-blue-600 transition-colors">
                                {{ $featuredNews['title'] }}</h2>
                            <p class="text-gray-600 mt-4">{{ $featuredNews['excerpt'] }}</p>
                            <p class="text-xs text-gray-500 mt-4">{{ $featuredNews['date'] }}</p>
                        </div>
                    </a>
                </div>
            @endif

            <hr class="my-12">

            {{-- Daftar Berita Lainnya --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <template x-for="newsItem in paginatedNews" :key="newsItem.title">
                    <a :href="newsItem.url" class="group">
                        <div class="overflow-hidden rounded-xl">
                            <img :src="newsItem.image" :alt="newsItem.title"
                                class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                        </div>
                        <div class="p-4">
                            <p class="text-xs font-semibold text-blue-600" x-text="newsItem.category"></p>
                            <h3 class="text-lg font-bold text-gray-900 mt-2 group-hover:text-blue-600 transition-colors"
                                x-text="newsItem.title"></h3>
                            <p class="text-xs text-gray-500 mt-2" x-text="newsItem.date"></p>
                        </div>
                    </a>
                </template>
            </div>

            {{-- Pagination --}}
            <div class="mt-16 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1"
                        class="px-4 py-2 text-gray-500 bg-white rounded-md hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed">
                        Previous
                    </button>
                    <template x-for="i in totalPages" :key="i">
                        <button @click="changePage(i)"
                            :class="{
                                'bg-blue-600 text-white': currentPage ===
                                    i,
                                'bg-white text-gray-700 hover:bg-gray-100': currentPage !== i
                            }"
                            class="px-4 py-2 rounded-md">
                            <span x-text="i"></span>
                        </button>
                    </template>
                    <button @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages"
                        class="px-4 py-2 text-gray-500 bg-white rounded-md hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed">
                        Next
                    </button>
                </nav>
            </div>

        </div>
        <hr class="my-10 border-t-2 border-gray-200">
        <div class="flex flex-row justify-end">
            <div class="flex flex-col cursor-pointer items-end" onclick="location.href='{{ route('karya-ilmiah') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                        class="fa-solid fa-arrow-right ml-2"></i></p>
                <h1 class="font-bold text-lg md:text-xl">Karya Ilmiah</h1>
            </div>
        </div>
    </div>
@endsection
