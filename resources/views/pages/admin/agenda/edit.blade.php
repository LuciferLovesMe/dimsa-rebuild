@extends('layouts.form-cms')
@section('title', 'Edit Data Agenda')
@section('backUrl', route('admin.agenda.index'))
@section('pageTitle', 'Edit Agenda')

@section('formContent')
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Menandakan bahwa ini adalah form update --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 flex flex-col gap-y-6">
                {{-- Komponen akan diisi datanya oleh JavaScript --}}
                <x-input.text name="nama" label="Nama Agenda" placeholder="Masukkan Nama Agenda" :required="true" />

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
                Swal.fire('Error', 'ID Agenda tidak valid atau tidak ditemukan di URL.', 'error');
                return;
            }

            // --- FUNGSI UNTUK MEMUAT DATA AWAL ---
            function loadInitialData() {
                const apiUrl = `{{ url('/admin/api/agenda') }}/${id}`;

                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(response) {
                        const data = response.data;
                        if (data) {
                            // Mengisi form dengan data yang ada
                            $('input[name="nama"]').val(data.nama);
                            $('textarea[name="alamat"]').val(data.alamat);
                            $('input[name="is_publish"]').prop('checked', data.is_publish == 1);

                            // Memisahkan datetime menjadi tanggal dan waktu
                            if (data.datetime) {
                                const [dateValue, timeValue] = data.datetime.split(' ');
                                $('input[name="tanggal"]').val(dateValue);
                                $('input[name="waktu"]').val(timeValue.substring(0, 5));
                            }

                            // Memperbarui pratinjau gambar di komponen
                            const imageUrl = `{{ asset('/uploads/agenda/') }}/${data.image}`;
                            window.dispatchEvent(new CustomEvent('update-preview', {
                                detail: {
                                    src: imageUrl
                                }
                            }));
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Tidak dapat memuat data agenda untuk diedit.',
                            'error');
                    }
                });
            }

            loadInitialData();

            // --- FUNGSI UNTUK MENGIRIM FORM UPDATE ---
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const apiUrl = `{{ url('/admin/api/agenda') }}/${id}/update`;
                const formData = new FormData(this);

                // Menggabungkan tanggal dan waktu sebelum mengirim
                const tanggal = $('input[name="tanggal"]').val();
                const waktu = $('input[name="waktu"]').val();
                if (tanggal && waktu) {
                    formData.append('datetime', `${tanggal} ${waktu}`);
                }
                formData.delete('tanggal');
                formData.delete('waktu');

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
                                'Data agenda berhasil diperbarui.',
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
                                let fieldName = key;
                                // Jika error untuk 'datetime', kita tandai kedua input
                                if (key === 'datetime') {
                                    $('input[name="tanggal"]').addClass('border-red-500');
                                    $('input[name="waktu"]').addClass('border-red-500');
                                    $('#error-tanggal').text(errors[key][0]);
                                } else {
                                    const inputField = $(`[name="${fieldName}"]`);
                                    const errorContainer = $(`#error-${fieldName}`);
                                    inputField.addClass('border-red-500');
                                    if (errorContainer.length) {
                                        errorContainer.text(errors[key][0]);
                                    }
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
