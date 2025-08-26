@extends('pages.guest.berita.layout.berita-layout')

@section('heroImage', asset('images/karya-ilmiah.webp'))
@section('heroTitle', 'Karya Ilmiah')
@section('heroDesc',
    ' Jelajahi koleksi penelitian, artikel, dan karya tulis yang disusun oleh para santri dan pembimbing di
    lingkungan Pondok Pesantren Darul Ihsan Muhammadiyah Sragen.')

@section('main-content')

    @php
        $karyaIlmiahData = [
            [
                'title' => 'Analisis Pengaruh Metode Pembelajaran Berbasis Proyek terhadap Motivasi Belajar Santri',
                'author' => 'Dr. Ahmad Fauzi, M.Pd.',
                'year' => '2024',
                'downloadUrl' => '#',
            ],
            [
                'title' => 'Implementasi Teknologi Augmented Reality sebagai Media Pembelajaran Sejarah Islam',
                'author' => 'Fatimah Az-Zahra (Santri Kelas XII)',
                'year' => '2024',
                'downloadUrl' => '#',
            ],
            [
                'title' => 'Studi Komparatif Efektivitas Metode Menghafal Al-Qur\'an: Muraja\'ah vs. Tikrar',
                'author' => 'Ust. Ibrahim Malik, Lc.',
                'year' => '2023',
                'downloadUrl' => '#',
            ],
            [
                'title' => 'Pemanfaatan Limbah Organik Asrama menjadi Pupuk Kompos untuk Kebun Pesantren',
                'author' => 'Tim Adiwiyata DIMSA',
                'year' => '2023',
                'downloadUrl' => '#',
            ],
            [
                'title' => 'Pengembangan Sistem Informasi Perpustakaan Berbasis Web di Lingkungan Pesantren',
                'author' => 'Tim Cyber DIMSA',
                'year' => '2023',
                'downloadUrl' => '#',
            ],
            [
                'title' => 'Analisis Psikologis Dampak Kehidupan Berasrama terhadap Kemandirian Santri',
                'author' => 'Aisyah Putri, S.Psi.',
                'year' => '2022',
                'downloadUrl' => '#',
            ],
            [
                'title' => 'Kajian Fiqh Kontemporer: Hukum Jual Beli Online dalam Perspektif Syariah',
                'author' => 'Ust. Abdullah Hakim, M.H.',
                'year' => '2022',
                'downloadUrl' => '#',
            ],
            [
                'title' => 'Desain dan Prototyping Robot Pembersih Lantai Masjid Otomatis',
                'author' => 'Klub Robotik DIMSA',
                'year' => '2022',
                'downloadUrl' => '#',
            ],
        ];
    @endphp

    <div class="p-4 sm:p-8 lg:p-20 bg-gray-50">
        <div class="max-w-7xl mx-auto" x-data="{
            allItems: {{ json_encode($karyaIlmiahData) }},
            currentPage: 1,
            itemsPerPage: 6, // Mengubah item per halaman agar lebih sesuai untuk grid
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

            {{-- Daftar Karya Ilmiah (Grid View) --}}
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <template x-for="item in paginatedItems" :key="item.title">
                    <div
                        class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border border-gray-200 transition-transform hover:scale-[1.02] hover:shadow-md flex flex-col">
                        <div class="flex-grow">
                            <a :href="item.downloadUrl" class="block">
                                <h3 class="text-base sm:text-lg font-semibold text-blue-700 hover:underline line-clamp-2"
                                    x-text="item.title">
                                </h3>
                            </a>
                            <p class="text-xs sm:text-sm text-green-700 mt-1" x-text="`${item.author} - ${item.year}`"></p>
                        </div>
                        <div class="mt-3 sm:mt-4 flex justify-end">
                            <a :href="item.downloadUrl" download
                                class="inline-flex items-center text-xs sm:text-sm font-medium text-gray-600 hover:text-red-600 border border-gray-300 rounded-md px-2 py-1 sm:px-3 sm:py-1.5">
                                <i class="fas fa-file-pdf mr-2"></i>
                                Unduh PDF
                            </a>
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
            <div class="flex flex-col cursor-pointer" onclick="location.href='{{ route('kabar') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800"><i
                        class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
                <h1 class="text-lg md:text-xl font-bold">Kabar Dimsa</h1>
            </div>
            <div class="flex flex-col items-end cursor-pointer" onclick="location.href='{{ route('majalah') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                        class="fa-solid fa-arrow-right ml-2"></i>
                </p>
                <h1 class="text-lg md:text-xl font-bold">Majalah</h1>
            </div>
        </div>
    </div>
@endsection
