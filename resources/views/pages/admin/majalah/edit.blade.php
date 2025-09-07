@extends('layouts.form-cms')

@section('title', 'Edit Data Majalah')
@section('backUrl', route('admin.majalah.index'))
@section('pageTitle', 'Edit Majalah')

@section('formContent')
    {{-- Menambahkan ID pada form dan method spoofing untuk update --}}
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                {{-- Komponen akan diisi datanya oleh JavaScript --}}
                <x-input.textarea name="judul" label="Judul Majalah" placeholder="Judul Majalah" :required="true" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input.text name="penulis" label="Penulis" placeholder="Tulis Nama Penulis" :required="true" />
                    <x-input.date name="tanggal_terbit" label="Tanggal" :required="true" />
                </div>

                <x-input.link name="url" label="Link Dokumen" placeholder="Tulis link" :required="true" />
                <x-input.publish-checkbox name="is_publish" />
            </div>

            <div class="space-y-6">
                <x-input.image-uploader name="image" />
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                    <span class="font-semibold">Perbarui Data</span>
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // --- FUNGSI UNTUK MENGAMBIL ID DARI URL ---
            function getIdFromUrl() {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get('id');
            }

            const id = getIdFromUrl();

            if (!id) {
                Swal.fire('Error', 'ID Majalah tidak valid atau tidak ditemukan di URL.', 'error');
                return;
            }

            // --- FUNGSI UNTUK MEMUAT DATA AWAL ---
            function loadInitialData() {
                const apiUrl = `{{ url('admin/api/majalah') }}/${id}`;
                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(response) {
                        const data = response.data;
                        if (data) {
                            $('textarea[name="judul"]').val(data.judul);
                            $('input[name="penulis"]').val(data.penulis);
                            $('input[name="tanggal_terbit"]').val(data.tanggal_terbit);
                            $('input[name="url"]').val(data.url);
                            $('input[name="is_publish"]').prop('checked', data.is_publish == 1);

                            const imageUrl = `{{ asset('uploads/publikasi/majalah') }}/${data.image}`;
                            // Kirim event yang akan ditangkap oleh komponen Alpine.js
                            window.dispatchEvent(new CustomEvent('update-preview', {
                                detail: {
                                    src: imageUrl
                                }
                            }));
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Tidak dapat memuat data majalah untuk diedit.', 'error');
                    }
                });
            }

            loadInitialData();

            // --- FUNGSI UNTUK MENGIRIM FORM UPDATE ---
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const apiUrl = `{{ url('admin/api/majalah') }}/${id}/update`;
                const formData = new FormData(this);

                function clearValidationErrors() {
                    $('#main-form').find('input, textarea').removeClass('border-red-500');
                    $('#main-form').find('p[id^="error-"]').text('');
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
                                'Data majalah berhasil diperbarui.',
                            icon: 'success',
                        }).then(() => {
                            window.location.href = "{{ route('admin.majalah.index') }}";
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
                                if (errorContainer.length) {
                                    errorContainer.text(errors[key][0]);
                                }
                            }
                        } else {
                            Swal.fire('Gagal!', xhr.responseJSON.message ||
                                'Terjadi kesalahan.', 'error');
                        }
                    }
                });
            });
        });
    </script>
@endpush
