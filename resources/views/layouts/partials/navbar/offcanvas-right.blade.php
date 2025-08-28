<!-- Kolom Kanan (Sub-Menu) -->
<div class="w-full lg:w-3/4 bg-white p-8 lg:p-16 overflow-y-auto">
    {{-- Tombol Kembali (Mobile) --}}
    <button @click="offcanvasOpen = false"
        class="lg:hidden mb-6 inline-flex items-center text-gray-600 hover:text-gray-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                clip-rule="evenodd" />
        </svg>
        Kembali
    </button>

    <div class="flex flex-col lg:mt-24 lg:w-1/2">

        {{-- profile --}}
        <div x-show="activeTab === 'profil'">
            @php
                $profilItems = [
                    ['text' => 'Selayang Pandang', 'url' => route('guest.selayang-pandang')],
                    ['text' => 'Sejarah', 'url' => route('guest.sejarah-pondok')],
                    ['text' => 'Visi & Misi', 'url' => route('guest.visi-misi')],
                    ['text' => 'Struktur Organisasi', 'url' => route('guest.struktur-organisasi')],
                    ['text' => 'Akreditasi', 'url' => route('guest.akreditasi')],
                    ['text' => 'Logo & Brand', 'url' => route('guest.logo')],
                    ['text' => 'Pimpinan & Dewan Guru', 'url' => route('guest.pimpinan')],
                ];
            @endphp
            <x-item-offcanvas title="Tentang Dimsa"
                description="Telusuri lebih dekat DIMSA dalam sejarah, rekam kontribusi untuk negeri dan beragam informasi lainnya."
                :items="$profilItems" />
        </div>

        {{-- akademik --}}
        <div x-show="activeTab === 'akademik'" style="display: none;">
            @php
                $akademikItems = [
                    ['text' => 'SMP', 'url' => route('guest.smp')],
                    ['text' => 'MA', 'url' => route('guest.ma')],
                ];
            @endphp
            <x-item-offcanvas title="Akademik" description="Ragam informasi akademik lembaga pendidikan di DIMSA."
                :items="$akademikItems" />
        </div>

        {{-- program (DINAMIS) --}}
        <div x-show="activeTab === 'program'">
            @if (!empty($programNavItems))
                <x-item-offcanvas title="Program"
                    description="Ragam pembelajaran unggulan DIMSA untuk pengembangan diri Siswa-siswi."
                    :items="$programNavItems" />
            @else
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Program</h2>
                    <p class="mt-2 text-sm text-gray-500">Ragam pembelajaran unggulan DIMSA untuk pengembangan diri
                        Siswa-siswi.</p>
                    <p class="mt-6 text-sm text-gray-400">Belum ada program unggulan.</p>
                </div>
            @endif
        </div>

        {{-- fasilitas --}}
        <div x-show="activeTab === 'fasilitas'">
            @php
                $profilItems = [
                    ['text' => 'Sarana Prasarana', 'url' => route('sarana-prasarana')],
                    ['text' => 'Panduan Tata Tertib', 'url' => route('tata-tertib')],
                ];
            @endphp
            <x-item-offcanvas title="Fasilitas"
                description="Pendukung efektifitas proses kegiatan pembelajaran di DIMSA." :items="$profilItems" />
        </div>

        {{-- berita --}}
        <div x-show="activeTab === 'berita'">
            @php
                $profilItems = [
                    ['text' => 'Dimsa dalam berita', 'url' => route('guest.kabar')],
                    ['text' => 'Karya Ilmiah', 'url' => route('guest.karya-ilmiah')],
                    ['text' => 'Majalah', 'url' => route('guest.majalah')],
                    ['text' => 'Galeri', 'url' => route('guest.galeri')],
                    ['text' => 'Pengumuman', 'url' => route('guest.pengumuman')],
                    ['text' => 'QnA', 'url' => route('guest.qna')],
                    ['text' => 'Alumni', 'url' => route('guest.alumni')],
                    ['text' => 'Lowongan Kerja', 'url' => route('guest.lowongan-kerja')],
                ];
            @endphp
            <x-item-offcanvas title="Berita" description="Kumpulan informasi update DIMSA." :items="$profilItems" />
        </div>
    </div>
</div>
