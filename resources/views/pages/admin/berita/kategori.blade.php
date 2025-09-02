@extends('layouts.cms')

@section('title', 'Manajemen Berita')

@section('content')

    @php
        $tabData = [
            ['id' => 'berita', 'text' => 'Berita', 'route' => route('admin.berita.index')],
            ['id' => 'kategori', 'text' => 'Kategori', 'route' => route('admin.berita.kategori')],
        ];

        $activeTab = '';
        if (request()->routeIs('admin.berita.kategori')) {
            $activeTab = 'kategori';
        }

    @endphp

    <x-cms_page title="Manajemen Berita" breadcrumb1="Admin" breadcrumb2="Informasi" breadcrumb3="Atur Kategori">

        <x-slot name="actions">
            <x-tab-button :tabs="$tabData" :active-tab="$activeTab" />
        </x-slot>

        {{-- Konten untuk Tab "Atur Kategori" --}}
        <div class="w-full flex flex-row justify-end mb-5">
            <a href="#"
                class="w-fit flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                <i class="fa-regular fa-plus text-base"></i>
                <span class="font-semibold">Tambah Kategori</span>
            </a>
        </div>
        <table class="min-w-full" id="kategori-datatable">
            <thead>
                <tr>
                    <th
                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        No.</th>
                    <th
                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nama Kategori</th>
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

    </x-cms_page>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#kategori-datatable').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"md:flex md:justify-between items-center mb-4"lf>t<"md:flex md:justify-between items-center mt-4"ip>',
                ajax: {
                    url: "{{ url('/api/admin/kategori-berita/showAll') }}",
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
                        data: 'nama_kategori',
                        name: 'nama_kategori'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
