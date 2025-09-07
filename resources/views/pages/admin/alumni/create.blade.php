@extends('layouts.form-cms')

@section('title', 'Tambah Data Alumni')
@section('backUrl', route('admin.alumni.index'))
@section('pageTitle', 'Tambah Alumni')

@section('formContent')

    {{-- Menyiapkan data untuk options dropdown --}}
    @php
        $tahunLulusOptions = [];
        for ($year = date('Y'); $year >= date('Y') - 15; $year--) {
            $tahunLulusOptions[] = ['value' => $year, 'text' => $year];
        }

        $lembagaOptions = [['value' => '0', 'text' => 'SMP Darun Ihsan'], ['value' => '1', 'text' => 'MA Darun Ihsan']];
    @endphp

    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
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

                const apiUrl = "{{ url('/admin/api/alumni/create') }}";
                const formData = new FormData(this);

                function clearValidationErrors() {
                    $('#main-form').find('input, select').removeClass('border-red-500');
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
                            text: response.message || 'Data alumni berhasil disimpan.',
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
