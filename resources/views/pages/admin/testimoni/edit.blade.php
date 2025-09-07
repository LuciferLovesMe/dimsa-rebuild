@extends('layouts.form-cms')
@section('title', 'Edit Data Testimoni')
@section('backUrl', route('admin.testimoni.index'))
@section('pageTitle', 'Edit Testimoni')

@section('formContent')

    <form id="main-form" action="#" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="w-full space-y-6">


            <div>
                <label for="alumni_id" class="block text-sm font-medium text-gray-700">Pilih Alumni <span
                        class="text-red-600">*</span></label>
                <select id="alumni_id" name="alumni_id" class="mt-1 block w-full" required>

                </select>
            </div>

            <x-input.textarea name="testimoni" label="Testimoni" placeholder="Tuliskan testimoni dari alumni"
                :required="true" :rows="8" />


            <x-input.publish-checkbox name="is_publish" />
            <div class="pt-6 border-t">
                <x-button.save text="Perbarui Data" />
            </div>

        </div>
    </form>
@endsection

@push('styles')
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
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // --- Logika untuk mengambil ID dari URL ---
            function getIdFromUrl() {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get('id');
            }

            const id = getIdFromUrl();
            const alumniSelect = $('#alumni_id');

            if (!id) {
                Swal.fire('Error Kritis', 'ID testimoni tidak dapat ditemukan di URL.', 'error');
                return;
            }

            // --- FUNGSI UNTUK MEMUAT DATA AWAL ---
            function loadInitialData() {
                $.ajax({
                    url: `/admin/api/testimoni/${id}`,
                    method: 'GET',
                    success: function(response) {
                        if (response.status === 'success' && response.data) {
                            const data = response.data;
                            $('textarea[name="testimoni"]').val(data.testimoni);
                            $('input[name="is_publish"]').prop('checked', data.is_publish == 1);
                            if (data.alumni) {
                                const option = new Option(data.alumni.nama_alumni, data.alumni.id, true,
                                    true);
                                alumniSelect.append(option).trigger('change');
                            }
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', xhr.responseJSON.message ||
                            'Tidak dapat memuat data testimoni.', 'error');
                    }
                });
            }

            // --- INISIALISASI SELECT2 ---
            alumniSelect.select2({
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

            loadInitialData();

            // --- FUNGSI UPDATE DATA ---
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const apiUrl = `/admin/api/testimoni/${id}/update`;
                const formData = new FormData(this);

                function clearValidationErrors() {
                    $('#main-form').find('select, textarea').removeClass('border-red-500');
                    $('#main-form').find('p[id^="error-"]').text('');
                    $('#main-form').find('.select2-selection').removeClass('border-red-500');
                }

                Swal.fire({
                    title: 'Memperbarui data...',
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
                                'Data testimoni berhasil diperbarui.',
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

                                inputField.addClass('border-red-500');
                                if (key === 'alumni_id') {
                                    inputField.next('.select2-container').find(
                                        '.select2-selection').addClass('border-red-500');
                                }

                                if (errorContainer.length) {
                                    errorContainer.text(errors[key][0]);
                                }
                            }
                        } else {
                            Swal.fire('Gagal!', xhr.responseJSON.message ||
                                'Terjadi kesalahan saat memperbarui data.', 'error');
                        }
                    }
                });
            });
        });
    </script>
@endpush
