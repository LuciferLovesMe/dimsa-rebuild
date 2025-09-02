@extends('layouts.cms')

@section('title', 'Manajemen Karya Ilmiah')

@section('content')
    <x-cms_page title="Manajemen Karya Ilmiah" breadcrumb1="Admin" breadcrumb2="Informasi" breadcrumb3="Karya Ilmiah">
        <div class="w-full flex flex-row justify-end mb-5">
            <a href="#"
                class="w-fit flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                <i class="fa-regular fa-plus text-base"></i>
                <span class="font-semibold">Tambah Data</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full" id="karya-ilmiah-datatable">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Judul</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Penulis</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Tanggal</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody id="karya-ilmiah-table-body">
                    <tr>
                        <td colspan="5" class="text-center py-10">
                            <div id="loading-spinner">
                                <i class="fa fa-spinner fa-spin text-2xl text-gray-500"></i>
                                <p class="mt-2 text-gray-500">Memuat data karya ilmiah...</p>
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
            function loadKaryaIlmiah() {
                const tableBody = $('#karya-ilmiah-table-body');
                const loadingSpinner = $('#loading-spinner');

                $.ajax({
                    url: "/api/admin/karya-ilmiah/showAll",
                    method: 'GET',
                    success: function(response) {
                        tableBody.empty();

                        if (response.status === 'success' && response.data.data.length > 0) {
                            const allKaryaIlmiah = response.data.data;

                            allKaryaIlmiah.forEach(function(karya) {
                                const statusBadge = karya.is_publish ?
                                    '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Published</span>' :
                                    '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Draft</span>';

                                const row = `
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">${karya.judul}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">${karya.penulis}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">${karya.tanggal}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">${statusBadge}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-center">
                                        <div class="flex gap-2 justify-center">
                                            <a href="/admin/karya-ilmiah/${karya.id}" class="detail-btn-table"><i class="text-sm fa-regular fa-eye"></i></a>
                                            <a href="/admin/karya-ilmiah/${karya.id}/edit" class="edit-btn-table"><i
                                                    class="text-sm fa-regular fa-pen-to-square"></i></a>
                                            <a href="#" class="delete-btn-table" data-id="${karya.id}"><i
                                                    class="text-sm fa-regular fa-trash-can"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            `;
                                tableBody.append(row);
                            });

                            $('#karya-ilmiah-datatable').DataTable({
                                dom: '<"md:flex md:justify-between items-center mb-4"lf>t<"md:flex md:justify-between items-center mt-4"ip>'
                            });

                        } else {
                            tableBody.html(
                                '<tr><td colspan="5" class="text-center py-10 text-gray-500">Tidak ada data karya ilmiah yang ditemukan.</td></tr>'
                            );
                        }
                    },
                    error: function(xhr) {
                        loadingSpinner.parent().parent().remove();
                        console.error("Gagal mengambil data:", xhr.responseText);
                        tableBody.html(
                            '<tr><td colspan="5" class="text-center py-10 text-red-500">Gagal memuat data. Silakan coba lagi.</td></tr>'
                        );
                    }
                });
            }

            loadKaryaIlmiah();
        });
    </script>
@endpush
