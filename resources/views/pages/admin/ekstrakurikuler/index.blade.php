@extends('layouts.cms')

@section('title', 'Manajemen Extrakurikuler')

@section('content')
    <x-cms_page title="Manajemen Extrakurikuler" breadcrumb1="Admin" breadcrumb2="Extrakurikuler" breadcrumb3="Extrakurikuler">
        <div class="w-full flex flex-row justify-end mb-5">
            <a href="{{ route('admin.ekstrakurikuler.create') }}"
                class="w-fit flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                <i class="fa-regular fa-plus text-base"></i>
                <span class="font-semibold">Tambah Data</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full" id="ekstrakurikuler-datatable">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            No.</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Thumbnail</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Judul</th>
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
            const table = $("#ekstrakurikuler-datatable").DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                dom: '<"md:flex md:justify-between items-center mb-4"lf>t<"md:flex md:justify-between items-center mt-4"ip>',
                ajax: "{{ url('/admin/api/ekstrakulikuler') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'thumbnail',
                        name: 'thumbnail',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    }
                ]
            });


            $('#ekstrakurikuler-datatable').on('click', '.delete-btn-table', function(event) {
                event.preventDefault();
                const id = $(this).data('id');
                const deleteUrl = `/admin/api/ekstrakulikuler/${id}/destroy`;

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                Swal.fire('Dihapus!', 'Data majalah berhasil dihapus.',
                                    'success');
                                table.ajax.reload();
                            },
                            error: function(xhr) {
                                Swal.fire('Gagal!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error');
                            }
                        });
                    }
                });
            });


            $('#ekstrakurikuler-datatable').on('click', '.detail-btn-modal', function() {
                const id = $(this).data('id');
                const detailUrl = `/admin/api/ekstrakulikuler/${id}`;

                Swal.fire({
                    title: 'Memuat data...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: detailUrl,
                    method: 'GET',
                    success: function(response) {
                        const item = response.data;
                        if (item) {
                            const imageUrl =
                                `{{ asset('uploads/ekstrakulikuler/') }}/${item.image}`;

                            const contentHtml = `
                                <div class="text-left p-4 space-y-4">
                                    <img src="${imageUrl}" alt="${item.judul}" class="w-full h-48 object-cover rounded-lg mx-auto mb-4 border shadow-md">
                                    <div class="border-t pt-4">
                                        <p><strong class="w-24 inline-block">Status:</strong>
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full ${item.is_publish ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">
                                                ${item.is_publish ? 'Published' : 'Draft'}
                                            </span>
                                        </p>
                                        <p class="mt-2"><strong class="w-24 inline-block">Link:</strong> <a href="${item.link}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a></p>
                                    </div>
                                </div>
                            `;

                            Swal.fire({
                                title: `<strong>Detail Eksrakurikuler</strong>`,
                                html: contentHtml,
                                showCloseButton: true,
                                confirmButtonText: 'Tutup',
                            });
                        } else {
                            Swal.fire('Gagal!', 'Data tidak ditemukan.', 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!',
                            'Terjadi kesalahan saat mengambil detail data.',
                            'error');
                    }
                });
            });
        });
    </script>
@endpush
