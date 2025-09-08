@extends('layouts.form-cms')

@section('title', 'Edit Data Ekstrakurikuler')
@section('backUrl', route('admin.ekstrakurikuler.index'))
@section('pageTitle', 'Edit Ekstrakurikuler')

@section('formContent')
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <x-input.textarea name="judul" label="Judul Ektrakurikuler" placeholder="Judul Majalah" :required="true" />
                <x-input.link name="link" label="Link Dokumen" placeholder="Tulis link" :required="true" />
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

            function getIdFormUrl() {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get('id');
            }

            const id = getIdFormUrl();

            if (!id) {
                Swal.fire('Error', 'ID Ekstrakurikuler tidak valid atau tidak ditemukan di URL.', 'error');
                return;
            }

            function loadInitialData() {
                const apiUrl = `{{ url('admin/api/ekstrakulikuler') }}/${id}`;
                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(response) {
                        const data = response.data;
                        if (data) {
                            $('textarea[name="judul"]').val(data.judul);
                            $('input[name="link"]').val(data.link);
                            $('input[name="is_publish"]').prop('checked', data.is_publish == 1);

                            const imageUrl = `{{ asset('uploads/ekstrakulikuler') }}/${data.image}`;

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

                const apiUrl = `{{ url('admin/api/ekstrakulikuler') }}/${id}/update`;
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
                                'Data ekstrakurikuler berhasil diperbarui.',
                            icon: 'success',
                        }).then(() => {
                            window.location.href =
                                "{{ route('admin.ekstrakurikuler.index') }}";
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
