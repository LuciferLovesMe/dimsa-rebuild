@extends('layouts.form-cms')

{{-- Judul untuk tab browser --}}
@section('title', 'Tambah Data Staff')

{{-- URL untuk tombol kembali --}}
@section('backUrl', route('admin.staff.index'))

{{-- Judul yang akan ditampilkan di atas form --}}
@section('pageTitle', 'Tambah Data Staff')

{{-- Konten utama dari form --}}
@section('formContent')
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Kolom Kiri: Form Fields --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Biodata Section --}}
                <div class="space-y-4">
                    <h3 class="font-medium text-lg">Biodata</h3>
                    <x-input.text name="nama" label="Nama" placeholder="e.g: Nama Lengkap" :required="true" />
                    <x-input.text name="jabatan" label="Jabatan" placeholder="e.g: Guru Matematika" :required="true" />
                </div>

                <hr>

                {{-- Riwayat Pendidikan Dinamis --}}
                <div x-data="educationManager()">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-medium text-lg">Riwayat Pendidikan</h3>
                        <button @click="addEducation" type="button"
                            class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-600">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <template x-for="(education, index) in educations" :key="index">
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4 space-y-4">
                            <div>
                                <label :for="`pendidikan_pendidikan_${index}`"
                                    class="block text-sm font-medium text-gray-700">Pendidikan</label>
                                <input type="text" :name="`riwayat_pendidikan[${index}][tingkat_pendidikan]`"
                                    :id="`pendidikan_pendidikan_${index}`"
                                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Tulis Pendidikan">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label :for="`pendidikan_sekolah_${index}`"
                                        class="block text-sm font-medium text-gray-700">Instansi/Sekolah</label>
                                    <input type="text" :name="`riwayat_pendidikan[${index}][instansi]`"
                                        :id="`pendidikan_sekolah_${index}`"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="Tulis Instansi/Sekolah">
                                </div>
                                <div>
                                    <label :for="`pendidikan_kota_${index}`"
                                        class="block text-sm font-medium text-gray-700">Kota</label>
                                    <input type="text" :name="`riwayat_pendidikan[${index}][kota]`"
                                        :id="`pendidikan_kota_${index}`"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="Tulis Kota">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                                <div>
                                    <label :for="`tahun_mulai_${index}`"
                                        class="block text-sm font-medium text-gray-700">Tahun Mulai</label>
                                    <select :name="`riwayat_pendidikan[${index}][tahun_mulai]`"
                                        :id="`tahun_mulai_${index}`"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Pilih tahun</option>
                                        <template x-for="year in years" :key="year">
                                            <option :value="year" x-text="year"></option>
                                        </template>
                                    </select>
                                </div>
                                <div class="space-y-1">
                                    <div class="flex justify-between items-center">
                                        <label :for="`tahun_berakhir_${index}`"
                                            class="block text-sm font-medium text-gray-700">Tahun Berakhir</label>
                                        <div class="flex items-center">
                                            <input :id="`sekarang_${index}`" x-model="education.sekarang" type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label :for="`sekarang_${index}`"
                                                class="ml-2 block text-sm text-gray-900">Sekarang</label>
                                        </div>
                                    </div>
                                    <select :name="`riwayat_pendidikan[${index}][tahun_akhir]`"
                                        :id="`tahun_berakhir_${index}`" :disabled="education.sekarang"
                                        class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm disabled:bg-gray-100">
                                        <option value="">Pilih tahun</option>
                                        <template x-for="year in years" :key="year">
                                            <option :value="year" x-text="year"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-end gap-2 pt-2 border-t">
                                <button @click="removeEducation(index)" type="button"
                                    class="flex items-center justify-center h-9 w-9 rounded-md bg-white border border-gray-300 hover:bg-gray-50 text-gray-700">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                                <button type="button"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-gray-800 rounded-md hover:bg-gray-900">Selesai</button>
                            </div>
                        </div>
                    </template>
                </div>

                <hr>

                {{-- Pengalaman Kerja Dinamis --}}
                <div x-data="workExperienceManager()">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-medium text-lg">Pengalaman Kerja</h3>
                        <button @click="addWorkExperience" type="button"
                            class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-600">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <template x-for="(work, index) in workExperiences" :key="index">
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4 space-y-4">
                            <div>
                                <label :for="`work_posisi_${index}`"
                                    class="block text-sm font-medium text-gray-700">Posisi</label>
                                <input type="text" :name="`pengalaman_kerja[${index}][posisi]`"
                                    :id="`work_posisi_${index}`"
                                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Tulis Posisi">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label :for="`work_pemberi_kerja_${index}`"
                                        class="block text-sm font-medium text-gray-700">Perusahaan</label>
                                    <input type="text" :name="`pengalaman_kerja[${index}][perusahaan]`"
                                        :id="`work_pemberi_kerja_${index}`"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="Tulis Nama Perusahaan">
                                </div>
                                <div>
                                    <label :for="`work_kota_${index}`"
                                        class="block text-sm font-medium text-gray-700">Kota</label>
                                    <input type="text" :name="`pengalaman_kerja[${index}][kota]`"
                                        :id="`work_kota_${index}`"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="Tulis Kota">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                                <div>
                                    <label :for="`work_tahun_mulai_${index}`"
                                        class="block text-sm font-medium text-gray-700">Tahun Mulai</label>
                                    <select :name="`pengalaman_kerja[${index}][tahun_mulai]`"
                                        :id="`work_tahun_mulai_${index}`"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Pilih tahun</option>
                                        <template x-for="year in years" :key="year">
                                            <option :value="year" x-text="year"></option>
                                        </template>
                                    </select>
                                </div>
                                <div class="space-y-1">
                                    <div class="flex justify-between items-center">
                                        <label :for="`work_tahun_berakhir_${index}`"
                                            class="block text-sm font-medium text-gray-700">Tahun Berakhir</label>
                                        <div class="flex items-center">
                                            <input :id="`work_sekarang_${index}`" x-model="work.sekarang" type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label :for="`work_sekarang_${index}`"
                                                class="ml-2 block text-sm text-gray-900">Sekarang</label>
                                        </div>
                                    </div>
                                    <select :name="`pengalaman_kerja[${index}][tahun_akhir]`"
                                        :id="`work_tahun_berakhir_${index}`" :disabled="work.sekarang"
                                        class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm disabled:bg-gray-100">
                                        <option value="">Pilih tahun</option>
                                        <template x-for="year in years" :key="year">
                                            <option :value="year" x-text="year"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-end gap-2 pt-2 border-t">
                                <button @click="removeWorkExperience(index)" type="button"
                                    class="flex items-center justify-center h-9 w-9 rounded-md bg-white border border-gray-300 hover:bg-gray-50 text-gray-700">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                                <button type="button"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-gray-800 rounded-md hover:bg-gray-900">Selesai</button>
                            </div>
                        </div>
                    </template>
                </div>

                <hr>

                {{-- Prestasi Dinamis --}}
                <div x-data="achievementManager()">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-medium text-lg">Prestasi</h3>
                        <button @click="addAchievement" type="button"
                            class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-600">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <template x-for="(achievement, index) in achievements" :key="index">
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4 space-y-4">
                            <div>
                                <label :for="`prestasi_lomba_${index}`"
                                    class="block text-sm font-medium text-gray-700">Lomba</label>
                                <input type="text" :name="`prestasi[${index}][nama_lomba]`"
                                    :id="`prestasi_lomba_${index}`"
                                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Tulis Lomba">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label :for="`prestasi_penyelenggara_${index}`"
                                        class="block text-sm font-medium text-gray-700">Penyelenggara</label>
                                    <input type="text" :name="`prestasi[${index}][penyelenggara]`"
                                        :id="`prestasi_penyelenggara_${index}`"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="Tulis Penyelenggara">
                                </div>
                                <div>
                                    <label :for="`prestasi_predikat_${index}`"
                                        class="block text-sm font-medium text-gray-700">Predikat/Juara</label>
                                    <input type="text" :name="`prestasi[${index}][predikat]`"
                                        :id="`prestasi_predikat_${index}`"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="Tulis Predikat">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                                <div>
                                    <label :for="`prestasi_tingkat_${index}`"
                                        class="block text-sm font-medium text-gray-700">Tingkat</label>
                                    <select :name="`prestasi[${index}][tingkat]`" :id="`prestasi_tingkat_${index}`"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Pilih Tingkat</option>
                                        <option value="internasional">Internasional</option>
                                        <option value="nasional">Nasional</option>
                                        <option value="provinsi">Provinsi</option>
                                        <option value="kota">Kota/Kabupaten</option>
                                    </select>
                                </div>
                                <div>
                                    <label :for="`prestasi_tahun_${index}`"
                                        class="block text-sm font-medium text-gray-700">Tahun</label>
                                    <select :name="`prestasi[${index}][tahun]`" :id="`prestasi_tahun_${index}`"
                                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Pilih tahun</option>
                                        <template x-for="year in years" :key="year">
                                            <option :value="year" x-text="year"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-end gap-2 pt-2 border-t">
                                <button @click="removeAchievement(index)" type="button"
                                    class="flex items-center justify-center h-9 w-9 rounded-md bg-white border border-gray-300 hover:bg-gray-50 text-gray-700">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                                <button type="button"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-gray-800 rounded-md hover:bg-gray-900">Selesai</button>
                            </div>
                        </div>
                    </template>
                </div>

                <x-input.publish-checkbox name="is_publish" />

            </div>

            {{-- Kolom Kanan --}}
            <div class="space-y-6">
                <x-input.image-uploader name="image" />
                <x-button.save text="Simpan Data" />
            </div>

        </div>
    </form>
