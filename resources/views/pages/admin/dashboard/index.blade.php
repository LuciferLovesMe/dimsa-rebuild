@extends('layouts.cms')

@section('title', 'Dashboard')

@section('content')
    <section class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
            <h1 class="text-3xl font-semibold text-gray-900">Analitik Dashboard</h1>
            <p class="text-sm text-gray-600">Ringkasan data 30 hari terakhir</p>
        </div>

        {{-- Kartu Statistik Utama --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center gap-4">
                    <div class="p-3 flex justify-center items-center bg-blue-500 rounded-full">
                        <i class="fa fa-users text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Total Pengunjung</p>
                        <h2 class="text-3xl font-semibold">45</h2>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center gap-4">
                    <div class="p-3 flex justify-center items-center bg-green-500 rounded-full">
                        <i class="fa fa-eye text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Total Halaman Dilihat</p>
                        <h2 class="text-3xl font-semibold">764</h2>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center gap-4">
                    <div class="p-3 flex justify-center items-center bg-indigo-500 rounded-full">
                        <i class="fa fa-globe text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Negara</p>
                        <h2 class="text-3xl font-semibold">2</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bagan/Chart --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">
            <div class="lg:col-span-3 bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-medium text-gray-800">Tren Pengunjung Harian</h3>
                <canvas id="dailyVisitorChart" class="mt-4"></canvas>
            </div>
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md flex flex-col justify-center items-center">
                <h3 class="font-medium text-gray-800">Tipe Pengguna</h3>
                <div class="w-full max-w-xs mx-auto">
                    <canvas id="userTypeChart" class="mt-4"></canvas>
                </div>
            </div>
        </div>

        {{-- Tabel Data --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-medium">Halaman Paling Populer</h3>
                <table class="min-w-full mt-4 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left font-semibold">Halaman</th>
                            <th class="py-2 px-4 text-left font-semibold">Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2 px-4">Beranda</td>
                            <td class="py-2 px-4">120</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 px-4">Tentang</td>
                            <td class="py-2 px-4">98</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">Kontak</td>
                            <td class="py-2 px-4">75</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-medium">Browser Teratas</h3>
                <table class="min-w-full mt-4 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left font-semibold">Browser</th>
                            <th class="py-2 px-4 text-left font-semibold">Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2 px-4">Chrome</td>
                            <td class="py-2 px-4">750</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2 px-4">Edge</td>
                            <td class="py-2 px-4">80</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">Firefox</td>
                            <td class="py-2 px-4">20</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-medium">Negara Teratas</h3>
                <table class="min-w-full mt-4 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left font-semibold">Negara</th>
                            <th class="py-2 px-4 text-left font-semibold">Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2 px-4">Indonesia</td>
                            <td class="py-2 px-4">700</td>
                        </tr>
                        <tr class="border-b">
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
        </div>
    </section>
@endsection

@push('scripts')
    {{-- Memuat library Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data untuk Tren Pengunjung Harian
            const dailyVisitorCtx = document.getElementById('dailyVisitorChart').getContext('2d');
            new Chart(dailyVisitorCtx, {
                type: 'line',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    datasets: [{
                        label: 'Pengunjung',
                        data: [12, 19, 3, 5, 2, 3, 9],
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Data untuk Tipe Pengguna
            const userTypeCtx = document.getElementById('userTypeChart').getContext('2d');
            new Chart(userTypeCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Baru', 'Kembali'],
                    datasets: [{
                        label: 'Tipe Pengguna',
                        data: [300, 150],
                        backgroundColor: [
                            'rgb(59, 130, 246)',
                            'rgb(22, 163, 74)',
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        });
    </script>
@endpush
