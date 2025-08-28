@extends('layouts.cms')

@section('title', 'Manajemen Majalah')

@section('content')
    <x-cms_page title="Manajemen Majalah" breadcrumb1="Admin" breadcrumb2="Informasi" breadcrumb3="Majalah">

        <div class="w-full flex flex-row justify-end mb-5">
            <a href="#"
                class="w-fit flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                <i class="fa-regular fa-plus text-base"></i>
                <span class="font-semibold">Tambah Data</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full" id="majalah-datatable">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Cover</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Judul</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Penulis</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Tanggal Terbit</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody id="majalah-table-body">
                    <tr>
                        <td colspan="6" class="text-center py-10">
                            <div id="loading-spinner">
                                <i class="fa fa-spinner fa-spin text-2xl text-gray-500"></i>
                                <p class="mt-2 text-gray-500">Memuat data majalah...</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-cms_page>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            function loadMajalah() {
                const tableBody = $('#majalah-table-body');
                const loadingSpinner = $('#loading-spinner');

                $.ajax({
                    url: "/admin/api/majalah",
                    method: 'GET',
                    success: function(response) {
                        tableBody.empty();

                        const majalahData = response.data.original.data;

                        if (majalahData && majalahData.length > 0) {

                            majalahData.forEach(function(majalah) {
                                const row = `
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                    <img src="${majalah.image}" alt="majalah ${majalah.id}">
                                        </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">${majalah.judul}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">${majalah.penulis}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">${majalah.tanggal}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">${majalah.status}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-center">
                                        ${majalah.aksi}
                                    </td>
                                </tr>
                            `;
                                tableBody.append(row);
                            });

                            $('#majalah-datatable').DataTable({
                                dom: '<"md:flex md:justify-between items-center mb-4"lf>t<"md:flex md:justify-between items-center mt-4"ip>'
                            });

                        } else {
                            tableBody.html(
                                '<tr><td colspan="6" class="text-center py-10 text-gray-500">Tidak ada data majalah yang ditemukan.</td></tr>'
                            );
                        }
                    },
                    error: function(xhr) {
                        loadingSpinner.parent().parent().remove();
                        console.error("Gagal mengambil data:", xhr.responseText);
                        tableBody.html(
                            '<tr><td colspan="6" class="text-center py-10 text-red-500">Gagal memuat data. Silakan coba lagi.</td></tr>'
                        );
                    }
                });
            }

            loadMajalah();
        });
    </script>
@endpush
