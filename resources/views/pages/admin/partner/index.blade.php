@extends('layouts.cms')

@section('title', 'Staff Yayasan')

@section('content')
    {{-- PENTING: Pastikan Alpine.js sudah dimuat di layout utama Anda --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    <x-cms_page :title="$title" breadcrumb1="Tentang Sekolah" :breadcrumb2="$title" :breadcrumb3="$breadcrumb3">

        {{-- Inisialisasi Alpine.js untuk mengelola state modal --}}
        <div x-data="{ showModal: false, photoPreview: null }">

            <!-- Isi konten lainnya -->
            <div class="flex flex-row justify-between">
                <p>Data {{ $title }}</p>
                {{-- Tombol ini sekarang akan membuka modal --}}
                <button @click="showModal = true"
                    class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                    <i class="fa-regular fa-plus text-base"></i>
                    <span class="font-semibold">Tambah Data</span>
                </button>
            </div>

            <table class="table-auto w-full mt-4 text-sm">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama Mitra</th>
                        <th class="border px-4 py-2">Logo</th>
                        <th class="border px-4 py-2">Status Publish</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($partnerData as $item)
                        <tr>
                            <td class="border px-4 py-2 align-middle text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2 align-middle">{{ $item['nama_mitra'] }}</td>
                            <td class="border px-4 py-2 align-middle">
                                <img src="{{ asset('storage/' . $item['logo']) }}" alt="{{ $item['nama_mitra'] }}"
                                    class="w-16 h-16 object-cover">
                            </td>
                            <td class="border px-4 py-2 align-middle text-center flex items-center justify-center">
                                <div class="h-full flex items-center justify-center">
                                    <x-status-publish :status="$item['status']" />
                                </div>
                            </td>
                            <td class="border px-4 py-2 align-middle">
                                <div class="flex gap-2 justify-center">
                                    <a href="#" class="detail-btn-table"><i class="text-sm fa-regular fa-eye"></i></a>
                                    <a href="#" class="edit-btn-table"><i
                                            class="text-sm fa-regular fa-pen-to-square"></i></a>
                                    <a href="#" class="delete-btn-table"><i
                                            class="text-sm fa-regular fa-trash-can"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center border p-4 text-gray-500">
                                Belum ada data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- =============================================== --}}
            {{-- MODAL UNTUK TAMBAH DATA --}}
            {{-- =============================================== --}}
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-50 flex items-center justify-center"
                style="display: none;">

                {{-- Panel Modal --}}
                <div @click.away="showModal = false"
                    class="bg-white rounded-xl shadow-xl transform transition-all sm:max-w-lg sm:w-full p-8">

                    {{-- Header Modal --}}
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Tambah Data Partner</h3>

                    {{-- Form di dalam Modal --}}
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">
                            {{-- Input File / Dropzone --}}
                            <div>
                                <label for="logo"
                                    class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <template x-if="!photoPreview">
                                        <div class="text-center">
                                            <svg class="w-10 h-10 mx-auto mb-4 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Unggah
                                                    sampul</span>, atau <span class="text-blue-600">telusuri</span></p>
                                            <p class="text-xs text-gray-500">PNG atau JPG (maks. 1920x1080px)</p>
                                        </div>
                                    </template>
                                    <template x-if="photoPreview">
                                        <img :src="photoPreview" class="object-contain h-full w-full rounded-lg p-2">
                                    </template>
                                </label>
                                <input type="file" name="logo" id="logo"
                                    @change="photoPreview = URL.createObjectURL($event.target.files[0])" class="hidden"
                                    accept="image/png, image/jpeg" required>
                            </div>

                            {{-- Input Nama Partner --}}
                            <div>
                                <label for="nama_partner" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                    Partner</label>
                                <input type="text" name="nama_partner" id="nama_partner"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="e.g: Kemenag" required>
                            </div>
                        </div>

                        {{-- Tombol Aksi Modal --}}
                        <div class="flex justify-end gap-4 mt-8">
                            <button @click="showModal = false" type="button"
                                class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-6 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-cms_page>
@endsection
