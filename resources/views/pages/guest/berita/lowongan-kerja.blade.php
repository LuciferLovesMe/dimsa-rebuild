@extends('pages.guest.berita.layout.berita-layout')

@section('heroImage', asset('images/lowongan-kerja.webp'))
@section('heroTitle', 'Lowongan Kerja')
@section('heroDesc',
    'Bergabunglah bersama kami untuk turut serta mencerdaskan bangsa. Temukan posisi yang sesuai dengan
    keahlian Anda.')

@section('main-content')

    @php
        $lowonganData = [
            [
                'posisi' => 'Guru Matematika SMP',
                'excerpt' => 'Mencari guru Matematika yang berdedikasi untuk mengajar santri tingkat SMP.',
                'deskripsi' => 'Mengajar dengan kekuatan penuh dan sepenuh hati.',
                'tanggal_mulai' => '2025-08-20',
                'tanggal_selesai' => '2025-09-15',
                'file' => '#',
                'contact_person' => 'Ust. Ahmad (0812-3456-7890)',
                'kualifikasi' => [
                    'Menguasai 7 bahasa',
                    'Tahan dalam tekanan kerja',
                    'S1 Pendidikan Matematika',
                    'Berpengalaman minimal 2 tahun',
                ],
            ],
            [
                'posisi' => 'Musyrif Asrama Putra',
                'excerpt' =>
                    'Dibutuhkan seorang musyrif (pembimbing asrama) putra yang bertanggung jawab dan berakhlak baik.',
                'deskripsi' =>
                    'Bertanggung jawab sebagai pembimbing asrama putra, menjadi teladan bagi para santri, dan mengelola kegiatan harian di asrama.',
                'tanggal_mulai' => '2025-08-15',
                'tanggal_selesai' => '2025-08-30',
                'file' => '#',
                'contact_person' => 'Ust. Ibrahim (0812-3456-7891)',
                'kualifikasi' => [
                    'Alumni Pesantren',
                    'Memiliki hafalan Al-Qur\'an minimal 5 Juz',
                    'Mampu menjadi teladan yang baik',
                ],
            ],
            [
                'posisi' => 'Staff Administrasi & Keuangan',
                'excerpt' => 'Posisi ini bertanggung jawab untuk mengelola administrasi kesantrian dan keuangan.',
                'deskripsi' => 'Tugas meliputi pencatatan keuangan, administrasi surat-menyurat, dan data santri.',
                'tanggal_mulai' => '2025-07-25',
                'tanggal_selesai' => '2025-08-10',
                'file' => '#',
                'contact_person' => 'Bpk. Abdullah (0812-3456-7892)',
                'kualifikasi' => [
                    'Minimal D3 Akuntansi/Administrasi',
                    'Teliti, jujur, dan amanah',
                    'Menguasai Microsoft Office',
                ],
            ],
            [
                'posisi' => 'Guru Bahasa Inggris MA',
                'excerpt' => 'Mencari guru Bahasa Inggris yang kompeten untuk tingkat Madrasah Aliyah.',
                'deskripsi' =>
                    'Mampu menciptakan lingkungan belajar yang aktif dan komunikatif untuk persiapan ujian masuk perguruan tinggi.',
                'tanggal_mulai' => '2025-09-01',
                'tanggal_selesai' => '2025-09-20',
                'file' => '#',
                'contact_person' => 'Ust. Ahmad (0812-3456-7890)',
                'kualifikasi' => [
                    'S1 Pendidikan Bahasa Inggris',
                    'Memiliki sertifikat TOEFL/IELTS (diutamakan)',
                    'Berpengalaman mengajar minimal 1 tahun',
                ],
            ],
        ];
    @endphp

    <div class="p-4 sm:p-8 lg:p-20 bg-gray-50">
        <div class="max-w-4xl mx-auto">

            <!-- Header -->
            <div class="text-center my-6 sm:my-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Karir di DIMSA</h2>
                <p class="mt-4 text-gray-600 text-sm sm:text-base">
                    Kami selalu mencari individu berbakat dan berdedikasi untuk bergabung dengan tim kami. Lihat posisi yang
                    tersedia di bawah ini.
                </p>
            </div>

            <!-- Daftar Lowongan Kerja dalam List -->
            <div class="space-y-6">
                @forelse ($lowonganData as $lowongan)
                    @php
                        $isAktif = now()->between($lowongan['tanggal_mulai'], $lowongan['tanggal_selesai']);
                    @endphp
                    <div x-data="{ open: false }" class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start">
                                <h3 class="text-xl font-bold text-gray-900">{{ $lowongan['posisi'] }}</h3>
                                @if ($isAktif)
                                    <span
                                        class="w-fit bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full mt-2 sm:mt-0 flex-shrink-0">
                                        Dibuka
                                    </span>
                                @else
                                    <span
                                        class="w-fit bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full mt-2 sm:mt-0 flex-shrink-0">
                                        Ditutup
                                    </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-500 mt-2">
                                Periode Pendaftaran: {{ \Carbon\Carbon::parse($lowongan['tanggal_mulai'])->format('d M') }}
                                - {{ \Carbon\Carbon::parse($lowongan['tanggal_selesai'])->format('d M Y') }}
                            </p>
                            <p class="text-gray-600 mt-4 text-sm leading-relaxed">
                                {{ $lowongan['excerpt'] }}
                            </p>
                        </div>

                        <!-- Detail Lowongan (Expandable) -->
                        <div x-show="open" x-transition class="p-6 border-t border-gray-200">
                            <h4 class="font-semibold text-gray-800 mb-2">Deskripsi Lengkap:</h4>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                {{ $lowongan['deskripsi'] }}
                            </p>

                            <h4 class="font-semibold text-gray-800 mb-2">Kualifikasi:</h4>
                            <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-4">
                                @foreach ($lowongan['kualifikasi'] as $kualifikasi)
                                    <li>{{ $kualifikasi }}</li>
                                @endforeach
                            </ul>

                            <h4 class="font-semibold text-gray-800 mb-2">Narahubung:</h4>
                            <p class="text-gray-600 text-sm">
                                <i class="fas fa-phone-alt mr-2 text-gray-400"></i>
                                {{ $lowongan['contact_person'] }}
                            </p>
                        </div>

                        <!-- Tombol Aksi di Footer Kartu -->
                        <div class="p-6 bg-gray-50 rounded-b-lg border-t flex items-center justify-between">
                            <button @click="open = !open" class="text-sm text-gray-600 hover:underline focus:outline-none">
                                <span x-show="!open">Lihat Detail</span>
                                <span x-show="open">Tutup Detail</span>
                                <i class="fas fa-caret-down text-gray-400" x-show="!open"></i>
                                <i class="fas fa-caret-up text-gray-400" x-show="open"></i>
                            </button>
                            <a href="{{ $lowongan['file'] }}" download
                                class="inline-flex items-center justify-center px-3 py-1.5 border border-gray-400 text-gray-600 font-semibold rounded-md hover:bg-gray-100 transition-colors text-xs">
                                <i class="fas fa-download mr-2"></i>
                                Unduh Berkas
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-white rounded-lg shadow-sm border">
                        <p class="text-gray-500 text-lg">Saat ini belum ada lowongan kerja yang tersedia.</p>
                    </div>
                @endforelse
            </div>

        </div>
        <hr class="my-10 border-t-2 border-gray-200">
        <div class="max-w-7xl mx-auto flex flex-row justify-between">
            <div class="flex flex-col cursor-pointer" onclick="location.href='{{ route('alumni') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800"><i
                        class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
                <h1 class="text-lg md:text-xl font-bold">Alumni</h1>
            </div>
            <div class="flex flex-col items-end cursor-pointer" onclick="location.href='{{ route('landing-page') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                        class="fa-solid fa-arrow-right ml-2"></i></p>
                <h1 class="text-lg md:text-xl font-bold">Kembali ke Beranda</h1>
            </div>
        </div>
    </div>
@endsection
