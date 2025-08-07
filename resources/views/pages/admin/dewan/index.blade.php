@extends('layouts.cms')

@section('title', 'Dewan Yayasan')
@section('breadcrumb', 'Dewan Yayasan')
@section('sub_breadcrumb', 'Pimpinan Pondok')

@section('content')
    <!-- Isi konten halaman dewan di sini -->
    <div class="flex flex-row justify-between">
        <p>Data Pimpinan</p>
        <a href="#" class="bg-blue-700 hover:bg-blue-800 text-white py-3 px-6 rounded-2xl text-sm">
            <i class="fa-regular fa-plus-square text-xl"></i>
            Tambah Data</a>
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
            <tr>
                <td class="border px-4 py-2 text-center">1</td>
                <td class="border px-4 py-2">Muhammad Rasyid</td>
                <td class="border px-4 py-2">Pimpinan</td>
                <td class="border px-4 py-2 flex justify-center">
                    <div class="flex bg-green-100 px-4 py-2 text-center w-fit rounded-lg items-center justify-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <p class=" ms-2 text-green-800 rounded-md text-sm">Dipublish</p>
                    </div>
                </td>
                <td class="border px-4 py-2">
                    <div class="flex gap-2 justify-center">
                        <a href="#"
                            class="border border-blue-700 hover:border-blue-800 text-blue-700 hover:text-blue-800 py-2 px-3 rounded-2xl text-md">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a href="#"
                            class="border border-red-700 hover:border-red-800 text-red-700 hover:text-red-800 py-2 px-3 rounded-2xl text-md">
                            <i class="fa-regular fa-trash-can"></i>
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
