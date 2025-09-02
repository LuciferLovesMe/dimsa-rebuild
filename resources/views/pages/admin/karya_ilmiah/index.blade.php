@extends('layouts.cms')

@section('title', 'Manajemen Karya Ilmiah')

@section('content')
    <x-cms_page title="Manajemen Karya Ilmiah" breadcrumb1="Admin" breadcrumb2="Informasi" breadcrumb3="Karya Ilmiah">
        <div class="w-full flex flex-row justify-end mb-5">
            <a href="{{ route('admin.karya-ilmiah.create') }}"
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
                            Tanggal Terbit</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
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
            $('#karya-ilmiah-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                dom: '<"md:flex md:justify-between items-center mb-4"lf>t<"md:flex md:justify-between items-center mt-4"ip>',
                ajax: {
                    url: "{{ url('/api/admin/karya-ilmiah/showAll') }}",
                    dataFilter: function(data) {
                        let json = JSON.parse(data);

                        let dtData = json.data.original;

                        return JSON.stringify(dtData);
                    }
                },
                columns: [{
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'penulis',
                        name: 'penulis'
                    },
                    {
                        data: 'tanggal_terbit',
                        name: 'tanggal_terbit'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ]
            });
        });
    </script>
@endpush
