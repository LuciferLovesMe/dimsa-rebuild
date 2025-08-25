@extends('pages.guest.berita.layout.berita-layout')

@section('heroImage', asset('images/qna.webp'))
@section('heroTitle', 'Tanya Jawab (QnA)')
@section('heroDesc',
    'Temukan jawaban atas pertanyaan yang sering diajukan mengenai pendaftaran, kehidupan di asrama,
    dan informasi umum lainnya.')

@section('main-content')

    @php
        $qnaData = [
            [
                'id' => 'q1',
                'question' => 'Kapan pendaftaran santri baru dibuka?',
                'answer' =>
                    'Pendaftaran santri baru biasanya dibuka dalam dua gelombang. Gelombang pertama dimulai pada bulan November hingga Januari, dan gelombang kedua (jika kuota masih tersedia) dibuka pada bulan Februari hingga April. Informasi detail akan selalu diumumkan di situs web resmi kami.',
            ],
            [
                'id' => 'q2',
                'question' => 'Apa saja persyaratan untuk mendaftar?',
                'answer' =>
                    'Calon santri harus merupakan lulusan SD/MI untuk jenjang SMP, atau lulusan SMP/MTs untuk jenjang MA. Persyaratan dokumen meliputi fotokopi ijazah, akta kelahiran, kartu keluarga, dan pas foto. Tes seleksi yang meliputi tes akademik, baca Al-Qur\'an, dan wawancara juga menjadi bagian dari proses pendaftaran.',
            ],
            [
                'id' => 'q3',
                'question' => 'Kurikulum apa yang digunakan di DIMSA?',
                'answer' =>
                    'Kami mengintegrasikan tiga kurikulum: Kurikulum Nasional (Kurikulum Merdeka), Kurikulum Diniyah (Kepesantrenan), dan Kurikulum Kemuhammadiyahan. Tujuannya adalah untuk mencetak generasi yang tidak hanya unggul dalam ilmu pengetahuan umum, tetapi juga memiliki pemahaman agama yang kuat dan berakhlak mulia.',
            ],
            [
                'id' => 'q4',
                'question' => 'Apakah santri diizinkan membawa alat elektronik?',
                'answer' =>
                    'Untuk menjaga fokus belajar dan interaksi sosial, santri tidak diizinkan membawa smartphone atau alat elektronik pribadi lainnya. Namun, kami menyediakan fasilitas laboratorium komputer dan akses internet yang terawasi untuk keperluan pembelajaran.',
            ],
            [
                'id' => 'q5',
                'question' => 'Bagaimana prosedur perizinan pulang untuk santri?',
                'answer' =>
                    'Perizinan pulang hanya diberikan pada waktu-waktu tertentu yang telah dijadwalkan oleh pondok, seperti libur semester atau hari raya. Untuk perizinan di luar jadwal (karena alasan mendesak), orang tua/wali harus mengajukan permohonan langsung kepada bagian kesantrian.',
            ],
        ];
    @endphp

    <div class="p-4 sm:p-8 lg:p-20 bg-gray-50">
        <div class="max-w-4xl mx-auto">

            {{-- Pengantar --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Pertanyaan yang Sering Diajukan</h2>
                <p class="mt-4 text-gray-600">
                    Kami telah merangkum beberapa pertanyaan umum untuk membantu Anda mendapatkan informasi lebih cepat.
                </p>
            </div>

            {{-- Akordeon FAQ --}}
            <div class="space-y-4" x-data="{ open: {} }">

                @foreach ($qnaData as $item)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <button @click="open['{{ $item['id'] }}'] = !open['{{ $item['id'] }}']"
                            class="w-full flex justify-between items-center p-5 text-left">
                            <span class="text-base sm:text-lg font-semibold text-gray-800">
                                {{ $item['question'] }}
                            </span>
                            <i class="fas fa-chevron-down transition-transform"
                                :class="open['{{ $item['id'] }}'] && 'rotate-180'"></i>
                        </button>
                        <div x-show="open['{{ $item['id'] }}']" x-transition class="p-5 pt-0">
                            <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                                {{ $item['answer'] }}
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <hr class="my-10 border-t-2 border-gray-200">
        <div class="max-w-7xl mx-auto flex flex-row justify-between">
            <div class="flex flex-col cursor-pointer" onclick="location.href='{{ route('pengumuman') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800"><i
                        class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
                <h1 class="text-lg md:text-xl font-bold">Pengumuman</h1>
            </div>
            <div class="flex flex-col items-end cursor-pointer" onclick="location.href='{{ route('alumni') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                        class="fa-solid fa-arrow-right ml-2"></i></p>
                <h1 class="text-lg md:text-xl font-bold">Alumni</h1>
            </div>
        </div>
    </div>
@endsection
