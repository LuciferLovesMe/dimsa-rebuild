@extends('pages.guest.fasilitas.layout.fasilias-layout')

@section('heroTitle', 'Tata Tertib')
@section('heroDesc',
    'Kami menerapkan tata tertib yang ketat untuk menciptakan lingkungan belajar yang aman dan
    kondusif.')
@section('heroImage', asset('images/tatib.webp'))
@section('main-content')

    @php
        $tataTertibData = [
            [
                'id' => 'umum',
                'title' => 'Ketentuan Umum',
                'icon' => 'fas fa-gavel text-blue-600',
                'rules' => [
                    'Setiap santri wajib menjaga nama baik pondok pesantren di dalam maupun di luar lingkungan pondok.',
                    'Berpakaian sopan dan menutup aurat sesuai dengan syariat Islam.',
                    'Menjaga kebersihan, keindahan, dan ketertiban lingkungan pondok.',
                    'Mengikuti seluruh kegiatan yang telah dijadwalkan oleh pondok dengan disiplin.',
                    'Dilarang membawa alat elektronik yang tidak diizinkan (seperti smartphone, pemutar musik, dll).',
                ],
                'isList' => true,
            ],
            [
                'id' => 'akademik',
                'title' => 'Kegiatan Akademik & KBM',
                'icon' => 'fas fa-book-open text-green-600',
                'rules' => [
                    'Wajib hadir di kelas 10 menit sebelum Kegiatan Belajar Mengajar (KBM) dimulai.',
                    'Memberikan surat izin yang sah jika tidak dapat mengikuti pelajaran.',
                    'Mengerjakan semua tugas yang diberikan oleh guru dengan penuh tanggung jawab.',
                    'Dilarang berbuat curang saat ujian atau tes dalam bentuk apapun.',
                ],
                'isList' => true,
            ],
            [
                'id' => 'asrama',
                'title' => 'Kehidupan Asrama',
                'icon' => 'fas fa-bed text-yellow-600',
                'rules' => [
                    'Menjaga kebersihan dan kerapian kamar masing-masing.',
                    'Tidur dan bangun pada waktu yang telah ditentukan.',
                    'Dilarang meninggalkan area pondok tanpa izin dari pengasuh atau musyrif.',
                    'Menjaga barang pribadi dan menghormati barang milik santri lain.',
                ],
                'isList' => true,
            ],
            [
                'id' => 'sanksi',
                'title' => 'Sanksi & Pelanggaran',
                'icon' => 'fas fa-exclamation-triangle text-red-600',
                'intro' =>
                    'Setiap pelanggaran terhadap tata tertib akan dikenakan sanksi sesuai dengan tingkat pelanggaran, yang dapat berupa:',
                'rules' => [
                    'Teguran lisan atau tulisan.',
                    'Tugas tambahan yang bersifat mendidik.',
                    'Penundaan hak perizinan pulang.',
                    'Panggilan orang tua/wali.',
                    'Sanksi lain yang diputuskan oleh dewan pengasuh.',
                ],
                'isList' => false,
            ],
        ];
    @endphp

    <div class="p-4 sm:p-8 lg:p-20 bg-gray-50">
        <div class="max-w-4xl mx-auto">

            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Panduan Peraturan Santri</h2>
                <p class="mt-4 text-gray-600">
                    Tata tertib ini dibuat untuk ditaati oleh seluruh santri Pondok Pesantren Darul Ihsan Muhammadiyah
                    Sragen demi terciptanya lingkungan yang disiplin, aman, dan mendukung proses pendidikan.
                </p>
            </div>

            <div class="space-y-4" x-data="{ open: { umum: true } }">

                @foreach ($tataTertibData as $kategori)
                    <div class="bg-white rounded-lg shadow-md">
                        <button @click="open['{{ $kategori['id'] }}'] = !open['{{ $kategori['id'] }}']"
                            class="w-full flex justify-between items-center p-5 text-left">
                            <span class="text-lg font-semibold text-gray-800">
                                <i class="{{ $kategori['icon'] }} mr-3"></i> {{ $kategori['title'] }}
                            </span>
                            <i class="fas"
                                :class="open['{{ $kategori['id'] }}'] ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>
                        <div x-show="open['{{ $kategori['id'] }}']" x-transition class="p-5 pt-0">
                            @if (isset($kategori['intro']))
                                <p class="text-gray-600 mb-2">{{ $kategori['intro'] }}</p>
                            @endif

                            @if ($kategori['isList'])
                                <ol class="list-decimal list-inside text-gray-600 space-y-2">
                                    @foreach ($kategori['rules'] as $rule)
                                        <li>{{ $rule }}</li>
                                    @endforeach
                                </ol>
                            @else
                                <ul class="list-disc list-inside text-gray-600 space-y-2">
                                    @foreach ($kategori['rules'] as $rule)
                                        <li>{{ $rule }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
