@extends('layouts.cms')

@section('title', 'Staff Yayasan')

@section('content')
    <x-cms_page :title="$title" breadcrumb1="Tentang Sekolah" :breadcrumb2="$title" :breadcrumb3="$breadcrumb3">

        <!-- Isi konten lainnya -->
        <div class="flex flex-row justify-between">
            <p>Data {{ $title }}</p>
            <a href="#"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                <i class="fa-regular fa-plus text-base"></i>
                <span class="font-semibold">Tambah Data</span>
            </a>
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
    </x-cms_page>
    <!-- Isi konten halaman dewan di sini -->

@endsection