@endsection

@push('scripts')
    <script>
        // Data manager untuk Riwayat Pendidikan
        function educationManager() {
            return {
                educations: [],
                years: [],
                init() {
                    const currentYear = new Date().getFullYear();
                    for (let i = currentYear; i >= currentYear - 50; i--) {
                        this.years.push(i);
                    }
                    this.addEducation();
                },
                addEducation() {
                    this.educations.push({
                        tingkat_pendidikan: '',
                        instansi: '',
                        kota: '',
                        tahun_mulai: '',
                        tahun_akhir: '',
                        sekarang: false
                    });
                },
                removeEducation(index) {
                    this.educations.splice(index, 1);
                }
            }
        }

        // Data manager untuk Pengalaman Kerja
        function workExperienceManager() {
            return {
                workExperiences: [],
                years: [],
                init() {
                    const currentYear = new Date().getFullYear();
                    for (let i = currentYear; i >= currentYear - 50; i--) {
                        this.years.push(i);
                    }
                    this.addWorkExperience();
                },
                addWorkExperience() {
                    this.workExperiences.push({
                        posisi: '',
                        perusahaan: '',
                        kota: '',
                        tahun_mulai: '',
                        tahun_akhir: '',
                        sekarang: false
                    });
                },
                removeWorkExperience(index) {
                    this.workExperiences.splice(index, 1);
                }
            }
        }

        // Data manager untuk Prestasi
        function achievementManager() {
            return {
                achievements: [],
                years: [],
                init() {
                    const currentYear = new Date().getFullYear();
                    for (let i = currentYear; i >= currentYear - 50; i--) {
                        this.years.push(i);
                    }
                    this.addAchievement();
                },
                addAchievement() {
                    this.achievements.push({
                        nama_lomba: '',
                        penyelenggara: '',
                        predikat: '',
                        tingkat: '',
                        tahun: ''
                    });
                },
                removeAchievement(index) {
                    this.achievements.splice(index, 1);
                }
            }
        }

        // --- SKRIP UNTUK MENGIRIM FORM ---
        $(document).ready(function() {
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const apiUrl = `/api/admin/guru-staff/create`; // URL API untuk staff

                const formData = new FormData(this);

                Swal.fire({
                    title: 'Menyimpan data...',
                    text: 'Mohon tunggu sebentar.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: apiUrl,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                        }).then(() => {
                            window.location.href = "{{ route('admin.staff.index') }}";
                        });
                    },
                    error: function(xhr) {
                        Swal.close();
                        const errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        if (errors) {
                            for (const key in errors) {
                                errorMessages += `<p>${errors[key][0]}</p>`;
                            }
                        }
                        Swal.fire(
                            'Gagal!',
                            errorMessages || 'Terjadi kesalahan saat menyimpan data.',
                            'error'
                        );
                    }
                });
            });
        });
    </script>
@endpush
