@extends('pages.guest.berita.layout.berita-layout')

@section('heroImage', asset('images/pengumuman.webp'))
@section('heroTitle', 'Pengumuman')
@section('heroDesc', 'Informasi penting dan pengumuman resmi dari Pondok Pesantren Darul Ihsan Muhammadiyah Sragen.')

@section('main-content')

    @php
        $pengumumanData = [
            [
                'title' => 'Jadwal Ujian Akhir Semester (UAS) Genap TP 2024/2025',
                'date' => '20 Agustus 2025',
                'content' =>
                    'Diberitahukan kepada seluruh santri bahwa Ujian Akhir Semester (UAS) Genap akan dilaksanakan mulai tanggal 1 s.d. 10 September 2025. Harap mempersiapkan diri dengan baik dan menjaga kesehatan.',
                'url' => '#',
            ],
            [
                'title' => 'Informasi Perizinan Pulang Idul Adha 1446 H',
                'date' => '18 Agustus 2025',
                'content' =>
                    'Perizinan pulang dalam rangka Hari Raya Idul Adha akan dibuka mulai tanggal 15 September 2025. Informasi detail mengenai jadwal dan prosedur akan disampaikan melalui wali asrama masing-masing.',
                'url' => '#',
            ],
            [
                'title' => 'Pendaftaran Lomba Cerdas Cermat Antar Kelas',
                'date' => '15 Agustus 2025',
                'content' =>
                    'Segera daftarkan tim kelasmu untuk mengikuti Lomba Cerdas Cermat tahunan. Pendaftaran dibuka hingga tanggal 25 Agustus 2025 di kantor kesantrian.',
                'url' => '#',
            ],
            [
                'title' => 'Pengambilan Raport Semester Ganjil',
                'date' => '10 Agustus 2025',
                'content' =>
                    'Pengambilan raport hasil belajar semester ganjil akan dilaksanakan pada hari Sabtu, 16 Agustus 2025, pukul 08:00 s.d. 12:00 WIB di aula utama.',
                'url' => '#',
            ],
            [
                'title' => 'Kerja Bakti Massal "Jumat Bersih"',
                'date' => '05 Agustus 2025',
                'content' =>
                    'Dalam rangka menjaga kebersihan lingkungan pondok, akan diadakan kerja bakti massal pada hari Jumat, 8 Agustus 2025. Seluruh santri diwajibkan untuk berpartisipasi.',
                'url' => '#',
            ],
            [
                'title' => 'Pemberitahuan Pemadaman Listrik Terjadwal',
                'date' => '01 Agustus 2025',
                'content' =>
                    'Akan ada pemadaman listrik terjadwal untuk pemeliharaan di seluruh area pondok pada hari Rabu, 6 Agustus 2025, dari pukul 09:00 hingga 14:00 WIB.',
                'url' => '#',
            ],
        ];
    @endphp

    <div class="p-4 sm:p-8 lg:p-20 bg-gray-50">
        <div class="max-w-4xl mx-auto" x-data="{
            allItems: {{ json_encode($pengumumanData) }},
            currentPage: 1,
            itemsPerPage: 4,
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

            <!-- Daftar Pengumuman -->
            <div class="space-y-6">
                <template x-for="item in paginatedItems" :key="item.title">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900" x-text="item.title"></h3>
                                <p class="text-xs sm:text-sm text-gray-500 mt-2 sm:mt-0" x-text="item.date"></p>
                            </div>
                            <p class="text-gray-600 mt-4 text-sm leading-relaxed" x-text="item.content"></p>
                        </div>
                        <div class="bg-gray-50 px-6 py-3">
                            <a :href="item.url" class="text-sm font-semibold text-gray-600 hover:underline">
                                Baca Selengkapnya &rarr;
                            </a>
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
            <div class="flex flex-col cursor-pointer" onclick="location.href='{{ route('galeri') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800"><i
                        class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
                <h1 class="text-lg md:text-xl font-bold">Galeri</h1>
            </div>
            <div class="flex flex-col items-end cursor-pointer" onclick="location.href='{{ route('qna') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                        class="fa-solid fa-arrow-right ml-2"></i></p>
                <h1 class="text-lg md:text-xl font-bold">QnA</h1>
            </div>
        </div>
    </div>
@endsection
