@extends('layouts.cms')

@section('title', 'Manajemen Galeri')

@section('content')
    <x-cms_page title="Manajemen Galeri" breadcrumb1="Admin" breadcrumb2="Informasi" breadcrumb3="Galeri">
        <div class="w-full flex flex-row justify-end mb-5">
            <a href="{{ route('admin.galeri.create') }}"
                class="w-fit flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                <i class="fa-regular fa-plus text-base"></i>
                <span class="font-semibold">Tambah Data</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full" id="galeri-datatable">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            No.</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Judul</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Jumlah Gambar</th>
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
            const table = $('#galeri-datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                dom: '<"md:flex md:justify-between items-center mb-4"lf>t<"md:flex md:justify-between items-center mt-4"ip>',
                ajax: "{{ url('admin/api/galeri') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'judul',
                        name: 'judul',
                    },
                    {
                        data: 'jumlah_gambar',
                        name: 'jumlah_gambar',
                        className: 'text-center',
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                    },
                ],
            })

            $('#galeri-datatable').on('click', '.detail-btn-modal', function() {
                const id = $(this).data('id');
                const detailUrl = `/admin/api/galeri/${id}`;

                Swal.fire({
                    title: 'Memuat data...',
                    text: 'Mohon tunggu sebentar.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: detailUrl,
                    method: 'GET',
                    success: function(response) {
                        if (response.status === 'success' && response.data) {
                            const item = response.data;

                            // Membangun galeri gambar dari data 'files'
                            let imagesHtml =
                                '<p class="text-sm text-gray-500">Tidak ada gambar di galeri ini.</p>';
                            if (item.files && item.files.length > 0) {
                                imagesHtml = item.files.map(file => `
                                    <div class="w-full h-40 bg-gray-200 rounded-lg overflow-hidden">
                                        <img src="${file.file}" alt="Gambar Galeri" class="w-full h-full object-cover">
                                    </div>
                                `).join('');
                            }

                            // Membangun konten HTML lengkap untuk modal
                            const contentHtml = `
                                <div class="text-left p-2 space-y-4">
                                    <h2 class="text-2xl font-bold text-gray-800">${item.judul}</h2>
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full ${item.is_publish ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">
                                        ${item.is_publish ? 'Published' : 'Draft'}
                                    </span>
                                    <hr>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                        ${imagesHtml}
                                    </div>
                                </div>
                            `;

                            Swal.fire({
                                title: `<strong>Detail Galeri</strong>`,
                                html: contentHtml,
                                showCloseButton: true,
                                showCancelButton: false,
                                focusConfirm: false,
                                confirmButtonText: 'Tutup',
                                customClass: {
                                    popup: 'swal2-popup-lg'
                                }
                            });

                        } else {
                            Swal.fire('Gagal!', 'Data galeri tidak ditemukan.', 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat mengambil detail data.',
                            'error');
                    }
                });
            });

            $('#galeri-datatable').on('click', '.delete-btn-table', function(event) {
                event.preventDefault();
                const id = $(this).data('id');
                const deleteUrl = `/admin/api/galeri/${id}/destroy`;

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
        });
    </script>
@endpush
