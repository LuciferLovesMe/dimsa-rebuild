{{--
    Komponen Blade untuk Form Dinamis Riwayat Pendidikan.
    Komponen ini harus digunakan di dalam elemen yang memiliki `x-data="staffForm()"`.
--}}
<div>
    <div class="flex justify-between items-center">
        <h3 class="font-bold text-gray-800">Riwayat Pendidikan</h3>
        <button @click="openForm('pendidikan')" type="button"
            class="flex items-center justify-center w-7 h-7 border-2 border-gray-300 rounded-full hover:bg-gray-100">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
        </button>
    </div>

    {{-- Form Input (Muncul saat tombol + diklik) --}}
    <div x-show="openSections.pendidikan" x-collapse
        class="mt-4 p-5 bg-gray-50 rounded-lg shadow-inner">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Tingkat Pendidikan</label>
                <input type="text" x-model="currentItem.pendidikan" placeholder="Contoh: S1 Teknik Informatika"
                    class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Instansi/Sekolah</label>
                <input type="text" x-model="currentItem.sekolah" placeholder="Tulis Nama Instansi"
                    class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Kota</label>
                <input type="text" x-model="currentItem.kota" placeholder="Tulis Kota"
                    class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tahun Mulai</label>
                <input type="number" x-model="currentItem.tahun_mulai" placeholder="Contoh: 2018"
                    class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tahun Berakhir</label>
                <input type="number" x-model="currentItem.tahun_berakhir" placeholder="Contoh: 2022"
                    class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-6">
            <button @click="cancelOrDeleteItem('pendidikan')" type="button"
                class="p-2.5 bg-white border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-100" title="Hapus atau Batal">
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

    {{-- Daftar Item yang Sudah Ditambahkan --}}
    <div class="mt-4 space-y-2">
        <template x-for="(item, index) in formData.pendidikan" :key="index">
            <div class="border rounded-md p-3 flex justify-between items-center bg-white">
                <div>
                    <p class="font-semibold" x-text="item.pendidikan"></p>
                    <p class="text-sm text-gray-500"
                        x-text="`${item.sekolah}, ${item.kota} (${item.tahun_mulai} - ${item.tahun_berakhir})`">
                    </p>
                </div>
                <div class="flex gap-2">
                    <button @click="editItem('pendidikan', index)" type="button"
                        class="p-1 text-gray-500 hover:text-blue-600" title="Edit">
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
