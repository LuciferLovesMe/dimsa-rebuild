@extends('layouts.cms')

@section('title', 'Setting Slideshow')

@section('content')
    <div x-data="slideshowManager()">
        <form @submit.prevent="submitForm">
            <x-cms_page title="Setting Slideshow" breadcrumb1="Admin" breadcrumb2="Slideshow" breadcrumb3="Setting">

                {{-- Tombol simpan berada di header halaman --}}
                <x-slot name="actions">
                    <button type="submit"
                        class="w-full sm:w-fit flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                        <span class="font-semibold">Simpan Perubahan</span>
                    </button>
                </x-slot>

                {{-- Tampilkan loading spinner saat data diambil --}}
                <template x-if="isLoading">
                    <div class="flex justify-center items-center p-8">
                        <i class="fa fa-spinner fa-spin text-2xl text-gray-500"></i>
                        <p class="ml-2 text-gray-500">Memuat data slideshow...</p>
                    </div>
                </template>

                {{-- Grid untuk 4 slot slideshow --}}
                <template x-if="!isLoading">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Loop melalui 4 slot slideshow menggunakan Alpine.js --}}
                        <template x-for="(slide, index) in slideshows" :key="index">
                            <div class="space-y-4">
                                {{-- Uploader atau Pratinjau Gambar --}}
                                <div
                                    class="relative flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50">

                                    {{-- Tampilan PRATINJAU jika gambar ada --}}
                                    <template x-if="slide.photoPreview">
                                        <div>
                                            <img :src="slide.photoPreview" class="object-cover h-64 w-full rounded-lg">
                                            <div
                                                class="absolute top-3 right-3 flex gap-2 bg-black bg-opacity-30 p-2 rounded-lg">
                                                <label :for="'file-upload-' + index"
                                                    class="cursor-pointer font-semibold text-white hover:text-blue-300 px-2">
                                                    Ganti
                                                </label>
                                                <button @click="removeImage(index)" type="button"
                                                    class="text-white hover:text-red-400 px-2">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </template>

                                    {{-- Tampilan UPLOAD jika tidak ada gambar --}}
                                    <template x-if="!slide.photoPreview">
                                        <div class="text-center">
                                            <svg class="w-10 h-10 mx-auto mb-4 text-green-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Upload
                                                    image</span>, atau telusuri</p>
                                            <p class="text-xs text-gray-500">PNG atau JPG (maks. 1920x1080px)</p>
                                            <label :for="'file-upload-' + index"
                                                class="absolute inset-0 cursor-pointer"></label>
                                        </div>
                                    </template>

                                    {{-- Input file yang tersembunyi --}}
                                    <input :id="'file-upload-' + index" :name="`slides[${index}][image]`" type="file"
                                        class="sr-only" @change="handlePhotoChange(index, $event)"
                                        accept="image/png, image/jpeg">
                                    {{-- Input tersembunyi untuk ID --}}
                                    <input type="hidden" :name="`slides[${index}][id]`" x-model="slide.id">
                                </div>

                                {{-- Input Headline --}}
                                <div>
                                    <label :for="'headline-' + index"
                                        class="block text-sm font-medium text-gray-700">Headline Hero</label>
                                    <input type="text" :id="'headline-' + index" :name="`slides[${index}][headline]`"
                                        x-model="slide.headline"
                                        class="p-2 border mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="Tulis Headline">
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </x-cms_page>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function slideshowManager() {
            return {
                isLoading: true,
                // Siapkan 4 slot kosong untuk data slideshow
                slideshows: [{}, {}, {}, {}],

                init() {
                    // Ambil data slideshow yang ada dari API
                    $.ajax({
                        url: "{{ url('/api/admin/slideshow/showAll') }}",
                        method: 'GET',
                        success: (response) => {
                            if (response.status === 'success' && response.data.original.data) {
                                const existingSlides = response.data.original.data;
                                // Masukkan data yang ada ke dalam 4 slot
                                for (let i = 0; i < 4; i++) {
                                    if (existingSlides[i]) {
                                        this.slideshows[i] = {
                                            id: existingSlides[i].id,
                                            headline: existingSlides[i].headline,
                                            photoPreview: existingSlides[i]
                                                .image_url
                                        };
                                    } else {
                                        this.slideshows[i] = {
                                            id: null,
                                            headline: '',
                                            photoPreview: null
                                        };
                                    }
                                }
                            }
                            this.isLoading = false;
                        },
                        error: () => {
                            this.isLoading = false;
                            Swal.fire('Gagal', 'Tidak dapat memuat data slideshow.', 'error');
                        }
                    });
                },

                handlePhotoChange(index, event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.slideshows[index].photoPreview = URL.createObjectURL(file);
                    }
                },

                removeImage(index) {
                    const slideId = this.slideshows[index].id;
                    if (slideId) {
                        // Jika ada ID, berarti gambar ada di server dan perlu dihapus via API
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Gambar akan dihapus secara permanen!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: `/api/admin/slideshow/delete/${slideId}`,
                                    type: 'DELETE',
                                    data: {
                                        "_token": "{{ csrf_token() }}"
                                    },
                                    success: (response) => {
                                        this.slideshows[index] = {
                                            id: null,
                                            headline: '',
                                            photoPreview: null
                                        };
                                        Swal.fire('Dihapus!', 'Gambar berhasil dihapus.', 'success');
                                    },
                                    error: () => {
                                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus gambar.',
                                            'error');
                                    }
                                });
                            }
                        });
                    } else {
                        // Jika belum ada ID, cukup hapus pratinjau di frontend
                        this.slideshows[index].photoPreview = null;
                        document.getElementById(`file-upload-${index}`).value = null;
                    }
                },

                submitForm() {
                    const form = this.$el;
                    const formData = new FormData(form);

                    Swal.fire({
                        title: 'Menyimpan perubahan...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Gunakan rute 'update' karena ini lebih cocok untuk menyimpan pengaturan
                    $.ajax({
                        url: "{{ url('/api/admin/slideshow/update') }}",
                        method: 'POST', // Gunakan POST dengan _method 'PUT' untuk mengirim file
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire('Berhasil!', 'Perubahan slideshow berhasil disimpan.', 'success')
                                .then(() => window.location.reload());
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan data.', 'error');
                        }
                    });
                }
            }
        }
    </script>
@endpush
