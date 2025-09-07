@extends('layouts.form-cms')

@section('title', 'Tambah Data Majalah')

@section('backUrl', route('admin.majalah.index'))

@section('pageTitle', 'Tambah Majalah')

@section('formContent')
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">
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
                    <span class="font-semibold">Simpan Data</span>
                </button>
            </div>

        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const apiUrl = "{{ url('admin/api/majalah/create') }}";
                const formData = new FormData(this);

                // --- FUNGSI UNTUK MENGHAPUS PESAN ERROR LAMA ---
                function clearValidationErrors() {
                    $('#main-form').find('input, textarea, select').removeClass('border-red-500');
                    $('#main-form').find('p[id^="error-"]').text('');
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
                            text: response.message || 'Data majalah berhasil disimpan.',
                            icon: 'success',
                        }).then(() => {
                            window.location.href = "{{ route('admin.majalah.index') }}";
                        });
                    },
                    error: function(xhr) {
                        Swal.close();
                        clearValidationErrors();

                        // --- PERBAIKAN UTAMA DI SINI ---
                        if (xhr.status === 422) { // Tangani error validasi dari Laravel
                            const errors = xhr.responseJSON.errors;

                            // Loop melalui setiap error dan tampilkan di bawah field yang sesuai
                            for (const key in errors) {
                                const inputField = $(`[name="${key}"]`);
                                const errorContainer = $(`#error-${key}`);

                                // Tambahkan border merah pada input atau pada uploader
                                inputField.addClass('border-red-500');
                                inputField.closest('.rounded-lg.border').addClass(
                                    'border-red-500');

                                if (errorContainer.length) {
                                    errorContainer.text(errors[key][
                                        0
                                    ]);
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
