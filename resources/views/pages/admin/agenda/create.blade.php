@extends('layouts.form-cms')
@section('title', 'Tambah Data Agenda')
@section('backUrl', route('admin.agenda.index'))
@section('pageTitle', 'Tambah Agenda')
@section('formContent')
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 flex flex-col gap-y-6">

                <x-input.text name="nama" label="Nama Agenda" placeholder="Masukkan Nama Agenda" :required="true" />

                {{-- PERBAIKAN: Memisahkan input tanggal dan waktu menjadi dua kolom --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input.date name="tanggal" label="Tanggal Agenda" :required="true" />
                    <x-input.time name="waktu" label="Waktu Agenda" :required="true" />
                </div>

                <x-input.textarea name="alamat" label="Alamat Agenda" placeholder="Masukkan Alamat Lengkap Agenda"
                    :required="true" :rows="5" />

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

                const apiUrl = "{{ url('/admin/api/agenda/create') }}";
                const formData = new FormData(this);

                const tanggal = $('input[name="tanggal"]').val();
                const waktu = $('input[name="waktu"]').val();

                if (tanggal && waktu) {
                    const datetime = `${tanggal} ${waktu}`;
                    formData.append('datetime', datetime);
                }

                formData.delete('tanggal');
                formData.delete('waktu');


                function clearValidationErrors() {
                    $('#main-form').find('input, textarea').removeClass('border-red-500');
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
                            text: response.message || 'Data agenda berhasil disimpan.',
                            icon: 'success',
                        }).then(() => {
                            window.location.href = "{{ route('admin.agenda.index') }}";
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
