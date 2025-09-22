@extends('layouts.form-cms')

@section('title', 'Edit Karya Ilmiah')
@section('backUrl', route('admin.karya-ilmiah.index'))
@section('pageTitle', 'Edit Karya Ilmiah')

@section('formContent')
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                {{-- Form fields akan diisi oleh JavaScript --}}
                <x-input.textarea name="judul" label="Judul Karya Ilmiah" placeholder="Masukkan Judul Karya Ilmiah"
                    :required="true" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input.text name="penulis" label="Penulis" placeholder="Tulis Nama Penulis" :required="true" />
                    <x-input.date name="tanggal_terbit" label="Tanggal" :required="true" />
                </div>

                <x-input.link name="url" label="Link Dokumen" placeholder="https://..." :required="true" />
                <x-input.publish-checkbox name="is_publish" />
            </div>

            <div class="space-y-6">
                {{-- Komponen ini akan menerima gambar dari event JavaScript --}}
                <x-input.image-uploader name="image" />
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                    <span class="font-semibold">Simpan Perubahan</span>
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    {{-- PERBAIKAN: Menggunakan script yang sama persis dengan halaman edit Majalah --}}
    <script>
        $(document).ready(function() {
            function getIdFromUrl() {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get('id');
            }

            const id = getIdFromUrl();

            if (!id) {
                Swal.fire('Error', 'ID Karya Ilmiah tidak ditemukan di URL.', 'error').then(() => {
                    window.location.href = "{{ route('admin.karya-ilmiah.index') }}";
                });
                return;
            }

            function loadInitialData() {
                const apiUrl = `/api/admin/karya-ilmiah/show/${id}`;

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

                            if (data.image) {
                                // Menggunakan asset() untuk path gambar yang benar
                                const imageUrl = `{{ asset('/storage') }}/${data.image}`;

                                // Mengirim event 'update-preview' dengan URL gambar
                                window.dispatchEvent(new CustomEvent('update-preview', {
                                    detail: {
                                        src: imageUrl
                                    }
                                }));
                            }
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Tidak dapat memuat data untuk diedit.', 'error');
                    }
                });
            }

            loadInitialData();

            // --- FUNGSI UNTUK MENGIRIM FORM UPDATE (TETAP SAMA) ---
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const updateUrl = `/api/admin/karya-ilmiah/update/${id}`;
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
                    url: updateUrl,
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
                            text: response.message || 'Data berhasil diperbarui.',
                            icon: 'success',
                        }).then(() => {
                            window.location.href =
                                "{{ route('admin.karya-ilmiah.index') }}";
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
