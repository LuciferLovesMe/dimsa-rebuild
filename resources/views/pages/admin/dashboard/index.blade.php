@extends('layouts.cms')
@section('title', 'Dashboard')

@section('content')
    <section class="grid grid-row-4 gap-4">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-semibold">Analitik Dashboard</h1>
            <p class="text-sm text-gray-600">Ringkasan data 30 hari terakhir</p>
        </div>
        <div class="grid grid-cols-3 gap-4 mt-6">
            <div class="stat-card">
                <div class="p-3 flex justify-center items-center bg-blue_primary rounded-full">
                    <i class="fa fa-users text-white text-lg"></i>
                </div>
                <h2 class="mt-3 text-3xl font-semibold">45</h2>
                <p class="text-gray-500">Total Pengunjung</p>
            </div>
            <div class="stat-card">
                <div class="p-3 flex justify-center items-center bg-blue_primary rounded-full">
                    <i class="fa fa-eye text-white text-lg"></i>
                </div>
                <h2 class="mt-3 text-3xl font-semibold">764</h2>
                <p class="text-gray-500">Total Halaman Dilihat</p>
            </div>
            <div class="stat-card">
                <div class="p-3 flex justify-center items-center bg-blue_primary rounded-full">
                    <i class="fa fa-globe text-white text-lg"></i>
                </div>
                <h2 class="mt-3 text-3xl font-semibold">2</h2>
                <p class="text-gray-500">Negara</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="stat-card">
                <h1 class="font-medium">Tren Pengunjung Harian</h1>
                <canvas id="dailyVisitorChart" height="300" class="mt-5"></canvas>
            </div>
            <div class="stat-card">
                <h1 class="font-medium">Tipe Pengguna</h1>
                <canvas id="userTypeChart" height="80" width="80" class="mt-5"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="stat-card">
                <h1>Halaman Paling Populer</h1>
                <table class="min-w-full mt-4 text-sm">
                    <thead>
                        <tr class="bg-blue_primary text-white">
                            <th class="py-2 px-4 text-left">Halaman</th>
                            <th class="py-2 px-4 text-left">Jumlah Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4">beranda</td>
                            <td class="py-2 px-4">120</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">tentang</td>
                            <td class="py-2 px-4">98</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">kontak</td>
                            <td class="py-2 px-4">75</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="stat-card">
                <h1>Referer Teratas</h1>
                <table class="min-w-full mt-4 text-sm">
                    <thead>
                        <tr class="bg-blue_primary text-white">
                            <th class="py-2 px-4 text-left">Sumber</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4">/admin/tentang-kami/dewan/pimpinan</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">/admin/sekolah/smp</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">/admin/analitik</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="stat-card">
                <h1>Browser Teratas</h1>
                <table class="min-w-full mt-4 text-sm">
                    <thead>
                        <tr class="bg-blue_primary text-white">
                            <th class="py-2 px-4 text-left">Browser</th>
                            <th class="py-2 px-4 text-left">Jumlah Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4">Chrome</td>
                            <td class="py-2 px-4">750</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">Firefox</td>
                            <td class="py-2 px-4">20</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">Edge</td>
                            <td class="py-2 px-4">80</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="stat-card">
                <h1>Negara Teratas</h1>
                <table class="min-w-full mt-4 text-sm">
                    <thead>
                        <tr class="bg-blue_primary text-white">
                            <th class="py-2 px-4 text-left">Negara</th>
                            <th class="py-2 px-4 text-left">Jumlah Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4">Indonesia</td>
                            <td class="py-2 px-4">700</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">Malaysia</td>
                            <td class="py-2 px-4">50</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">Singapura</td>
                            <td class="py-2 px-4">14</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="stat-card">
                <h1>Sistem Operasi Teratas</h1>
                <table class="min-w-full mt-4 text-sm">
                    <thead>
                        <tr class="bg-blue_primary text-white">
                            <th class="py-2 px-4 text-left">Sistem Operasi</th>
                            <th class="py-2 px-4 text-left">Jumlah Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4">Windows</td>
                            <td class="py-2 px-4">600</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">macOS</td>
                            <td class="py-2 px-4">100</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">Linux</td>
                            <td class="py-2 px-4">64</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
