@extends('layouts.form-cms')

@section('title', 'Tambah Data Fasilitas')
@section('backUrl', route('admin.fasilitas.index'))
@section('pageTitle', 'Tambah Fasilitas')

@section('formContent')
    <form id="main-form" action="{{ url('admin/api/fasilitas/create') }}" method="POST" enctype="multipart/data">
        @csrf
        <x-input.text name="judul" label="Judul Fasilitas" placeholder="Masukkan Fasilitas" :required="true" />

        <div class="my-4">
            <label class="block text-sm font-medium text-gray-700" for="file">
                Foto Fasilitas
                <span class="text-red-600">*</span>
            </label>
            {{-- Beri ID pada container grid agar mudah ditarget oleh JavaScript --}}
            <div id="image-uploaders-container" class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-2">
                <x-input.image-uploader name="image[]" />
                <x-input.image-uploader name="image[]" />
                <x-input.image-uploader name="image[]" />
            </div>
            <p id="error-image" class="text-xs text-red-500 mt-1"></p>
        </div>

        <div class="pt-6 border-t mt-8">
            <div class="flex justify-between items-center">
                <x-input.publish-checkbox name="is_publish" />
                <button type="submit"
                    class="w-full sm:w-fit flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                    <span class="font-semibold">Tambah Data</span>
                </button>
            </div>
        </div>

    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // --- SCRIPT BARU UNTUK MENANGANI SETIAP UPLOADER SECARA INDEPENDEN ---

            // Kita menargetkan setiap komponen uploader di dalam container
            $('#image-uploaders-container > div').each(function() {
                const uploader = $(this); // 'this' adalah div container dari satu komponen
                const input = uploader.find('input[type="file"]');
                const preview = uploader.find('img');
                const placeholder = uploader.find('div:not(:has(img))'); // Menemukan div placeholder

                input.on('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            // Update preview di dalam uploader yang sama
                            preview.attr('src', e.target.result).removeClass('hidden');
                            // Sembunyikan teks placeholder
                            placeholder.addClass('hidden');
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });

            // --- Script AJAX untuk submit form (tidak berubah, sudah benar) ---
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const form = $(this);
                const url = form.attr('action');
                const formData = new FormData(this);

                function clearValidationErrors() {
                    form.find('.border-red-500').removeClass('border-red-500');
                    form.find('p[id^="error-"]').text('');
                }

                Swal.fire({
                    title: 'Menyimpan data...',
                    text: 'Mohon tunggu sebentar.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: url,
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
                            text: 'Data fasilitas berhasil ditambahkan.',
                            icon: 'success',
                        }).then(() => {
                            window.location.href =
                                "{{ route('admin.fasilitas.index') }}";
                        });
                    },
                    error: function(xhr) {
                        Swal.close();
                        clearValidationErrors();

                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            for (const key in errors) {
                                const errorKey = key.split('.')[0];
                                const inputField = $(`[name^="${errorKey}"]`);
                                const errorContainer = $(`#error-${errorKey}`);
                                inputField.closest('.relative').find('.border').addClass(
                                    'border-red-500');
                                if (errorContainer.length) {
                                    errorContainer.text(errors[key][0]);
                                }
                            }
                        } else {
                            const errorMsg = xhr.responseJSON ? xhr.responseJSON.message :
                                'Terjadi kesalahan saat menyimpan data.';
                            Swal.fire('Gagal!', errorMsg, 'error');
                        }
                    }
                });
            });
        });
    </script>
@endpush
