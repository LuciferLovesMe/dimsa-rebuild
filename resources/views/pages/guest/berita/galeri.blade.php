@extends('pages.guest.berita.layout.berita-layout')

@section('heroImage', asset('images/galery.webp'))
@section('heroTitle', 'Galeri Dimsa')
@section('heroDesc',
    'Kumpulan foto dan video kegiatan serta momen berharga di Pondok Pesantren Darul Ihsan Muhammadiyah
    Sragen.')

@section('main-content')

    @php
        $galleryData = [
            [
                'image' => 'https://placehold.co/600x400/3b82f6/ffffff?text=Pembelajaran+1',
                'category' => 'Pembelajaran',
                'title' => 'Diskusi Kelompok di Kelas',
            ],
            [
                'image' => 'https://placehold.co/600x400/16a34a/ffffff?text=Ekskul+1',
                'category' => 'Ekstrakurikuler',
                'title' => 'Latihan Pramuka',
            ],
            [
                'image' => 'https://placehold.co/600x400/ef4444/ffffff?text=Event+1',
                'category' => 'Event',
                'title' => 'Peringatan Hari Kemerdekaan',
            ],
            [
                'image' => 'https://placehold.co/600x400/3b82f6/ffffff?text=Pembelajaran+2',
                'category' => 'Pembelajaran',
                'title' => 'Praktikum di Laboratorium',
            ],
            [
                'image' => 'https://placehold.co/600x400/16a34a/ffffff?text=Ekskul+2',
                'category' => 'Ekstrakurikuler',
                'title' => 'Pertandingan Futsal',
            ],
            [
                'image' => 'https://placehold.co/600x400/ef4444/ffffff?text=Event+2',
                'category' => 'Event',
                'title' => 'Dimsa Fantastic Show',
            ],
            [
                'image' => 'https://placehold.co/600x400/3b82f6/ffffff?text=Pembelajaran+3',
                'category' => 'Pembelajaran',
                'title' => 'Kegiatan di Perpustakaan',
            ],
            [
                'image' => 'https://placehold.co/600x400/16a34a/ffffff?text=Ekskul+3',
                'category' => 'Ekstrakurikuler',
                'title' => 'Lomba Pidato 3 Bahasa',
            ],
            [
                'image' => 'https://placehold.co/600x400/ef4444/ffffff?text=Event+3',
                'category' => 'Event',
                'title' => 'Wisuda Santri',
            ],
            [
                'image' => 'https://placehold.co/600x400/3b82f6/ffffff?text=Pembelajaran+4',
                'category' => 'Pembelajaran',
                'title' => 'Belajar Mengajar di Luar Kelas',
            ],
            [
                'image' => 'https://placehold.co/600x400/16a34a/ffffff?text=Ekskul+4',
                'category' => 'Ekstrakurikuler',
                'title' => 'Pentas Seni Santri',
            ],
            [
                'image' => 'https://placehold.co/600x400/ef4444/ffffff?text=Event+4',
                'category' => 'Event',
                'title' => 'Idul Adha di Pesantren',
            ],
        ];
    @endphp

    <div class="p-4 sm:p-8 lg:p-20 bg-white">
        <div class="max-w-7xl mx-auto" x-data="{
            allItems: {{ json_encode($galleryData) }},
            activeCategory: 'Semua',
            currentPage: 1,
            itemsPerPage: 9,
            get filteredItems() {
                if (this.activeCategory === 'Semua') {
                    return this.allItems;
                }
                return this.allItems.filter(item => item.category === this.activeCategory);
            },
            get paginatedItems() {
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = start + this.itemsPerPage;
                return this.filteredItems.slice(start, end);
            },
            get totalPages() {
                return Math.ceil(this.filteredItems.length / this.itemsPerPage);
            },
            changeCategory(category) {
                this.activeCategory = category;
                this.currentPage = 1;
            },
            changePage(page) {
                if (page < 1 || page > this.totalPages) return;
                this.currentPage = page;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }">

            <!-- Filter Kategori -->
            <div class="flex flex-wrap justify-center sm:justify-start gap-2 mb-8">
                <button @click="changeCategory('Semua')"
                    :class="{ 'bg-blue-600 text-white': activeCategory === 'Semua', 'bg-white text-gray-700 hover:bg-gray-100': activeCategory !== 'Semua' }"
                    class="px-4 py-2 text-sm font-semibold rounded-md border transition-colors">Semua</button>
                <button @click="changeCategory('Pembelajaran')"
                    :class="{ 'bg-blue-600 text-white': activeCategory === 'Pembelajaran', 'bg-white text-gray-700 hover:bg-gray-100': activeCategory !== 'Pembelajaran' }"
                    class="px-4 py-2 text-sm font-semibold rounded-md border transition-colors">Pembelajaran</button>
                <button @click="changeCategory('Ekstrakurikuler')"
                    :class="{ 'bg-blue-600 text-white': activeCategory === 'Ekstrakurikuler', 'bg-white text-gray-700 hover:bg-gray-100': activeCategory !== 'Ekstrakurikuler' }"
                    class="px-4 py-2 text-sm font-semibold rounded-md border transition-colors">Ekstrakurikuler</button>
                <button @click="changeCategory('Event')"
                    :class="{ 'bg-blue-600 text-white': activeCategory === 'Event', 'bg-white text-gray-700 hover:bg-gray-100': activeCategory !== 'Event' }"
                    class="px-4 py-2 text-sm font-semibold rounded-md border transition-colors">Event</button>
            </div>

            <!-- Galeri Gambar -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="item in paginatedItems" :key="item.image">
                    <div class="group relative aspect-w-4 aspect-h-3 rounded-lg overflow-hidden shadow-lg">
                        <img :src="item.image" :alt="item.title"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <h3 class="text-white font-semibold" x-text="item.title"></h3>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1"
                        class="px-4 py-2 text-gray-500 bg-white rounded-md hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed border">
                        Previous
                    </button>
                    <template x-for="i in totalPages" :key="i">
                        <button @click="changePage(i)"
                            :class="{
                                'bg-blue-600 text-white border-blue-600': currentPage ===
                                    i,
                                'bg-white text-gray-700 hover:bg-gray-100 border': currentPage !== i
                            }"
                            class="px-4 py-2 rounded-md">
                            <span x-text="i"></span>
                        </button>
                    </template>
                    <button @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages"
                        class="px-4 py-2 text-gray-500 bg-white rounded-md hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed border">
                        Next
                    </button>
                </nav>
            </div>

        </div>
        <hr class="my-10 border-t-2 border-gray-200">
        <div class="max-w-7xl mx-auto flex flex-row justify-between">
            <div class="flex flex-col cursor-pointer" onclick="location.href='{{ route('majalah') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800"><i
                        class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
                <h1 class="text-lg md:text-xl font-bold">Majalah</h1>
            </div>
            <div class="flex flex-col items-end cursor-pointer" onclick="location.href='{{ route('pengumuman') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                        class="fa-solid fa-arrow-right ml-2"></i></p>
                <h1 class="text-lg md:text-xl font-bold">Pengumuman</h1>
            </div>
        </div>
    </div>
@endsection
