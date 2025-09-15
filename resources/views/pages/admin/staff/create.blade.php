@extends('layouts.cms')
@section('title', 'Tambah Data Staff')
@section('content')

    <a href="{{ route('admin.staff.index') }}"
        class="mb-4 inline-flex items-center text-sm font-light text-gray-500 hover:text-gray-800">
        <i class="fa fa-arrow-left mr-1"></i>
        Kembali
    </a>

    <div class="p-8 mt-4 min-h-96 rounded-lg shadow-lg bg-white" x-data="staffForm({
        postUrl: '{{ url('api/admin/guru-staff/create') }}',
        redirectUrl: '{{ route('admin.staff.index') }}'
    })">
        <p class="text-xl font-bold text-gray-800">Tambah Data</p>
        <hr class="my-6">

        <form @submit.prevent="confirmSubmit" id="staff-form" enctype="multipart/form-data" method="post">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- KOLOM KIRI --}}
                <div class="md:col-span-2 space-y-8">
                    {{-- Bagian Biodata --}}
                    <div>
                        <h3 class="font-bold text-gray-800 mb-4">Biodata</h3>
                        <div class="space-y-6">
                            <div>
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nama" id="nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Nama Lengkap Staf" required>
                            </div>
                            <div>
                                <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900">Jabatan <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="jabatan" id="jabatan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Contoh: Guru Matematika" required>
                            </div>
                        </div>
                    </div>
                    <hr />

                    <x-forms.riwayat-pendidikan />
                    <x-forms.pengalaman-kerja />
                    <x-forms.prestasi />

                </div>

                {{-- KOLOM KANAN --}}
                {{-- FIX 1: Mengubah nama input gambar dari 'file' menjadi 'image' agar sesuai dengan validasi backend --}}
                <x-input.image-uploader name="image" />
            </div>

            {{-- FOOTER & TOMBOL SIMPAN --}}
            <div class="flex items-center justify-between mt-8 pt-6 border-t">
                <div class="flex items-center">
                    <input id="is_publish" name="is_publish" type="checkbox" value="1"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                    <label for="is_publish" class="ml-2 text-sm text-gray-900">*Centang untuk mempublikasikan staf</label>
                </div>
                <button type="submit"
                    class="px-6 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300"
                    :disabled="isLoading">
                    <span x-show="!isLoading">Simpan Data</span>
                    <span x-show="isLoading">Menyimpan...</span>
                </button>
            </div>

            {{-- Modal Konfirmasi --}}
            <div x-show="showConfirmModal" x-transition class="fixed inset-0 z-50 overflow-y-auto bg-gray-500 bg-opacity-75"
                style="display: none;">
                <div class="flex items-center justify-center min-h-screen">
                    <div @click.away="showConfirmModal = false"
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Simpan Data</h3>
                                    <p class="text-sm text-gray-500 mt-2">Apakah Anda yakin ingin menyimpan data staf baru
                                        ini?</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button @click="submitForm()" type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm"
                                :disabled="isLoading">
                                <span x-show="!isLoading">Ya, Simpan</span>
                                <span x-show="isLoading">Memproses...</span>
                            </button>
                            <button @click="showConfirmModal = false" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script>
        function staffForm(config) {
            return {
                // ... state management (tidak ada perubahan di sini) ...
                openSections: {
                    pendidikan: false,
                    pengalaman: false,
                    prestasi: false
                },
                editingIndex: null,
                drafts: {},
                formData: {
                    pendidikan: [],
                    pengalaman: [],
                    prestasi: []
                },
                showConfirmModal: false,
                isLoading: false,

                // Initialize component
                init() {
                    this.resetDraft('pendidikan');
                    this.resetDraft('pengalaman');
                    this.resetDraft('prestasi');
                },

                // Reset a draft object to its initial state
                resetDraft(type) {
                    const initialData = {
                        pendidikan: {
                            tingkat_pendidikan: "",
                            instansi: "",
                            tahun_mulai: "",
                            tahun_akhir: "",
                        },
                        pengalaman: {
                            posisi: "",
                            perusahaan: "",
                            kota: "",
                            tahun_mulai: "",
                            tahun_akhir: "",
                        },
                        prestasi: {
                            nama_lomba: "",
                            penyelenggara: "",
                            predikat: "",
                            tingkat: "",
                            tahun: "",
                        },
                    };
                    this.drafts[type] = initialData[type];
                },

                // Buka form untuk menambah item baru
                openForm(type) {
                    this.openSections[type] = !this.openSections[type];
                    if (this.openSections[type]) {
                        this.editingIndex = null;
                        this.resetDraft(type);
                    }
                },

                // Simpan item yang baru dibuat atau diedit
                saveItem(type) {
                    const isDraftValid = Object.values(this.drafts[type]).some(
                        (val) => val && val.toString().trim() !== ""
                    );
                    if (!isDraftValid) {
                        Swal.fire({
                            icon: "warning",
                            title: "Data Kosong",
                            text: "Mohon isi setidaknya satu bidang.",
                        });
                        return;
                    }

                    if (this.editingIndex !== null) {
                        this.formData[type][this.editingIndex] = {
                            ...this.drafts[type]
                        };
                    } else {
                        this.formData[type].push({
                            ...this.drafts[type]
                        });
                    }
                    this.resetDraft(type);
                    // Biarkan form terbuka jika pengguna ingin menambah lagi
                },

                // Buka form untuk mengedit item yang sudah ada
                editItem(type, index) {
                    this.openSections[type] = true;
                    this.editingIndex = index;
                    this.drafts[type] = {
                        ...this.formData[type][index]
                    };
                },

                // Hapus item dari daftar atau batalkan penambahan/pengeditan
                cancelOrDeleteItem(type) {
                    if (this.editingIndex !== null) {
                        this.formData[type].splice(this.editingIndex, 1);
                    }
                    this.openSections[type] = false;
                    this.resetDraft(type);
                },

                // Validasi form utama sebelum menampilkan modal
                confirmSubmit() {
                    // FIX 2: Menggunakan querySelector untuk mencari input berdasarkan nama, bukan ID. Ini lebih aman.
                    const imageInput = document.querySelector('input[name="image"]');

                    if (
                        !document.getElementById("nama").value ||
                        !document.getElementById("jabatan").value ||
                        !imageInput || !imageInput.files.length
                    ) {
                        Swal.fire({
                            icon: "error",
                            title: "Data Tidak Lengkap",
                            text: "Mohon lengkapi data wajib (Nama, Jabatan, dan Gambar).",
                        });
                        return;
                    }
                    this.showConfirmModal = true;
                },

                // Fungsi utama untuk submit data via AJAX ke API
                async submitForm() {
                    this.isLoading = true;
                    const formElement = document.getElementById("staff-form");
                    const data = new FormData(formElement);

                    // FIX: Mengubah cara data array dikirim.
                    // Alih-alih mengirim sebagai string JSON, kita akan membangunnya
                    // dengan notasi array yang dipahami oleh PHP/Laravel.
                    const appendArrayData = (key, arr) => {
                        arr.forEach((item, index) => {
                            for (const prop in item) {
                                // Pastikan kita tidak mengirim nilai null
                                const value = item[prop] === null ? '' : item[prop];
                                data.append(`${key}[${index}][${prop}]`, value);
                            }
                        });
                    };

                    appendArrayData('riwayat_pendidikan', this.formData.pendidikan);
                    appendArrayData('pengalaman_kerja', this.formData.pengalaman);
                    appendArrayData('prestasis', this.formData.prestasi);


                    try {
                        const response = await fetch(config.postUrl, {
                            method: "POST",
                            body: data,
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                        });

                        const result = await response.json();

                        if (response.ok) {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil!",
                                text: result.message || "Data berhasil disimpan.",
                                timer: 2000,
                                showConfirmButton: false,
                            }).then(() => {
                                window.location.href = config.redirectUrl;
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Menyimpan",
                                html: result.message +
                                    (result.errors ?
                                        "<br><br>" +
                                        Object.values(result.errors).map(e => e.join('<br>')).join("<br>") :
                                        ""),
                            });
                        }
                    } catch (error) {
                        console.error("Fetch error:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Tidak dapat terhubung ke server.",
                        });
                    } finally {
                        this.isLoading = false;
                        this.showConfirmModal = false;
                    }
                },
            };
        }
    </script>
@endpush
