@extends('layouts.cms')

@section('title', 'Program Unggulan')

@section('content')
    <x-cms_page title="Program Unggulan" breadcrumb1="Tentang Sekolah" breadcrumb2="Program Unggulan"
        breadcrumb3="Data Program">

        <div class="w-full flex flex-row justify-end mb-5">
            <a href="#"
                class="w-fit flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                <i class="fa-regular fa-plus text-base"></i>
                <span class="font-semibold">Tambah Data</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full mt-4 text-sm" id="program-datatable">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            No</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Gambar Header</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama Program</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </x-cms_page>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#program-datatable').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"md:flex md:justify-between items-center mb-4"lf>t<"md:flex md:justify-between items-center mt-4"ip>',
                ajax: {
                    url: "{{ url('/api/admin/program-unggulan/showAll') }}",
                    dataSrc: function(json) {
                        json.recordsTotal = json.data.original.recordsTotal;
                        json.recordsFiltered = json.data.original.recordsFiltered;
                        return json.data.original.data;
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'cover',
                        name: 'cover',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_program',
                        name: 'nama_program'
                    },
                    // {
                    //     data: 'deskripsi',
                    //     name: 'deskripsi',
                    //     render: function(data, type, row) {
                    //         if (data && data.length > 60) {
                    //             return data.substring(0, 60) + '...';
                    //         }
                    //         return data;
                    //     }
                    // },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
