@extends('layouts.form-cms')

@section('title', 'Edit Data Lowongan Kerja')
@section('backUrl', route('admin.lowongan-kerja.index'))
@section('pageTitle', 'Edit Informasi Pekerjaan')

@section('formContent')
    {{-- Menggunakan Alpine.js untuk mengelola state form secara keseluruhan --}}
    <div x-data="jobFormManager()">
        {{-- Tampilkan loading spinner saat data diambil --}}
        <template x-if="isLoading">
            <div class="flex justify-center items-center p-8">
                <i class="fa fa-spinner fa-spin text-2xl text-gray-500"></i>
                <p class="ml-2 text-gray-500">Memuat data...</p>
            </div>
        </template>

        {{-- Tampilkan form setelah data selesai dimuat --}}
        <template x-if="!isLoading">
            <form id="main-form" @submit.prevent="submitForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-6">

                    {{-- KOLOM KIRI: INFORMASI PEKERJAAN --}}
                    <div class="space-y-6">
                        <x-input.text name="posisi" label="Posisi" placeholder="e.g: Guru Bahasa Indonesia"
                            :required="true" x-model="formData.posisi" />
                        <x-input.textarea name="deskripsi" label="Deskripsi" placeholder="Deskripsi singkat pekerjaan"
                            :required="true" :rows="5" x-model="formData.deskripsi" />

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-input.date name="tanggal_mulai" label="Tanggal Dibuka" :required="true"
                                x-model="formData.tanggal_mulai" />
                            <x-input.date name="tanggal_selesai" label="Tanggal Ditutup" :required="true"
                                x-model="formData.tanggal_selesai" />
                        </div>

                        <x-input.image-uploader name="file" />
                    </div>

                    {{-- KOLOM KANAN: KUALIFIKASI (DINAMIS) --}}
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <h3 class="font-medium text-gray-900">Kualifikasi</h3>
                                <button @click="addItem('kualifikasi')" type="button"
                                    class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-600">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <template x-for="(item, index) in formData.kualifikasi" :key="index">
                                <div class="flex items-start gap-2">
                                    <textarea x-model="item.deskripsi" :name="`kualifikasi[${index}][deskripsi]`" placeholder="e.g: Usia 22-35 tahun"
                                        rows="2"
                                        class="flex-grow block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                                    <button @click="removeItem('kualifikasi', index)" type="button"
                                        class="mt-1 flex-shrink-0 flex items-center justify-center h-9 w-9 rounded-md bg-gray-50 border border-gray-300 hover:bg-red-50 text-gray-500 hover:text-red-600">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Footer Form --}}
                <div class="pt-6 border-t mt-8">
                    <div class="flex justify-between items-center">
                        <x-input.publish-checkbox name="is_publish" x-model="formData.is_publish" />
                        <button type="submit"
                            class="w-full sm:w-fit flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                            <span class="font-semibold">Perbarui Data</span>
                        </button>
                    </div>
                </div>
            </form>
        </template>
    </div>
@endsection

@push('scripts')
    {{-- Memuat Alpine.js --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function jobFormManager() {
            return {
                isLoading: true,
                formData: {
                    posisi: '',
                    deskripsi: '',
                    tanggal_mulai: '',
                    tanggal_selesai: '',
                    file: null,
                    is_publish: false,
                    kualifikasi: [],
                },

                init() {
                    const urlParams = new URLSearchParams(window.location.search);
                    const id = urlParams.get('id');

                    if (!id) {
                        Swal.fire('Error', 'ID Lowongan Kerja tidak ditemukan di URL.', 'error');
                        this.isLoading = false;
                        return;
                    }

                    $.ajax({
                        url: `/admin/api/lowongan-kerja/${id}`,
                        method: 'GET',
                        success: (response) => {
                            const data = response.data;
                            this.formData.posisi = data.posisi;
                            this.formData.deskripsi = data.deskripsi;
                            this.formData.tanggal_mulai = data.tanggal_mulai;
                            this.formData.tanggal_selesai = data.tanggal_selesai;
                            this.formData.is_publish = data.is_publish == 1;
                            this.formData.kualifikasi = data.kualifikasi && data.kualifikasi.length > 0 ? data
                                .kualifikasi : [{
                                    deskripsi: ''
                                }];

                            // Update pratinjau gambar
                            const imageUrl = `{{ asset('storage') }}/${data.file}`;
                            window.dispatchEvent(new CustomEvent('update-preview', {
                                detail: {
                                    src: imageUrl
                                }
                            }));

                            this.isLoading = false;
                        },
                        error: () => {
                            Swal.fire('Gagal!', 'Tidak dapat memuat data.', 'error');
                            this.isLoading = false;
                        }
                    });
                },

                addItem(type) {
                    this.formData[type].push({
                        deskripsi: ''
                    });
                },

                removeItem(type, index) {
                    this.formData[type].splice(index, 1);
                    if (this.formData[type].length === 0) {
                        this.addItem(type);
                    }
                },

                submitForm() {
                    const formElement = document.getElementById('main-form');
                    const formData = new FormData(formElement);
                    const urlParams = new URLSearchParams(window.location.search);
                    const id = urlParams.get('id');

                    const apiUrl = `/admin/api/lowongan-kerja/${id}/update`;

                    Swal.fire({
                        title: 'Memperbarui data...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: apiUrl,
                        method: 'POST', // Menggunakan POST untuk mengirim FormData dengan method spoofing
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire('Berhasil!', 'Data berhasil diperbarui.', 'success')
                                .then(() => window.location.href = "{{ route('admin.lowongan-kerja.index') }}");
                        },
                        error: function(xhr) {
                            Swal.close();
                            // Logika untuk menampilkan error validasi
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                // ... (tambahkan logika validasi di sini jika perlu)
                            } else {
                                Swal.fire('Gagal!', xhr.responseJSON.message || 'Terjadi kesalahan.', 'error');
                            }
                        }
                    });
                }
            }
        }
    </script>
@endpush
