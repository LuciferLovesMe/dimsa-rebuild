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
            </div>

            <x-input.textarea name="testimoni" label="Testimoni" placeholder="Tuliskan testimoni dari alumni"
                :required="true" :rows="8" />

            <x-input.publish-checkbox name="is_publish" />

            <div class="pt-6 border-t">
                {{-- Mengganti komponen dengan tombol submit standar --}}
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
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // --- INISIALISASI SELECT2 ---
            $('#alumni_id').select2({
                placeholder: 'Cari dan pilih alumni',
                minimumInputLength: 2,
                ajax: {
                    url: `{{ url('api/alumni') }}`,
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        // Memproses data dari API agar sesuai format Select2
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

            // --- FUNGSI SIMPAN DATA ---
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const apiUrl = "{{ url('admin/api/testimoni') }}";
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
                        // Menampilkan modal sukses
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message ||
                                'Data testimoni berhasil disimpan.',
                            icon: 'success',
                        }).then(() => {
                            // Mengarahkan kembali ke halaman index setelah modal ditutup
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
