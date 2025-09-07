@extends('layouts.cms')

@section('title', 'Manajemen Testimoni')

@section('content')
    <x-cms_page title="Manajemen Testimoni" breadcrumb1="Admin" breadcrumb2="Informasi" breadcrumb3="Testimoni">

        <div class="w-full flex flex-row justify-end mb-5">
            {{-- Arahkan ke rute create testimoni --}}
            <a href="{{ route('admin.testimoni.create') }}"
                class="w-fit flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                <i class="fa-regular fa-plus text-base"></i>
                <span class="font-semibold">Tambah Data</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full" id="testimoni-datatable">
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
                            Testimoni</th>
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
            const table = $("#testimoni-datatable").DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                dom: '<"md:flex md:justify-between items-center mb-4"lf>t<"md:flex md:justify-between items-center mt-4"ip>',
                ajax: "{{ url('/admin/api/testimoni') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'alumni.nama_alumni'
                    },
                    {
                        data: 'tahun_lulus',
                        name: 'alumni.tahun_lulus'
                    },
                    {
                        data: 'testimoni',
                        name: 'testimoni',

                        render: function(data, type, row) {
                            if (data && data.length > 50) {
                                return data.substring(0, 50) + '...';
                            }
                            return data;
                        }
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

            // --- FUNGSI HAPUS DATA ---
            $('#testimoni-datatable').on('click', '.delete-btn-table', function(event) {
                event.preventDefault();
                const id = $(this).data('id');
                const deleteUrl = `/admin/api/testimoni/${id}/destroy`;

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
                            type: 'POST', // Sesuaikan dengan metode di rute Anda (POST/DELETE)
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                Swal.fire('Dihapus!',
                                    'Data testimoni berhasil dihapus.', 'success');
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
            $('#testimoni-datatable').on('click', '.detail-btn-modal', function() {
                const id = $(this).data('id');
                const detailUrl = `/admin/api/testimoni/${id}`;

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
                                `{{ asset('/uploads/alumni/') }}/${item.alumni.image}`;

                            const contentHtml = `
                                <div class="text-left p-4 space-y-4">
                                    <div class="flex items-center gap-4">
                                        <img src="${imageUrl}" alt="${item.alumni.nama_alumni}" class="w-20 h-20 rounded-full object-cover border shadow-sm">
                                        <div>
                                            <h2 class="text-xl font-bold">${item.alumni.nama_alumni}</h2>
                                            <p class="text-sm text-gray-600">Lulus Tahun ${item.alumni.tahun_lulus}</p>
                                        </div>
                                    </div>
                                    <div class="border-t pt-4">
                                        <h3 class="font-semibold text-lg mb-2">Testimoni</h3>
                                        <p class="text-gray-600 italic">"${item.testimoni}"</p>
                                    </div>
                                </div>
                            `;

                            Swal.fire({
                                title: `<strong>Detail Testimoni</strong>`,
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
