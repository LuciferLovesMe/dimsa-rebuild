{{--
    Komponen Blade untuk Form Dinamis Prestasi.
    Komponen ini harus digunakan di dalam elemen yang memiliki `x-data="staffForm()"`.
--}}
<div>
    <div class="flex justify-between items-center">
        <h3 class="font-bold text-gray-800">Prestasi</h3>
        <button @click="openForm('prestasi')" type="button"
            class="flex items-center justify-center w-7 h-7 border-2 border-gray-300 rounded-full hover:bg-gray-100 transition-transform duration-300"
            :class="{ 'transform rotate-45': openSections.prestasi }">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
        </button>
    </div>

    {{-- Daftar Item yang Sudah Ditambahkan --}}
    <div class="mt-4 space-y-2">
        <template x-for="(item, index) in formData.prestasi" :key="index">
            <div class="border rounded-md p-3 flex justify-between items-center bg-white">
                <div>
                    <p class="font-semibold" x-text="item.nama_lomba"></p>
                    <p class="text-sm text-gray-500" x-text="`${item.penyelenggara}, ${item.predikat} (${item.tahun})`">
                    </p>
                </div>
                <div class="flex gap-2">
                    <button @click="editItem('prestasi', index)" type="button"
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

    {{-- Form Input (Muncul saat tombol + diklik) --}}
    <div x-show="openSections.prestasi" class="mt-4 p-5 bg-gray-50 rounded-lg shadow-inner">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Nama Lomba/Prestasi</label>
                <input type="text" x-model="drafts.prestasi.nama_lomba" placeholder="Tulis Nama Lomba"
                    class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Penyelenggara</label>
                <input type="text" x-model="drafts.prestasi.penyelenggara" placeholder="Tulis Penyelenggara"
                    class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div>
                {{-- REVISI: Mengubah input menjadi dropdown (select) --}}
                <label for="predikat" class="block text-sm font-medium text-gray-700">Predikat/Juara</label>
                <select id="predikat" x-model="drafts.prestasi.predikat"
                    class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="" disabled>Pilih Predikat</option>
                    <option value="Juara 1">Juara 1</option>
                    <option value="Juara 2">Juara 2</option>
                    <option value="Juara 3">Juara 3</option>
                    <option value="Harapan 1">Harapan 1</option>
                    <option value="Harapan 2">Harapan 2</option>
                    <option value="Harapan 3">Harapan 3</option>
                    <option value="Finalis">Finalis</option>
                    <option value="Peserta">Peserta</option>
                </select>
            </div>
            <div>
                {{-- REVISI: Mengubah input menjadi dropdown (select) --}}
                <label for="tingkat" class="block text-sm font-medium text-gray-700">Tingkat</label>
                <select id="tingkat" x-model="drafts.prestasi.tingkat"
                    class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="" disabled>Pilih Tingkat</option>
                    <option value="Sekolah">Sekolah</option>
                    <option value="Kecamatan">Kecamatan</option>
                    <option value="Kabupaten">Kabupaten</option>
                    <option value="Provinsi">Provinsi</option>
                    <option value="Nasional">Nasional</option>
                    <option value="Internasional">Internasional</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tahun</label>
                <input type="number" x-model="drafts.prestasi.tahun" placeholder="Contoh: 2021"
                    class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-6">
            <button @click="cancelOrDeleteItem('prestasi')" type="button"
                class="p-2.5 bg-white border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-100"
                title="Hapus atau Batal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                </svg>
            </button>
            <button @click="saveItem('prestasi')" type="button"
                class="p-2.5 text-white bg-gray-800 border rounded-lg hover:bg-gray-900" title="Tambah ke Daftar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </button>
        </div>
    </div>
</div>
