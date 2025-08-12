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
                    ['text' => 'Selayang Pandang', 'url' => route('selayang-pandang')],
                    ['text' => 'Sejarah', 'url' => route('sejarah-pondok')],
                    ['text' => 'Visi & Misi', 'url' => route('visi-misi')],
                    ['text' => 'Struktur Organisasi', 'url' => route('struktur-organisasi')],
                    ['text' => 'Akreditasi', 'url' => route('akreditasi')],
                    ['text' => 'Logo & Brand', 'url' => route('logo')],
                    ['text' => 'Pimpinan & Dewan Guru', 'url' => route('pimpinan')],
                ];
            @endphp
            <x-item-offcanvas title="Tentang Dimsa"
                description="Telusuri lebih dekat DIMSA dalam sejarah, rekam kontribusi untuk negeri dan beragam informasi lainnya."
                :items="$profilItems" />
        </div>

        {{-- akademik --}}
        <div x-show="activeTab === 'akademik'" style="display: none;">
            @php
                $akademikItems = [['text' => 'SMP', 'url' => route('smp')], ['text' => 'MA', 'url' => route('ma')]];
            @endphp
            <x-item-offcanvas title="Akademik" description="Ragam informasi akademik lembaga pendidikan di DIMSA."
                :items="$akademikItems" />
        </div>

        {{-- program --}}
        <div x-show="activeTab === 'program'">
            @php
                $profilItems = [
                    ['text' => 'Kelas Khusus Cyber', 'url' => route('kelas-cyber')],
                    ['text' => 'Kelas Khusus Tahfidz', 'url' => route('kelas-tahfidz')],
                    ['text' => 'Kurikulum Pondok', 'url' => route('kurikulum-pondok')],
                    ['text' => 'Ekstrakurikuler', 'url' => route('ekstrakurikuler')],
                ];
            @endphp
            <x-item-offcanvas title="Program"
                description="Ragam pembelajaran unggulan DIMSA untuk pengembangan diri Siswa-siswi."
                :items="$profilItems" />
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
                    ['text' => 'Dimsa dalam berita', 'url' => route('kabar')],
                    ['text' => 'Karya Ilmiah', 'url' => route('karya-ilmiah')],
                    ['text' => 'Majalah', 'url' => route('majalah')],
                    ['text' => 'Galeri', 'url' => route('galeri')],
                    ['text' => 'Pengumuman', 'url' => route('pengumuman')],
                    ['text' => 'QnA', 'url' => route('qna')],
                    ['text' => 'Alumni', 'url' => route('alumni')],
                    ['text' => 'Lowongan Kerja', 'url' => route('lowongan-kerja')],
                ];
            @endphp
            <x-item-offcanvas title="Berita" description="Kumpulan informasi update DIMSA." :items="$profilItems" />
        </div>
    </div>
</div>
