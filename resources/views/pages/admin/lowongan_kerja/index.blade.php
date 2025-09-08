@extends('layouts.cms')

@section('title', 'Lowongan Kerja')

@section('content')
    <x-cms_page title="Lowongan Kerja" breadcrumb1="Admin" breadcrumb2="Informasi" breadcrumb3="Lowongan Kerja">

        <div class="w-full flex flex-row justify-end mb-5">
            <a href="{{ route('admin.lowongan-kerja.create') }}"
                class="w-fit flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                <i class="fa-regular fa-plus text-base"></i>
                <span class="font-semibold">Tambah Data</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full" id="lowongan-datatable">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            No.</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Posisi</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Batas Waktu</th>
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
            // Menyimpan instance DataTable ke dalam variabel
            const table = $('#lowongan-datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                ajax: "{{ url('admin/api/lowongan-kerja') }}",
                dom: '<"md:flex md:justify-between items-center mb-4"lf>t<"md:flex md:justify-between items-center mt-4"ip>',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'posisi',
                        name: 'posisi'
                    },
                    {
                        data: 'tanggal_selesai',
                        name: 'tanggal_selesai'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center',
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
            $('#lowongan-datatable').on('click', '.delete-btn-table', function(event) {
                event.preventDefault();
                const id = $(this).data('id');
                const deleteUrl = `/admin/api/lowongan-kerja/${id}/destroy`;

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
                            type: 'POST', // Menggunakan POST sesuai struktur rute Anda
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                Swal.fire('Dihapus!',
                                    'Data lowongan kerja berhasil dihapus.',
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
            $('#lowongan-datatable').on('click', '.detail-btn-modal', function() {
                const id = $(this).data('id');
                const detailUrl = `/admin/api/lowongan-kerja/${id}`;

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
                                `{{ asset('/uploads/lowongan-kerja/') }}/${item.file}`;

                            let kualifikasiHtml =
                                '<p class="text-sm text-gray-500">Tidak ada data kualifikasi.</p>';
                            if (item.kualifikasi && item.kualifikasi.length > 0) {
                                kualifikasiHtml =
                                    '<ul class="list-disc list-inside space-y-1">';
                                item.kualifikasi.forEach(k => {
                                    kualifikasiHtml +=
                                        `<li class="text-gray-600">${k.deskripsi}</li>`;
                                });
                                kualifikasiHtml += '</ul>';
                            }

                            const contentHtml = `
                                <div class="text-left p-4 space-y-4">
                                    <img src="${imageUrl}" alt="${item.posisi}" class="w-full h-48 object-cover rounded-lg mx-auto mb-4 border shadow-md">
                                    <div>
                                        <h2 class="text-2xl font-bold">${item.posisi}</h2>
                                        <p class="text-sm text-gray-500">Batas waktu hingga ${new Date(item.tanggal_selesai).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</p>
                                    </div>
                                    <div class="border-t pt-4">
                                        <h3 class="font-semibold text-lg mb-2">Deskripsi</h3>
                                        <p class="text-gray-600">${item.deskripsi}</p>
                                    </div>
                                    <div class="border-t pt-4">
                                        <h3 class="font-semibold text-lg mb-2">Kualifikasi</h3>
                                        ${kualifikasiHtml}
                                    </div>
                                </div>
                            `;

                            Swal.fire({
                                title: `<strong>Detail Lowongan Kerja</strong>`,
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
