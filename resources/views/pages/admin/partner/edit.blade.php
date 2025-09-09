@extends('layouts.form-cms')

@section('title', 'Edit Data Partner Lembaga')
@section('backUrl', route('admin.partner.index'))
@section('pageTitle', 'Edit Data Partner Lembaga')

@section('formContent')
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="w-full space-y-6">

            <x-input.image-uploader name="logo" />

            <x-input.text name="nama_mitra" label="Nama Partner" placeholder="Masukkan Nama Partner" :required="true" />

            <x-input.publish-checkbox name="is_publish" />

            <div class="pt-6 border-t">
                <x-button.save text="Simpan Data" />
            </div>

        </div>
    </form>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            function getIdFormUrl() {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get('id');
            }
            const id = getIdFormUrl();

            if (!id) {
                Swal.fire('Error', 'ID Partner tidak valid atau tidak ditemukan di URL.', 'error');
                return;
            }

            function loadInitialData() {
                // URL ini sudah sesuai dengan daftar route Anda
                const apiUrl = `{{ url('api/admin/partner/show/') }}/${id}`;
                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(response) {
                        // Key 'data' sudah sesuai dengan response API Anda
                        const data = response.data;
                        if (data) {
                            // --- PERBAIKAN 1: Mengisi data teks & checkbox ---
                            $('input[name="nama_mitra"]').val(data.nama_mitra);
                            $('input[name="is_publish"]').prop('checked', data.is_publish == 1);

                            // --- PERBAIKAN 2: Menampilkan preview gambar ---
                            // Hapus baris $('input[name="logo"]').val(data.logo); karena tidak berfungsi.

                            // Gunakan nilai 'logo' langsung dari API. Jika tidak ada, gunakan placeholder.
                            const imageUrl = data.logo ? data.logo :
                                'https://placehold.co/400x400?text=No+Image';

                            // Kirim event ke komponen image-uploader Anda untuk menampilkan preview
                            window.dispatchEvent(new CustomEvent('update-preview', {
                                detail: {
                                    src: imageUrl
                                }
                            }));
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat mengambil detail data.', 'error');
                    }
                })
            }
            loadInitialData();


            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const apiUrl = `{{ url('api/admin/partner/update/') }}/${id}`;
                const formData = new FormData(this);

                // --- PERBAIKAN 3: Method Spoofing untuk update ---
                // Tambahkan field _method untuk memberitahu Laravel ini adalah request PUT
                formData.append('_method', 'PUT');

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
                    method: 'POST', // Gunakan POST untuk method spoofing
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
                                'Data partner berhasil diperbarui.',
                            icon: 'success',
                        }).then(() => {
                            // --- PERBAIKAN 4: Arahkan ke route yang benar ---
                            window.location.href =
                                "{{ route('admin.partner.index') }}";
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
                            const errorMsg = xhr.responseJSON ? xhr.responseJSON.message :
                                'Terjadi kesalahan.';
                            Swal.fire('Gagal!', errorMsg, 'error');
                        }
                    }
                });
            });

        });
    </script>
@endpush
