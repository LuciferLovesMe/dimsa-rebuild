@extends('layouts.form-cms')

@section('title', 'Tambah Data Lowongan Kerja')
@section('backUrl', route('admin.lowongan-kerja.index'))
@section('pageTitle', 'Informasi Pekerjaan')

@section('formContent')

    @php
        $defaultKualifikasi = [
            ['deskripsi' => 'Usia 22 - 35 tahun'],
            ['deskripsi' => 'Minimal pendidikan S1 sesuai bidang keahlian (IPK min. 3,5)'],
        ];
        $defaultTugas = [['deskripsi' => 'Memiliki kemampuan komunikasi dan pembawaan yang santun dan baik']];
    @endphp

    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-6">

            <div class="space-y-6">
                <label for="file" class="block text-sm font-medium text-gray-700">
                    Foto Lowongan
                    <span><span class="text-red-600">*</span></span>
                    <x-input.image-uploader name="file" />
                </label>
                <x-input.text name="posisi" label="Posisi" placeholder="e.g: Guru Bahasa Indonesia" :required="true" />
                <x-input.textarea name="deskripsi" label="Deskripsi" placeholder="Deskripsi singkat pekerjaan"
                    :required="true" :rows="5" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input.date name="tanggal_mulai" label="Tanggal Dibuka" :required="true" />
                    <x-input.date name="tanggal_selesai" label="Tanggal Ditutup" :required="true" />
                </div>

            </div>

            <div class="space-y-6">
                <div x-data="dynamicListManager({{ json_encode($defaultKualifikasi) }})" class="space-y-2">
                    <div class="flex justify-between items-center">
                        <h3 class="font-medium text-gray-900">Kualifikasi</h3>
                        <button @click="addItem" type="button"
                            class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-600">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <template x-for="(item, index) in items" :key="index">
                        <div class="flex items-start gap-2">
                            <textarea x-model="item.deskripsi" :name="`deskripsi_kualifikasi[${index}]`" placeholder="Masukkan Kualifikasi "
                                rows="1"
                                class="px-4 py-2 border flex-grow block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                            <button @click="removeItem(index)" type="button"
                                class="mt-1 flex-shrink-0 flex items-center justify-center h-9 w-9 rounded-md bg-gray-50 border border-gray-300 hover:bg-red-50 text-gray-500 hover:text-red-600">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

        </div>

        <div class="pt-6 border-t mt-8">
            <div class="flex justify-between items-center">
                <x-input.publish-checkbox name="is_publish" />
                <button type="submit"
                    class="w-full sm:w-fit flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                    <span class="font-semibold">Simpan Data</span>
                </button>
            </div>
        </div>

    </form>
@endsection

@push('scripts')
    <script>
        function dynamicListManager(initialItems = []) {
            return {
                items: initialItems.length > 0 ? initialItems : [{
                    deskripsi: ''
                }],

                addItem() {
                    this.items.push({
                        deskripsi: ''
                    });
                },
                removeItem(index) {
                    this.items.splice(index, 1);
                    if (this.items.length === 0) {
                        this.addItem();
                    }
                }
            };
        }

        $(document).ready(function() {
            $('#main-form').on('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);

                const apiUrl = "{{ url('/admin/api/lowongan-kerja/create') }}";

                function clearValidationErrors() {
                    $('#main-form').find('input, textarea, select').removeClass('border-red-500');
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
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message ||
                                'Lowongan kerja berhasil disimpan.',
                            icon: 'success',
                        }).then(() => {
                            window.location.href =
                                "{{ route('admin.lowongan-kerja.index') }}";
                        });
                    },
                    error: function(xhr) {
                        Swal.close();
                        clearValidationErrors();
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            for (const key in errors) {
                                const cleanKey = key.replace(/\.\d+\./, '.');
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
