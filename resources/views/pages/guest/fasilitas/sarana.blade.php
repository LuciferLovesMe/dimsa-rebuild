@extends('pages.guest.fasilitas.layout.fasilias-layout')

@section('heroTitle', 'Sarana & Prasarana')
@section('heroDesc',
    'Kami menyediakan berbagai fasilitas dan prasarana untuk mendukung proses belajar mengajar di
    sekolah.')
@section('heroImage', asset('images/fasilitas.webp'))

@section('main-content')
    @php
        // Data dummy ini nantinya akan Anda ambil dari database
        $facilities = [
            [
                'name' => 'Asrama Santri',
                'images' => [
                    [
                        'url' => 'https://placehold.co/800x810/3b82f6/ffffff?text=Asrama+Besar',
                        'alt' => 'Kamar asrama santri',
                    ],
                    [
                        'url' => 'https://placehold.co/400x400/3b82f6/ffffff?text=Asrama+Kecil+1',
                        'alt' => 'Lemari di asrama santri',
                    ],
                    [
                        'url' => 'https://placehold.co/400x400/3b82f6/ffffff?text=Asrama+Kecil+2',
                        'alt' => 'Area belajar di asrama',
                    ],
                ],
            ],
            [
                'name' => 'Gedung Madrasah',
                'images' => [
                    [
                        'url' => 'https://placehold.co/800x810/16a34a/ffffff?text=Madrasah+Besar',
                        'alt' => 'Tampak depan gedung madrasah',
                    ],
                    [
                        'url' => 'https://placehold.co/400x400/16a34a/ffffff?text=Madrasah+Kecil+1',
                        'alt' => 'Ruang kelas di madrasah',
                    ],
                    [
                        'url' => 'https://placehold.co/400x400/16a34a/ffffff?text=Madrasah+Kecil+2',
                        'alt' => 'Perpustakaan madrasah',
                    ],
                ],
            ],
            [
                'name' => 'Masjid',
                'images' => [
                    [
                        'url' => 'https://placehold.co/800x810/d97706/ffffff?text=Masjid+Besar',
                        'alt' => 'Tampak depan masjid',
                    ],
                    [
                        'url' => 'https://placehold.co/400x400/d97706/ffffff?text=Masjid+Kecil+1',
                        'alt' => 'Bagian dalam masjid',
                    ],
                    [
                        'url' => 'https://placehold.co/400x400/d97706/ffffff?text=Masjid+Kecil+2',
                        'alt' => 'Tempat wudhu masjid',
                    ],
                ],
            ],
        ];
    @endphp

    <div class="p-4 sm:p-8 lg:p-20 bg-gray-50">
        {{-- Cek apakah ada data fasilitas --}}
        @if (!empty($facilities))
            {{-- Looping untuk setiap fasilitas --}}
            @foreach ($facilities as $facility)
                <div class="mb-16">
                    {{-- Judul Fasilitas --}}
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">
                        {{ $facility['name'] }}
                    </h2>

                    {{-- Grid untuk galeri gambar dengan tinggi yang dibatasi pada layar medium ke atas --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 md:grid-rows-2 gap-4 md:gap-6 md:h-[60vh]">
                        @if ($loop->odd)
                            {{-- Layout Ganjil: Gambar besar di kiri --}}
                            <div class="md:col-span-2 md:row-span-2 rounded-lg overflow-hidden shadow-lg">
                                <img src="{{ $facility['images'][0]['url'] }}" alt="{{ $facility['images'][0]['alt'] }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="rounded-lg overflow-hidden shadow-lg">
                                <img src="{{ $facility['images'][1]['url'] }}" alt="{{ $facility['images'][1]['alt'] }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="rounded-lg overflow-hidden shadow-lg">
                                <img src="{{ $facility['images'][2]['url'] }}" alt="{{ $facility['images'][2]['alt'] }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @else
                            {{-- Layout Genap: Gambar besar di kanan --}}
                            <div class="rounded-lg overflow-hidden shadow-lg md:col-start-1 md:row-start-1">
                                <img src="{{ $facility['images'][1]['url'] }}" alt="{{ $facility['images'][1]['alt'] }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="rounded-lg overflow-hidden shadow-lg md:col-start-1 md:row-start-2">
                                <img src="{{ $facility['images'][2]['url'] }}" alt="{{ $facility['images'][2]['alt'] }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="md:col-start-2 md:col-span-2 md:row-span-2 rounded-lg overflow-hidden shadow-lg">
                                <img src="{{ $facility['images'][0]['url'] }}" alt="{{ $facility['images'][0]['alt'] }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            {{-- Tampilan jika tidak ada fasilitas --}}
            <div class="text-center py-16">
                <p class="text-gray-500 text-lg">Belum ada fasilitas.</p>
            </div>
        @endif
    </div>
@endsection
