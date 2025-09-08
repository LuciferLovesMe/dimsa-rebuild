@extends('layouts.form-cms')

@section('title', 'Edit Data Pengumuman')
@section('backUrl', route('admin.pengumuman.index'))
@section('pageTitle', 'Edit Pengumuman')

@section('formContent')
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Menandakan bahwa ini adalah form update --}}
        <div class="space-y-6">

            {{-- Input untuk Judul --}}
            <x-input.text name="judul" label="Judul Pengumuman" placeholder="Masukkan Judul" :required="true" />

            {{-- Input untuk Tanggal --}}
            <x-input.date name="tanggal" label="Tanggal Publikasi" :required="true" />

            {{-- Input untuk Link/URL (Opsional) --}}
            <x-input.link name="url" label="Link Terkait (Opsional)" placeholder="https://..." />

            {{-- Textarea untuk Deskripsi --}}
            <x-input.textarea name="deskripsi" label="Isi Pengumuman" placeholder="Tulis isi pengumuman di sini..."
                :required="true" :rows="10" />

            {{-- Checkbox Publish dan Tombol Simpan --}}
            <div class="pt-6 border-t">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                    <x-input.publish-checkbox name="is_publish" />
                    <button type="submit"
                        class="w-full sm:w-fit flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                        <span class="font-semibold">Perbarui Data</span>
                    </button>
                </div>
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
                return urlParams.get('id'); // Mengambil dari ?id=...
            }

            const id = getIdFromUrl();

            if (!id) {
                Swal.fire('Error', 'ID Pengumuman tidak valid atau tidak ditemukan di URL.', 'error');
                return;
            }

            // --- FUNGSI UNTUK MEMUAT DATA AWAL ---
            function loadInitialData() {
                const apiUrl = `{{ url('/admin/api/pengumuman') }}/${id}`;
                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(response) {
                        const data = response.data;
                        if (data) {
                            // Mengisi form dengan data yang ada
                            $('input[name="judul"]').val(data.judul);
                            $('input[name="tanggal"]').val(data.tanggal);
                            $('input[name="url"]').val(data.url);
                            $('textarea[name="deskripsi"]').val(data.deskripsi);
                            $('input[name="is_publish"]').prop('checked', data.is_publish == 1);
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Tidak dapat memuat data pengumuman untuk diedit.',
                            'error');
                    }
                });
            }

            loadInitialData();

            // --- FUNGSI UNTUK MENGIRIM FORM UPDATE ---
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const apiUrl = `{{ url('/admin/api/pengumuman') }}/${id}/update`;
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
                    method: 'POST', // Menggunakan POST untuk mengirim FormData dengan method spoofing
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
                                'Data pengumuman berhasil diperbarui.',
                            icon: 'success',
                        }).then(() => {
                            window.location.href =
                                "{{ route('admin.pengumuman.index') }}";
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
