@extends('pages.guest.berita.layout.berita-layout')

@section('heroImage', asset('images/alumni.webp'))
@section('heroTitle', 'Jejaring Alumni')
@section('heroDesc',
    'Terhubung dengan para alumni DIMSA yang telah berkiprah di berbagai bidang di seluruh penjuru
    negeri.')

@section('main-content')

    @php
        $alumniData = [
            [
                'name' => 'Dr. Ahmad Fauzi, S.Kom., M.T.',
                'angkatan' => '2005',
                'lembaga' => 'MA Darul Ihsan',
                'pekerjaan' => 'Dosen & Peneliti di Universitas Gadjah Mada',
                'foto' => 'https://placehold.co/200x200/3b82f6/ffffff?text=AF',
            ],
            [
                'name' => 'Fatimah Az-Zahra, S.H.',
                'angkatan' => '2008',
                'lembaga' => 'MA Darul Ihsan',
                'pekerjaan' => 'Pengacara di Firma Hukum ABC',
                'foto' => 'https://placehold.co/200x200/ec4899/ffffff?text=FZ',
            ],
            [
                'name' => 'Ibrahim Malik, S.T.',
                'angkatan' => '2010',
                'lembaga' => 'SMP Darul Ihsan',
                'pekerjaan' => 'Software Engineer di Gojek',
                'foto' => 'https://placehold.co/200x200/16a34a/ffffff?text=IM',
            ],
            [
                'name' => 'Aisyah Putri, S.Psi.',
                'angkatan' => '2012',
                'lembaga' => 'MA Darul Ihsan',
                'pekerjaan' => 'Psikolog Klinis di RSUP Dr. Sardjito',
                'foto' => 'https://placehold.co/200x200/f97316/ffffff?text=AP',
            ],
            [
                'name' => 'Muhammad Yusuf',
                'angkatan' => '2015',
                'lembaga' => 'SMP Darul Ihsan',
                'pekerjaan' => 'Mahasiswa Kedokteran di Universitas Indonesia',
                'foto' => 'https://placehold.co/200x200/8b5cf6/ffffff?text=MY',
            ],
            [
                'name' => 'Zainab Al-Ghazali',
                'angkatan' => '2011',
                'lembaga' => 'MA Darul Ihsan',
                'pekerjaan' => 'Founder & CEO di Startup Edukasi',
                'foto' => 'https://placehold.co/200x200/ef4444/ffffff?text=ZA',
            ],
            [
                'name' => 'Umar Abdullah',
                'angkatan' => '2009',
                'lembaga' => 'SMP Darul Ihsan',
                'pekerjaan' => 'Arsitek di PT Wijaya Karya',
                'foto' => 'https://placehold.co/200x200/06b6d4/ffffff?text=UA',
            ],
            [
                'name' => 'Khadijah Hasan',
                'angkatan' => '2013',
                'lembaga' => 'MA Darul Ihsan',
                'pekerjaan' => 'Jurnalis di Metro TV',
                'foto' => 'https://placehold.co/200x200/eab308/ffffff?text=KH',
            ],
        ];
    @endphp

    <div class="p-4 sm:p-8 lg:p-20 bg-gray-50">
        <div class="max-w-7xl mx-auto" x-data="{
            search: '',
            alumni: [],
            fetchAlumni () {
                fetch(`{{ url('api/alumni') }}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.data);
                        this.alumni = data.data;
                    });
            },
            get filteredAlumni() {
                if (this.search === '') {
                    return this.alumni;
                }
                return this.alumni.filter(item => {
                    return item.nama_alumni.toLowerCase().includes(this.search.toLowerCase()) ||
                        item.pekerjaan.toLowerCase().includes(this.search.toLowerCase()) ||
                        item.tahun_lulus.toString().includes(this.search);
                });
            }
        }" x-init="fetchAlumni()">

            <!-- Header dan Kolom Pencarian -->
            <div class="text-center mb-8">
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                    Temukan dan terhubung kembali dengan teman-teman seangkatan Anda.
                </p>
                <div class="mt-6 max-w-lg mx-auto">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input type="text" x-model="search" placeholder="Cari nama, angkatan, atau pekerjaan..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Daftar Kartu Alumni -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <template x-for="item in filteredAlumni" :key="item.nama_alumni">
                    <div
                        class="bg-white rounded-lg shadow-md text-center p-6 transition-transform hover:-translate-y-2 hover:shadow-xl">
                        <img :src="'{{ asset('uploads/alumni') }}/' + item.image" :alt="'Foto ' + item.nama_alumni"
                            class="w-24 h-24 mx-auto rounded-full object-cover mb-4 border-4 border-white shadow-lg">
                        <h3 class="text-lg font-bold text-gray-900" x-text="item.nama_alumni"></h3>
                        <p class="text-sm text-gray-500" x-text="`Angkatan ${item.tahun_lulus} - ${item.lembaga === 0 ? 'SMP' : 'MA'} Darul Ihsan`"></p>
                        <p class="text-sm text-gray-600 font-semibold mt-2" x-text="item.pekerjaan"></p>
                    </div>
                </template>
            </div>

            <!-- Pesan jika tidak ada hasil -->
            <div x-show="filteredAlumni.length === 0" class="text-center py-16">
                <p class="text-gray-500 text-lg">Alumni tidak ditemukan.</p>
            </div>

        </div>
        <hr class="my-10 border-t-2 border-gray-200">
        <div class="max-w-7xl mx-auto flex flex-row justify-between">
            <div class="flex flex-col cursor-pointer" onclick="location.href='{{ route('qna') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800"><i
                        class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
                <h1 class="text-lg md:text-xl font-bold">QnA</h1>
            </div>
            <div class="flex flex-col items-end cursor-pointer" onclick="location.href='{{ route('lowongan-kerja') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                        class="fa-solid fa-arrow-right ml-2"></i></p>
                <h1 class="text-lg md:text-xl font-bold">Lowongan Kerja</h1>
            </div>
        </div>
    </div>
@endsection
