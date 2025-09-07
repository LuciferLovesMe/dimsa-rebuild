@extends('layouts.form-cms')
@section('title', 'Tambah Data Testimoni')
@section('backUrl', route('admin.testimoni.index'))
@section('pageTitle', 'Tambah Testimoni')

@section('formContent')
    {{-- Menambahkan ID pada form untuk target JavaScript --}}
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full space-y-6">

            <div class="relative">
                <label for="alumni_id" class="block text-sm font-medium text-gray-700">Pilih Alumni <span
                        class="text-red-600">*</span></label>
                <select id="alumni_id" name="alumni_id"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
                    <option value="">Cari nama alumni...</option>
                </select>
                {{-- Container untuk pesan error dari AJAX --}}
                <p id="error-alumni_id" class="mt-1 text-xs text-red-600"></p>
            </div>

            <x-input.textarea name="testimoni" label="Testimoni" placeholder="Tuliskan testimoni dari alumni"
                :required="true" :rows="8" />

            <x-input.publish-checkbox name="is_publish" />

            <div class="pt-6 border-t">
                {{-- Menggunakan tombol submit standar agar event form terpicu --}}
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                    <span class="font-semibold">Simpan Data</span>
                </button>
            </div>

        </div>
    </form>
@endsection

@push('styles')
    {{-- Menambahkan style untuk Select2 agar tampilannya konsisten --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 42px !important;
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 42px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
        }

        .select2-container--default.select2-container--open .select2-selection--single {
            border-color: #4f46e5 !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#alumni_id').select2({
                placeholder: 'Cari dan pilih alumni',
                minimumInputLength: 2,
                ajax: {
                    url: `{{ url('api/alumni') }}`,
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.nama_alumni,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const apiUrl = "{{ url('admin/api/testimoni/create') }}";
                const formData = new FormData(this);

                function clearValidationErrors() {
                    $('#main-form').find('select, textarea').removeClass('border-red-500');
                    $('#main-form').find('p[id^="error-"]').text('');
                    $('#main-form').find('.select2-selection').removeClass('border-red-500');
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
                            text: response.message ||
                                'Data testimoni berhasil disimpan.',
                            icon: 'success',
                        }).then(() => {
                            window.location.href =
                                "{{ route('admin.testimoni.index') }}";
                        });
                    },
                    error: function(xhr) {
                        Swal.close();
                        clearValidationErrors();

                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            for (const key in errors) {
                                const inputField = $(`[name="${key}"]`);
                                const errorContainer = $(`#error-${key}`);

                                // Menambahkan border merah pada input/textarea/select
                                inputField.addClass('border-red-500');
                                // Khusus untuk Select2, target elemen yang terlihat
                                if (key === 'alumni_id') {
                                    inputField.next('.select2-container').find(
                                        '.select2-selection').addClass('border-red-500');
                                }

                                if (errorContainer.length) {
                                    errorContainer.text(errors[key][0]);
                                }
                            }
                        } else {
                            Swal.fire(
                                'Gagal!',
                                xhr.responseJSON.message ||
                                'Terjadi kesalahan saat menyimpan data.',
                                'error'
                            );
                        }
                    }
                });
            });
        });
    </script>
@endpush
