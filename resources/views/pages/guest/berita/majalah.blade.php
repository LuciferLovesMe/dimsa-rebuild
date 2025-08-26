@extends('pages.guest.berita.layout.berita-layout')

@section('heroImage', asset('images/majalah.webp'))
@section('heroTitle', 'Majalah Dimsa')
@section('heroDesc',
    'Temukan edisi terbaru dan arsip majalah resmi Pondok Pesantren Darul Ihsan Muhammadiyah Sragen,
    yang berisi artikel, berita, dan cerita inspiratif dari komunitas kami.')

@section('main-content')

    @php
        $majalahData = [
            [
                'image' => 'https://placehold.co/400x550/0284c7/ffffff?text=Majalah+Edisi+12',
                'title' => 'Majalah DIMSA Edisi XII - Semangat Baru',
                'date' => 'Agustus 2024',
                'downloadUrl' => '#',
            ],
            [
                'image' => 'https://placehold.co/400x550/059669/ffffff?text=Majalah+Edisi+11',
                'title' => 'Majalah DIMSA Edisi XI - Inovasi Pendidikan',
                'date' => 'Juli 2024',
                'downloadUrl' => '#',
            ],
            [
                'image' => 'https://placehold.co/400x550/c026d3/ffffff?text=Majalah+Edisi+10',
                'title' => 'Majalah DIMSA Edisi X - Prestasi Santri',
                'date' => 'Juni 2024',
                'downloadUrl' => '#',
            ],
            [
                'image' => 'https://placehold.co/400x550/db2777/ffffff?text=Majalah+Edisi+9',
                'title' => 'Majalah DIMSA Edisi IX - Ramadhan Berkah',
                'date' => 'Mei 2024',
                'downloadUrl' => '#',
            ],
            [
                'image' => 'https://placehold.co/400x550/dc2626/ffffff?text=Majalah+Edisi+8',
                'title' => 'Majalah DIMSA Edisi VIII - Merajut Ukhuwah',
                'date' => 'April 2024',
                'downloadUrl' => '#',
            ],
            [
                'image' => 'https://placehold.co/400x550/ea580c/ffffff?text=Majalah+Edisi+7',
                'title' => 'Majalah DIMSA Edisi VII - Teknologi & Pesantren',
                'date' => 'Maret 2024',
                'downloadUrl' => '#',
            ],
            [
                'image' => 'https://placehold.co/400x550/65a30d/ffffff?text=Majalah+Edisi+6',
                'title' => 'Majalah DIMSA Edisi VI - Milad Pesantren',
                'date' => 'Februari 2024',
                'downloadUrl' => '#',
            ],
        ];
    @endphp

    <div class="p-4 sm:p-8 lg:p-20 bg-gray-50">
        <div class="max-w-7xl mx-auto" x-data="{
            allItems: {{ json_encode($majalahData) }},
            currentPage: 1,
            itemsPerPage: 6,
            get paginatedItems() {
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = start + this.itemsPerPage;
                return this.allItems.slice(start, end);
            },
            get totalPages() {
                return Math.ceil(this.allItems.length / this.itemsPerPage);
            },
            changePage(page) {
                if (page < 1 || page > this.totalPages) return;
                this.currentPage = page;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }">

            {{-- Daftar Majalah --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                <template x-for="item in paginatedItems" :key="item.title">
                    <div class="group flex flex-col">
                        <div
                            class="relative w-full aspect-[2/3] rounded-lg overflow-hidden shadow-lg transition-transform duration-300 group-hover:-translate-y-2 group-hover:shadow-2xl">
                            <img :src="item.image" :alt="item.title" class="w-full h-full object-cover">
                            <div
                                class="absolute inset-0 bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a :href="item.downloadUrl" download
                                    class="bg-white/90 text-gray-800 font-semibold px-4 py-2 rounded-full text-sm flex items-center gap-2">
                                    <i class="fas fa-download"></i>
                                    <span>Unduh</span>
                                </a>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="font-bold text-gray-800" x-text="item.title"></h3>
                            <p class="text-sm text-gray-500" x-text="item.date"></p>
                        </div>
                    </div>
                </template>
            </div>


            {{-- Pagination --}}
            <div class="mt-16 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1"
                        class="px-4 py-2 text-gray-500 bg-white rounded-md hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed border">
                        Previous
                    </button>
                    <template x-for="i in totalPages" :key="i">
                        <button @click="changePage(i)"
                            :class="{
                                'bg-blue-600 text-white border-blue-600': currentPage === i,
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
            <div class="flex flex-col cursor-pointer" onclick="location.href='{{ route('karya-ilmiah') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800"><i
                        class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
                <h1 class="text-lg md:text-xl font-bold">Karya Ilmiah</h1>
            </div>
            <div class="flex flex-col items-end cursor-pointer" onclick="location.href='{{ route('galeri') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                        class="fa-solid fa-arrow-right ml-2"></i>
                </p>
                <h1 class="text-lg md:text-xl font-bold">Galeri</h1>
            </div>
        </div>
    </div>
@endsection
