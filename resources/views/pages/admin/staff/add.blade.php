@extends('layouts.cms')
@section('title', 'Tambah Data Staff')
@section('content')

    <a href="{{ url()->previous() }}"
        class="mb-4 inline-flex items-center text-sm font-light text-gray-500 hover:text-gray-800">
        <i class="fa fa-arrow-left mr-1"></i>
        Kembali
    </a>

    <div class="p-8 mt-4 min-h-96 rounded-lg shadow-lg bg-white" x-data="staffForm()">
        <p class="text-xl font-bold text-gray-800">Tambah Data</p>
        <hr class="my-6">

        <form @submit.prevent="confirmSubmit" id="staff-form" enctype="multipart/form-data" method="post">
            @csrf
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

                    {{-- Bagian Riwayat Pendidikan --}}
                    <div>
                        <div class="flex justify-between items-center">
                            <h3 class="font-bold text-gray-800">Riwayat Pendidikan</h3>
                            <button @click="openForm('pendidikan')" type="button"
                                class="flex items-center justify-center w-7 h-7 border-2 border-gray-300 rounded-full hover:bg-gray-100">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                        {{-- PERBAIKAN: Menggunakan openSections.pendidikan --}}
                        <div x-show="openSections.pendidikan" x-collapse
                            class="mt-4 p-5 bg-gray-50 rounded-lg shadow-inner">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Pendidikan</label>
                                    <input type="text" x-model="currentItem.pendidikan" placeholder="Tulis Pendidikan"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Sekolah</label>
                                    <input type="text" x-model="currentItem.sekolah" placeholder="Tulis Sekolah"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kota</label>
                                    <input type="text" x-model="currentItem.kota" placeholder="Tulis Kota"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tahun Mulai</label>
                                    <input type="text" x-model="currentItem.tahun_mulai" placeholder="Pilih tahun"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tahun Berakhir</label>
                                    <input type="text" x-model="currentItem.tahun_berakhir" placeholder="Pilih tahun"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                            </div>
                            <div class="flex justify-end gap-3 mt-6">
                                <button @click="cancelOrDeleteItem('pendidikan')" type="button"
                                    class="p-2.5 bg-white border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                                <button @click="saveItem('pendidikan')" type="button"
                                    class="px-6 py-2.5 text-sm font-medium text-white bg-gray-800 border border-transparent rounded-lg shadow-sm hover:bg-gray-900">Simpan</button>
                            </div>
                        </div>
                        <div class="mt-4 space-y-2">
                            <template x-for="(item, index) in formData.pendidikan" :key="index">
                                <div class="border rounded-md p-3 flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold" x-text="item.pendidikan"></p>
                                        <p class="text-sm text-gray-500"
                                            x-text="`${item.sekolah}, ${item.kota} (${item.tahun_mulai} - ${item.tahun_berakhir})`">
                                        </p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button @click="editItem('pendidikan', index)" type="button"
                                            class="p-1 text-gray-500 hover:text-blue-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L15.232 5.232z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Bagian Pengalaman Kerja --}}
                    <div>
                        <div class="flex justify-between items-center">
                            <h3 class="font-bold text-gray-800">Pengalaman Kerja</h3>
                            <button @click="openForm('pengalaman')" type="button"
                                class="flex items-center justify-center w-7 h-7 border-2 border-gray-300 rounded-full hover:bg-gray-100">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                        {{-- PERBAIKAN: Menggunakan openSections.pengalaman --}}
                        <div x-show="openSections.pengalaman" x-collapse
                            class="mt-4 p-5 bg-gray-50 rounded-lg shadow-inner">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Posisi</label>
                                    <input type="text" x-model="currentItem.posisi" placeholder="Tulis Posisi"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Pemberi Kerja</label>
                                    <input type="text" x-model="currentItem.pemberi_kerja"
                                        placeholder="Tulis Perusahaan"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kota</label>
                                    <input type="text" x-model="currentItem.kota" placeholder="Tulis Kota"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tahun Mulai</label>
                                    <input type="text" x-model="currentItem.tahun_mulai" placeholder="Pilih tahun"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tahun Berakhir</label>
                                    <input type="text" x-model="currentItem.tahun_berakhir" placeholder="Pilih tahun"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                </div>
                            </div>
                            <div class="flex justify-end gap-3 mt-6">
                                <button @click="cancelOrDeleteItem('pengalaman')" type="button"
                                    class="p-2.5 bg-white border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                                <button @click="saveItem('pengalaman')" type="button"
                                    class="px-6 py-2.5 text-sm font-medium text-white bg-gray-800 border rounded-lg hover:bg-gray-900">Simpan</button>
                            </div>
                        </div>
                        <div class="mt-4 space-y-2">
                            <template x-for="(item, index) in formData.pengalaman" :key="index">
                                <div class="border rounded-md p-3 flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold" x-text="item.posisi"></p>
                                        <p class="text-sm text-gray-500"
                                            x-text="`${item.pemberi_kerja}, ${item.kota} (${item.tahun_mulai} - ${item.tahun_berakhir})`">
                                        </p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button @click="editItem('pengalaman', index)" type="button"
                                            class="p-1 text-gray-500 hover:text-blue-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L15.232 5.232z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Bagian Prestasi --}}
                    <div>
                        <div class="flex justify-between items-center">
                            <h3 class="font-bold text-gray-800">Prestasi</h3>
                            <button @click="openForm('prestasi')" type="button"
                                class="flex items-center justify-center w-7 h-7 border-2 border-gray-300 rounded-full hover:bg-gray-100">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                        {{-- PERBAIKAN: Menggunakan openSections.prestasi --}}
                        <div x-show="openSections.prestasi" x-collapse
                            class="mt-4 p-5 bg-gray-50 rounded-lg shadow-inner">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Lomba</label>
                                    <input type="text" x-model="currentItem.lomba" placeholder="Tulis Lomba"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Penyelenggara</label>
                                    <input type="text" x-model="currentItem.penyelenggara"
                                        placeholder="Tulis Penyelenggara"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Predikat/Juara</label>
                                    <input type="text" x-model="currentItem.predikat"
                                        placeholder="Tulis Predikat/Juara"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tingkat</label>
                                    <input type="text" x-model="currentItem.tingkat" placeholder="Contoh: Provinsi"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tahun</label>
                                    <input type="text" x-model="currentItem.tahun" placeholder="Pilih tahun"
                                        class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                </div>
                            </div>
                            <div class="flex justify-end gap-3 mt-6">
                                <button @click="cancelOrDeleteItem('prestasi')" type="button"
                                    class="p-2.5 bg-white border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                                <button @click="saveItem('prestasi')" type="button"
                                    class="px-6 py-2.5 text-sm font-medium text-white bg-gray-800 border rounded-lg hover:bg-gray-900">Simpan</button>
                            </div>
                        </div>
                        <div class="mt-4 space-y-2">
                            <template x-for="(item, index) in formData.prestasi" :key="index">
                                <div class="border rounded-md p-3 flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold" x-text="item.lomba"></p>
                                        <p class="text-sm text-gray-500"
                                            x-text="`${item.penyelenggara}, ${item.predikat} (${item.tahun})`"></p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button @click="editItem('prestasi', index)" type="button"
                                            class="p-1 text-gray-500 hover:text-blue-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L15.232 5.232z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN --}}
                <div class="md:col-span-1">
                    <label for="foto"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <template x-if="!photoPreview">
                            <div class="text-center">
                                <svg class="w-10 h-10 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Unggah gambar</span>,
                                    atau telusuri</p>
                                <p class="text-xs text-gray-500">PNG atau JPG (maks. 1920x1080px)</p>
                            </div>
                        </template>
                        <template x-if="photoPreview">
                            <img :src="photoPreview" class="object-cover h-full w-full rounded-lg">
                        </template>
                    </label>
                    <input type="file" name="foto" id="foto" @change="handlePhotoChange" class="hidden"
                        accept="image/png, image/jpeg" required>
                </div>
            </div>

            {{-- FOOTER & TOMBOL SIMPAN --}}
            <div class="flex items-center justify-between mt-8 pt-6 border-t">
                <div class="flex items-center">
                    <input id="is_active" name="is_active" type="checkbox"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                    <label for="is_active" class="ml-2 text-sm text-gray-900">*Centang box untuk mengaktifkan
                        staf!</label>
                </div>
                <button type="submit"
                    class="px-6 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    Simpan Data
                </button>
            </div>

            <!-- Modal Konfirmasi -->
            <div x-show="showConfirmModal" x-transition
                class="fixed inset-0 z-50 overflow-y-auto bg-gray-500 bg-opacity-75" style="display: none;">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div @click.away="showConfirmModal = false"
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.79 4 4s-1.79 4-4 4c-1.742 0-3.223-.835-3.772-2M12 12h.01M12 12v.01M12 12v-.01M12 6.116A5.884 5.884 0 1012 17.884 5.884 5.884 0 0012 6.116z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Simpan Data</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Apakah anda yakin ingin menambahkan staf ini?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button @click="submitForm()" type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                                Ya, Simpan!
                            </button>
                            <button @click="showConfirmModal = false" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function staffForm() {
            return {
                // STATE (Penyimpanan Data)
                // PERBAIKAN: Menggunakan objek untuk melacak setiap section
                openSections: {
                    pendidikan: false,
                    pengalaman: false,
                    prestasi: false,
                },
                activeSection: null,
                editingIndex: null,
                currentItem: {},

                formData: {
                    photo: null,
                    pendidikan: [],
                    pengalaman: [],
                    prestasi: [],
                },
                photoPreview: null,
                showConfirmModal: false,

                // METHODS (Fungsi-fungsi)
                getInitialDataFor(type) {
                    if (type === 'pendidikan') {
                        return {
                            pendidikan: '',
                            sekolah: '',
                            kota: '',
                            tahun_mulai: '',
                            tahun_berakhir: ''
                        };
                    }
                    if (type === 'pengalaman') {
                        return {
                            posisi: '',
                            pemberi_kerja: '',
                            kota: '',
                            tahun_mulai: '',
                            tahun_berakhir: ''
                        };
                    }
                    if (type === 'prestasi') {
                        return {
                            lomba: '',
                            penyelenggara: '',
                            predikat: '',
                            tingkat: '',
                            tahun: ''
                        };
                    }
                    return {};
                },

                openForm(type) {
                    this.activeSection = type;
                    this.openSections[type] = true; // Buka section yang spesifik
                    this.editingIndex = null;
                    this.currentItem = this.getInitialDataFor(type);
                },

                saveItem(type) {
                    if (this.editingIndex !== null) {
                        this.formData[type][this.editingIndex] = {
                            ...this.currentItem
                        };
                    } else {
                        this.formData[type].push({
                            ...this.currentItem
                        });
                    }
                    this.openSections[type] = false; // Tutup section yang spesifik
                    this.activeSection = null;
                },

                editItem(type, index) {
                    this.activeSection = type;
                    this.openSections[type] = true; // Buka section yang spesifik untuk edit
                    this.editingIndex = index;
                    this.currentItem = {
                        ...this.formData[type][index]
                    };
                },

                cancelOrDeleteItem(type) {
                    if (this.editingIndex !== null) {
                        if (confirm('Anda yakin ingin menghapus data ini?')) {
                            this.formData[type].splice(this.editingIndex, 1);
                        }
                    }
                    this.openSections[type] = false; // Tutup section yang spesifik
                    this.activeSection = null;
                },

                handlePhotoChange(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.formData.photo = file;
                        this.photoPreview = URL.createObjectURL(file);
                    }
                },

                confirmSubmit() {
                    const nama = document.getElementById('nama').value;
                    const jabatan = document.getElementById('jabatan').value;
                    const foto = document.getElementById('foto').files.length;

                    if (!nama || !jabatan || !foto) {
                        alert('Mohon lengkapi data wajib (Nama, Jabatan, dan Foto).');
                        return;
                    }
                    this.showConfirmModal = true;
                },

                submitForm() {
                    const formElement = document.getElementById('staff-form');
                    const data = new FormData(formElement);

                    this.formData.pendidikan.forEach((item, index) => {
                        Object.keys(item).forEach(key => {
                            data.append(`pendidikan_list[${index}][${key}]`, item[key]);
                        });
                    });

                    this.formData.pengalaman.forEach((item, index) => {
                        Object.keys(item).forEach(key => {
                            data.append(`pengalaman_list[${index}][${key}]`, item[key]);
                        });
                    });

                    this.formData.prestasi.forEach((item, index) => {
                        Object.keys(item).forEach(key => {
                            data.append(`prestasi_list[${index}][${key}]`, item[key]);
                        });
                    });

                    for (let [key, value] of data.entries()) {
                        console.log(key, value);
                    }
                    alert('Data siap dikirim! Lihat console log untuk detailnya.');
                    this.showConfirmModal = false;
                }
            }
        }
    </script>
@endsection
