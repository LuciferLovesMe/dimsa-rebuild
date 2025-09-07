@extends('layouts.form-cms')

@section('title', 'Edit Data QnA')
@section('backUrl', route('admin.qna.index'))
@section('pageTitle', 'Edit QnA')

@section('formContent')
    <form id="main-form" action="#" method="POST" class="flex flex-col" style="min-height: 65vh;">
        @csrf
        @method('PUT') {{-- Menandakan bahwa ini adalah form update --}}

        <div class="flex-grow flex flex-col md:flex-row gap-6 w-full">

            <div class="w-full flex flex-col">
                <label for="pertanyaan" class="block text-sm font-medium text-gray-700">Pertanyaan <span
                        class="text-red-600">*</span></label>
                <textarea name="pertanyaan" id="pertanyaan"
                    class="border mt-1 flex-grow p-4 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Masukkan Pertanyaan" required></textarea>
                {{-- Container untuk pesan error dari AJAX --}}
                <p id="error-pertanyaan" class="mt-1 text-xs text-red-600"></p>
            </div>

            <div class="w-full flex flex-col">
                <label for="jawaban" class="block text-sm font-medium text-gray-700">Jawaban <span
                        class="text-red-600">*</span></label>
                <textarea name="jawaban" id="jawaban"
                    class="border mt-1 flex-grow p-4 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Masukkan Jawaban" required></textarea>
                {{-- Container untuk pesan error dari AJAX --}}
                <p id="error-jawaban" class="mt-1 text-xs text-red-600"></p>
            </div>

        </div>

        <div class="pt-6 border-t mt-6 space-y-4">
            <x-input.publish-checkbox name="is_publish" label="*Centang box disamping untuk publish data ke website!" />

            <div class="w-full">
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
                return urlParams.get('id'); // Mengambil dari ?id=...
            }

            const id = getIdFromUrl();

            if (!id) {
                Swal.fire('Error', 'ID QnA tidak valid atau tidak ditemukan di URL.', 'error');
                return;
            }

            // --- FUNGSI UNTUK MEMUAT DATA AWAL ---
            function loadInitialData() {
                const apiUrl = `{{ url('/admin/api/qna') }}/${id}`;
                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(response) {
                        const data = response.data;
                        if (data) {
                            // Mengisi form dengan data yang ada
                            $('textarea[name="pertanyaan"]').val(data.pertanyaan);
                            $('textarea[name="jawaban"]').val(data.jawaban);
                            $('input[name="is_publish"]').prop('checked', data.is_publish == 1);
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Tidak dapat memuat data QnA untuk diedit.', 'error');
                    }
                });
            }

            loadInitialData();

            // --- FUNGSI UNTUK MENGIRIM FORM UPDATE ---
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const apiUrl = `{{ url('/admin/api/qna') }}/${id}/update`;
                const formData = new FormData(this);

                function clearValidationErrors() {
                    $('#main-form').find('textarea').removeClass('border-red-500');
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
                    method: 'POST', // Gunakan POST untuk mengirim FormData dengan method spoofing
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message || 'Data QnA berhasil diperbarui.',
                            icon: 'success',
                        }).then(() => {
                            window.location.href = "{{ route('admin.qna.index') }}";
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
