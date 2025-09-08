@extends('layouts.form-cms')

@section('title', 'Tambah Data Pengumuman')
@section('backUrl', route('admin.pengumuman.index'))
@section('pageTitle', 'Tambah Pengumuman')

@section('formContent')
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">

            {{-- Input untuk Judul --}}
            <x-input.text name="judul" label="Judul Pengumuman" placeholder="Masukkan Judul" :required="true" />

            {{-- PERBAIKAN: Mengganti CKEditor dengan komponen textarea standar --}}
            <x-input.textarea name="deskripsi" label="Isi Pengumuman" placeholder="Tulis isi pengumuman di sini..."
                :required="true" :rows="10" />

            {{-- Input untuk Tanggal --}}
            <x-input.date name="tanggal" label="Tanggal Publikasi" :required="true" />

            {{-- Input untuk Link/URL (Opsional) --}}
            <x-input.link name="url" label="Link Terkait (Opsional)" placeholder="https://..." />


            {{-- Checkbox Publish dan Tombol Simpan --}}
            <div class="pt-6 border-t">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                    <x-input.publish-checkbox name="is_publish" />
                    <button type="submit"
                        class="w-full sm:w-fit flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                        <span class="font-semibold">Simpan Data</span>
                    </button>
                </div>
            </div>

        </div>
    </form>
@endsection

@push('scripts')
    {{-- PERBAIKAN: Menghapus skrip CKEditor dan menyederhanakan AJAX --}}
    <script>
        $(document).ready(function() {
            // Fungsi untuk mengirim form
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const apiUrl =
                    "{{ url('/admin/api/pengumuman/create') }}"; // Sesuaikan dengan rute create Anda
                const formData = new FormData(this);

                function clearValidationErrors() {
                    $('#main-form').find('input, textarea').removeClass('border-red-500');
                    $('#main-form').find('p[id^="error-"]').text('');
                }

                Swal.fire({
                    title: 'Menyimpan data...',
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
                                'Data pengumuman berhasil disimpan.',
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
