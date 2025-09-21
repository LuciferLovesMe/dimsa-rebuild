@extends('layouts.cms')

@section('title', 'Dewan Yayasan')

@section('content')

    @php
        $tabData = [
            ['id' => 'pimpinan', 'text' => 'Pimpinan', 'route' => route('admin.dewan.pimpinan.index')],
            ['id' => 'pengasuh', 'text' => 'Pengasuh', 'route' => route('admin.dewan.pengasuh.index')],
        ];

        $activeTab = '';
        if (request()->routeIs('admin.dewan.pimpinan.index')) {
            $activeTab = 'pimpinan';
        } elseif (request()->routeIs('admin.dewan.pengasuh.index')) {
            $activeTab = 'pengasuh';
        }
    @endphp

    <x-cms_page :title="$title" breadcrumb1="Tentang Sekolah" :breadcrumb2="$title" :breadcrumb3="$breadcrumb3">

        <x-slot name="actions">
            <x-tab-button :tabs="$tabData" :active-tab="$activeTab" />
        </x-slot>

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-5">
            <p class="font-semibold text-gray-700">{{ $breadcrumb3 }}</p>
            <a href="{{ url('/admin/dewan/' . $activeTab . '/create') }}"
                class="w-full sm:w-fit flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
                <i class="fa-regular fa-plus text-base"></i>
                <span class="font-semibold">Tambah Data</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full" id="dewan-datatable">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            No.</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Jabatan</th>
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
            const activeTab = '{{ $activeTab }}';
            const ajaxUrl = `/api/admin/dewan-yayasan/${activeTab}/showAll`;

            const table = $('#dewan-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                dom: '<"md:flex md:justify-between items-center mb-4"lf>t<"md:flex md:justify-between items-center mt-4"ip>',
                ajax: {
                    url: ajaxUrl,
                    dataFilter: function(data) {
                        let json = JSON.parse(data);
                        let dtData = json.data.original;
                        return JSON.stringify(dtData);
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
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

            // --- FUNGSI UNTUK MENAMPILKAN POP-UP DETAIL ---
            $('#dewan-datatable').on('click', '.detail-btn-modal', function() {
                const id = $(this).data('id');
                const detailUrl = `/api/admin/dewan-yayasan/${activeTab}/show/${id}`;

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

                            let educationHtml =
                                '<p class="text-sm text-gray-500">Tidak ada data.</p>';
                            if (item.riwayat_pendidikans && item.riwayat_pendidikans.length >
                                0) {
                                educationHtml = item.riwayat_pendidikans.map(edu => `
                                    <div class="py-2">
                                        <p class="font-semibold">${edu.tingkat_pendidikan} - ${edu.instansi}</p>
                                        <p class="text-sm text-gray-600">${edu.tahun_mulai} - ${edu.tahun_akhir || 'Sekarang'}</p>
                                    </div>
                                `).join('<hr class="my-1">');
                            }

                            let workHtml =
                                '<p class="text-sm text-gray-500">Tidak ada data.</p>';
                            if (item.pengalaman_kerjas && item.pengalaman_kerjas.length > 0) {
                                workHtml = item.pengalaman_kerjas.map(work => `
                                    <div class="py-2">
                                        <p class="font-semibold">${work.posisi}</p>
                                        <p class="text-sm text-gray-600">${work.perusahaan}</p>
                                        <p class="text-sm text-gray-600">${work.kota}</p>
                                        <p class="text-sm text-gray-500">${work.tahun_mulai} - ${work.tahun_akhir || 'Sekarang'}</p>
                                    </div>
                                `).join('<hr class="my-1">');
                            }

                            let achievementHtml =
                                '<p class="text-sm text-gray-500">Tidak ada data.</p>';
                            if (item.prestasis && item.prestasis.length > 0) {
                                achievementHtml = item.prestasis.map(ach => `
                                    <div class="py-2">
                                        <p class="font-semibold">${ach.nama_lomba} (${ach.predikat})</p>
                                        <p class="text-sm text-gray-600">${ach.penyelenggara} - ${ach.tingkat}</p>
                                        <p class="text-sm text-gray-500">Tahun: ${ach.tahun}</p>
                                    </div>
                                `).join('<hr class="my-1">');
                            }


                            const contentHtml = `
                                <div class="text-left p-2 space-y-4">
                                    <div class="text-center">
                                        <img src="${item.image}" alt="${item.nama}" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-white shadow-lg">
                                        <h2 class="text-2xl font-bold">${item.nama}</h2>
                                        <p class="text-md text-gray-600">${item.jabatan}</p>
                                        <span class="mt-2 inline-block px-2 py-1 text-xs font-semibold rounded-full ${item.is_publish ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">
                                            ${item.is_publish ? 'Published' : 'Draft'}
                                        </span>
                                    </div>

                                    <div class="border-t pt-4">
                                        <h3 class="font-bold text-lg mb-2">Riwayat Pendidikan</h3>
                                        ${educationHtml}
                                    </div>

                                    <div class="border-t pt-4">
                                        <h3 class="font-bold text-lg mb-2">Pengalaman Kerja</h3>
                                        ${workHtml}
                                    </div>

                                    <div class="border-t pt-4">
                                        <h3 class="font-bold text-lg mb-2">Prestasi</h3>
                                        ${achievementHtml}
                                    </div>
                                </div>
                            `;

                            Swal.fire({
                                title: `<strong>Detail Data</strong>`,
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
                            Swal.fire('Gagal!', 'Data tidak ditemukan.', 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat mengambil detail data.',
                            'error'
                        );
                    }
                });
            });

            // Delete
            $('#dewan-datatable').on('click', '.delete-btn-table', function(event) {
                event.preventDefault();

                const id = $(this).data('id');
                const deleteUrl = `/api/admin/dewan-yayasan/${activeTab}/delete/${id}`;

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
                                // Mengirim CSRF token untuk keamanan
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Dihapus!',
                                    'Data berhasil dihapus.',
                                    'success'
                                );
                                table.ajax.reload();
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
