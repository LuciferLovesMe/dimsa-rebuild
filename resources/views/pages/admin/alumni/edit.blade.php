@extends('layouts.form-cms')

@section('title', 'Edit Data Alumni')
@section('backUrl', route('admin.alumni.index'))
@section('pageTitle', 'Edit Alumni')

@section('formContent')

    @php
        $tahunLulusOptions = [];
        for ($year = date('Y'); $year >= date('Y') - 15; $year--) {
            $tahunLulusOptions[] = ['value' => $year, 'text' => $year];
        }

        $lembagaOptions = [['value' => '0', 'text' => 'SMP Darun Ihsan'], ['value' => '1', 'text' => 'MA Darun Ihsan']];
    @endphp

    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="w-full mx-auto space-y-6">

            <label class="block text-sm font-medium text-gray-700" for="image">Foto Alumni
                <span class="text-red-600">*</span>
            </label>
            <x-input.image-uploader name="image" />

            <x-input.text name="nama_alumni" label="Nama Alumni" placeholder="Masukkan Nama Lengkap" :required="true" />

            <x-input.select name="tahun_lulus" label="Tahun Lulus" :required="true" :options="$tahunLulusOptions" />

            <x-input.text name="pekerjaan" label="Pekerjaan" placeholder="Masukkan Pekerjaan Saat Ini" :required="true" />

            <x-input.select name="lembaga" label="Lembaga" :required="true" :options="$lembagaOptions" />

            <div class="pt-6 border-t">
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
            function getIdFromUrl() {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get('id');
            }

            const id = getIdFromUrl();

            if (!id) {
                Swal.fire('Error', 'ID Alumni tidak valid atau tidak ditemukan di URL.', 'error');
                return;
            }
            // --- FUNGSI UNTUK MEMUAT DATA AWAL ---
            function loadInitialData() {
                const apiUrl = `{{ url('/admin/api/alumni') }}/${id}`;

                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(response) {
                        const data = response.data ? response.data : response;
                        if (data) {
                            $('input[name="nama_alumni"]').val(data.nama_alumni);
                            $('select[name="tahun_lulus"]').val(data.tahun_lulus);
                            $('input[name="pekerjaan"]').val(data.pekerjaan);
                            $('select[name="lembaga"]').val(data.lembaga);

                            const imageUrl = `{{ asset('/uploads/alumni/') }}/${data.image}`;
                            window.dispatchEvent(new CustomEvent('update-preview', {
                                detail: {
                                    src: imageUrl
                                }
                            }));
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Tidak dapat memuat data alumni untuk diedit.', 'error');
                    }
                });
            }

            loadInitialData();

            // --- FUNGSI UNTUK MENGIRIM FORM UPDATE ---
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const apiUrl = `{{ url('/admin/api/alumni') }}/${id}/update`;
                const formData = new FormData(this);

                function clearValidationErrors() {
                    $('#main-form').find('input, select').removeClass('border-red-500');
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
                                'Data alumni berhasil diperbarui.',
                            icon: 'success',
                        }).then(() => {
                            window.location.href = "{{ route('admin.alumni.index') }}";
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
