@extends('layouts.cms')

@section('title', 'Manajemen Alumni')

@section('content')
    <x-cms_page title="Manajemen Alumni" breadcrumb1="Admin" breadcrumb2="Informasi" breadcrumb3="Alumni">
        <div class="w-full flex flex-row justify-end mb-5">
            <a href="{{ route('admin.alumni.create') }}"
                class="w-fit flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                <i class="fa-regular fa-plus text-base"></i>
                <span class="font-semibold">Tambah Data</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full" id="alumni-datatable">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            No.</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama Alumni</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Tahun Lulus</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Lulusan</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Pekerjaan</th>
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
            const table = $("#alumni-datatable").DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                ajax: "{{ url('admin/api/alumni') }}",
                dom: '<"md:flex md:justify-between items-center mb-4"lf>t<"md:flex md:justify-between items-center mt-4"ip>',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'nama_alumni',
                        name: 'nama_alumni',
                    },
                    {
                        data: 'tahun_lulus',
                        name: 'tahun_lulus'
                    },
                    {
                        data: 'lembaga',
                        name: 'lembaga'
                    },
                    {
                        data: 'pekerjaan',
                        name: 'pekerjaan'
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

            // --- FUNGSI HAPUS DATA ---
            $('#alumni-datatable').on('click', '.delete-btn-table', function(event) {
                event.preventDefault();
                const id = $(this).data('id');
                const deleteUrl = `/admin/api/alumni/${id}/destroy`;

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
                                Swal.fire('Dihapus!', 'Data alumni berhasil dihapus.',
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
            $('#alumni-datatable').on('click', '.detail-btn-modal', function() {
                const id = $(this).data('id');
                const detailUrl = `/admin/api/alumni/${id}`;

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
                            const imageUrl = `{{ asset('/uploads/alumni/') }}/${item.image}`;

                            const contentHtml = `
                                <div class="text-left p-4 space-y-4">
                                    <div class="text-center">
                                         <img src="${imageUrl}" alt="${item.nama_alumni}" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-white shadow-lg">
                                        <h2 class="text-2xl font-bold">${item.nama_alumni}</h2>
                                        <p class="text-md text-gray-600">${item.pekerjaan}</p>
                                    </div>
                                    <div class="border-t pt-4">
                                        <p><strong class="w-24 inline-block">Lulusan:</strong> ${item.lembaga == 1 ? 'SMA Darun Ihsan' : 'SMP Darun Ihsan'}</p>
                                        <p><strong class="w-24 inline-block">Tahun:</strong> ${item.tahun_lulus}</p>
                                    </div>
                                </div>
                            `;

                            Swal.fire({
                                title: `<strong>Detail Alumni</strong>`,
                                html: contentHtml,
                                showCloseButton: true,
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
