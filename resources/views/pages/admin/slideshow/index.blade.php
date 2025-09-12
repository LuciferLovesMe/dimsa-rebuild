@extends('layouts.cms')

@section('title', 'Setting Slideshow')

@section('content')
    <form x-data="slideshowManager()" @submit.prevent="submitForm">
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

            {{-- Grid untuk 3 slot slideshow --}}
            <template x-if="!isLoading">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    {{-- Loop melalui 3 slot slideshow menggunakan Alpine.js --}}
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
                                            {{-- REVISI: Tombol ini sekarang memanggil deleteSlide untuk hapus data langsung --}}
                                            <button @click="deleteSlide(index)" type="button"
                                                class="text-white hover:text-red-400 px-2" title="Hapus Slide">
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

                                <input :id="'file-upload-' + index" :name="`file[${index}]`" type="file" class="sr-only"
                                    @change="handlePhotoChange(index, $event)" accept="image/png, image/jpeg">

                                <template x-if="slide.id">
                                    <input type="hidden" :name="`id[${index}]`" :value="slide.id">
                                </template>
                            </div>

                            {{-- Input Headline --}}
                            <div>
                                <label :for="'headline-' + index" class="block text-sm font-medium text-gray-700">Headline
                                    Hero</label>
                                <input type="text" :id="'headline-' + index" :name="`headline[${index}]`"
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
@endsection

@push('scripts')
    <script>
        function slideshowManager() {
            return {
                isLoading: true,

                slideshows: Array(3).fill(null).map(() => ({
                    id: null,
                    headline: '',
                    photoPreview: null,
                })),

                init() {
                    $.ajax({
                        url: "{{ url('/api/admin/slideshow/showAll') }}",
                        method: 'GET',
                        success: (response) => {
                            if (response.status === 'success' && response.data.original.data) {
                                const existingSlides = response.data.original.data;
                                existingSlides.forEach((slide, index) => {

                                    if (index < 3) {
                                        this.slideshows[index] = {
                                            id: slide.id,
                                            headline: slide.headline,
                                            photoPreview: slide.file,
                                        };
                                    }
                                });
                            }
                            this.isLoading = false;
                        },
                        error: (err) => {
                            this.isLoading = false;
                            console.error('Gagal memuat data slideshow:', err);
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


                deleteSlide(index) {
                    const slide = this.slideshows[index];


                    if (slide && slide.id) {
                        const slideId = slide.id;
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Slide beserta headlinenya akan dihapus permanen!",
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
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: (response) => {
                                        this.slideshows[index] = {
                                            id: null,
                                            headline: '',
                                            photoPreview: null
                                        };
                                        Swal.fire('Dihapus!', 'Slideshow berhasil dihapus.', 'success');
                                    },
                                    error: (xhr) => {
                                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.',
                                            'error');
                                    }
                                });
                            }
                        });
                    } else {

                        this.slideshows[index] = {
                            id: null,
                            headline: '',
                            photoPreview: null
                        };
                        document.getElementById(`file-upload-${index}`).value = null;
                    }
                },

                submitForm() {
                    const form = this.$el;
                    const formData = new FormData(form);
                    formData.append('_method', 'PUT');
                    Swal.fire({
                        title: 'Menyimpan perubahan...',
                        text: 'Mohon tunggu sebentar.',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });

                    $.ajax({
                        url: "{{ url('/api/admin/slideshow/update') }}",
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            Swal.fire('Berhasil!', 'Perubahan slideshow berhasil disimpan.', 'success')
                                .then(() => window.location.reload());
                        },
                        error: (xhr) => {
                            let message = xhr.responseJSON?.message || 'Terjadi kesalahan saat menyimpan data.';
                            console.error('Error response:', xhr.responseJSON);
                            Swal.fire('Gagal!', message, 'error');
                        }
                    });
                }
            }
        }
    </script>
@endpush
