@extends('layouts.form-cms')

@section('title', 'Tambah Data QnA')
@section('backUrl', route('admin.qna.index'))
@section('pageTitle', 'Tambah QnA')

@section('formContent')
    <form id="main-form" action="#" method="POST" class="flex flex-col" style="min-height: 65vh;">
        @csrf

        <div class="flex-grow flex flex-col md:flex-row gap-6 w-full">

            <div class="w-full flex flex-col">
                <label for="pertanyaan" class="block text-sm font-medium text-gray-700">Pertanyaan <span
                        class="text-red-600">*</span></label>
                {{-- Menggunakan styling baru dan nama input yang benar --}}
                <textarea name="pertanyaan" id="pertanyaan"
                    class="border mt-1 flex-grow p-4 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Masukkan Pertanyaan" required></textarea>
            </div>

            <div class="w-full flex flex-col">
                <label for="jawaban" class="block text-sm font-medium text-gray-700">Jawaban <span
                        class="text-red-600">*</span></label>
                {{-- Menggunakan styling baru dan nama input yang benar --}}
                <textarea name="jawaban" id="jawaban"
                    class="border mt-1 flex-grow p-4 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Masukkan Jawaban" required></textarea>
            </div>

        </div>

        <div class="pt-6 border-t mt-6 space-y-4">
            {{-- PERBAIKAN: Mengganti komponen dengan HTML langsung untuk memastikan nilai 0 terkirim --}}
            <div class="relative flex items-start">
                <div class="flex h-5 items-center">
                    {{-- Input tersembunyi ini akan mengirimkan nilai '0' jika checkbox tidak dicentang --}}
                    <input type="hidden" name="is_publish" value="0">
                    <input id="is_publish" name="is_publish" type="checkbox" value="1"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                </div>
                <div class="ml-3 text-sm">
                    <label for="is_publish" class="font-medium text-gray-700">*Centang box disamping untuk publish data ke
                        website!</label>
                </div>
            </div>


            <div class="w-full">
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

                // PERBAIKAN: Menggunakan URL API yang benar sesuai file web.php
                const apiUrl = "{{ url('/admin/api/qna') }}";
                const formData = new FormData(this);

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
                            text: response.message || 'Data QnA berhasil disimpan.',
                            icon: 'success',
                        }).then(() => {
                            window.location.href = "{{ route('admin.qna.index') }}";
                        });
                    },
                    error: function(xhr) {
                        Swal.close();
                        const errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        if (errors) {
                            for (const key in errors) {
                                errorMessages += `<p>${errors[key][0]}</p>`;
                            }
                        }
                        Swal.fire(
                            'Gagal!',
                            errorMessages || 'Terjadi kesalahan saat menyimpan data.',
                            'error'
                        );
                    }
                });
            });
        });
    </script>
@endpush
