@extends('layouts.cms')

@section('title', 'Partner Lembaga')

@section('content')
    <x-cms_page title="Partner Lembaga" breadcrumb1="Tentang Sekolah" breadcrumb2="Partner Lembaga" breadcrumb3="Data Partner">

        <div class="w-full flex flex-row justify-end mb-5">
            <a href="{{ route('admin.partner.create') }}"
                class="w-fit flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                <i class="fa-regular fa-plus text-base"></i>
                <span class="font-semibold">Tambah Data</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full mt-4 text-sm" id="partner-datatable">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            No</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Logo</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama Mitra</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status Publish</th>
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
            // Menyimpan instance DataTable ke dalam variabel 'table'
            const table = $('#partner-datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                dom: '<"md:flex md:justify-between items-center mb-4"lf>t<"md:flex md:justify-between items-center mt-4"ip>',
                ajax: {
                    url: "{{ url('/api/admin/partner/showAll') }}",
                    dataSrc: function(json) {
                        if (json.data && json.data.original) {
                            json.recordsTotal = json.data.original.recordsTotal;
                            json.recordsFiltered = json.data.original.recordsFiltered;
                            return json.data.original.data;
                        }
                        return [];
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'logo',
                        name: 'logo',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_mitra',
                        name: 'nama_mitra'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
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

            // --- FUNGSI HAPUS DATA ---
            $('#partner-datatable').on('click', '.delete-btn-table', function(event) {
                event.preventDefault();
                const id = $(this).data('id');
                const deleteUrl = `/api/admin/partner/delete/${id}`;

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
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire('Dihapus!', 'Data partner berhasil dihapus.',
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

            // --- FUNGSI UNTUK MENAMPILKAN POP-UP DETAIL ---
            $('#partner-datatable').on('click', '.detail-btn-modal', function() {
                const id = $(this).data('id');
                const detailUrl = `/api/admin/partner/show/${id}`;

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
                        if (response.status === 'success' && response.data) {
                            const item = response.data;

                            const contentHtml = `
                                <div class="text-center p-4">
                                    <div class="w-32 h-32 mx-auto mb-4 flex items-center justify-center">${item.logo}</div>
                                    <h2 class="text-lg font-medium">${item.nama_mitra}</h2>
                                </div>
                            `;

                            Swal.fire({
                                title: `<strong>Detail Partner</strong>`,
                                html: contentHtml,
                                showCloseButton: true,
                                showCancelButton: false,
                                focusConfirm: false,
                                confirmButtonText: 'Tutup',
                            });

                        } else {
                            Swal.fire('Gagal!', 'Data tidak ditemukan.', 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat mengambil detail data.',
                            'error');
                    }
                });
            });
        });
    </script>
@endpush
