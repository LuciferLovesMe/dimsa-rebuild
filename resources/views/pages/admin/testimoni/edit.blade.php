@extends('layouts.form-cms')
@section('title', 'Edit Data Testimoni')
@section('backUrl', route('admin.testimoni.index'))
@section('pageTitle', 'Edit Testimoni')

@section('formContent')
    {{-- PERBAIKAN: Menambahkan 'novalidate' untuk mencegah validasi browser --}}
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT') {{-- Menandakan bahwa ini adalah form update --}}
        <div class="max-w-lg mx-auto space-y-6">

            {{-- 1. Combobox untuk memilih alumni --}}
            <div>
                <label for="alumni_id" class="block text-sm font-medium text-gray-700">Pilih Alumni <span
                        class="text-red-600">*</span></label>
                <select id="alumni_id" name="alumni_id" class="mt-1 block w-full" required>
                    {{-- Opsi yang dipilih akan diisi oleh JavaScript --}}
                </select>
            </div>

            {{-- 2. Textarea untuk testimoni --}}
            <x-input.textarea name="testimoni" label="Testimoni" placeholder="Tuliskan testimoni dari alumni"
                :required="true" :rows="8" />

            {{-- 3. Checkbox Publish dan Tombol Simpan --}}
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

    <script>
        $(document).ready(function() {
            // --- Logika untuk mengambil ID dari URL (hanya dari query parameter) ---
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

                const alumniId = $('#alumni_id').val();
                const testimoni = $('textarea[name="testimoni"]').val();

                if (!alumniId || !testimoni) {
                    Swal.fire('Data Tidak Lengkap', 'Mohon pilih alumni dan isi testimoni terlebih dahulu.',
                        'warning');
                    return;
                }

                const apiUrl = `/admin/api/testimoni/${id}/update`;
                const formData = new FormData(this);

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
                        const errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        if (errors) {
                            for (const key in errors) {
                                errorMessages += `<p>${errors[key][0]}</p>`;
                            }
                        }
                        Swal.fire('Gagal!', errorMessages ||
                            'Terjadi kesalahan saat memperbarui data.', 'error');
                    }
                });
            });
        });
    </script>
@endpush
