@extends('layouts.cms')

@section('title', 'Dewan Yayasan')

@section('content')

    @php
        // Definisikan data untuk tombol tab, lengkap dengan rutenya
        $tabData = [
            ['id' => 'pimpinan', 'text' => 'Pimpinan', 'route' => route('admin.dewan.pimpinan')],
            ['id' => 'pengasuh', 'text' => 'Pengasuh', 'route' => route('admin.dewan.pengasuh')],
        ];

        $activeTab = '';
        if (request()->routeIs('admin.dewan.pimpinan')) {
            $activeTab = 'pimpinan';
        } elseif (request()->routeIs('admin.dewan.pengasuh')) {
            $activeTab = 'pengasuh';
        }
    @endphp

    <x-cms_page :title="$title" breadcrumb1="Tentang Sekolah" :breadcrumb2="$title" :breadcrumb3="$breadcrumb3">

        {{-- tab button --}}
        <x-slot name="actions">
            <x-tab-button :tabs="$tabData" :active-tab="$activeTab" />
        </x-slot>

        <div class="flex flex-row justify-between items-center">
            <p class="font-semibold text-gray-700">{{ $breadcrumb3 }}</p>
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
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Jabatan</th>
                    <th class="border px-4 py-2">Status Publish</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dewanData as $item)
                    <tr>
                        <td class="border px-4 py-2 align-middle text-center">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2 align-middle">{{ $item['nama'] }}</td>
                        <td class="border px-4 py-2 align-middle">{{ $item['jabatan'] }}</td>
                        <td class="border px-4 py-2 align-middle text-center flex justify-center">
                            <x-status-publish :status="$item['status']" />
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
@endsection
