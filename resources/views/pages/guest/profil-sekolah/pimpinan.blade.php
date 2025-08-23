@extends('layouts.app')

@section('title', 'DIMSA - Pimpinan')

@section('content')

    {{-- Data Dummy --}}
    @php
        $pimpinanData = [
            'pimpinan_pondok' => [
                [
                    'name' => 'K.H. Nama Pimpinan',
                    'position' => 'Pimpinan Pondok',
                    'image' => 'https://placehold.co/400x400/e2e8f0/334155?text=Foto',
                ],
                [
                    'name' => 'Dr. Nama Wakil Pimpinan',
                    'position' => 'Wakil Pimpinan',
                    'image' => 'https://placehold.co/400x400/e2e8f0/334155?text=Foto',
                ],
            ],
            'dewan_pengasuh' => [
                [
                    'name' => 'Ust. Nama Pengasuh 1',
                    'position' => 'Anggota Dewan Pengasuh',
                    'image' => 'https://placehold.co/400x400/3b82f6/ffffff?text=Foto',
                ],
                [
                    'name' => 'Ust. Nama Pengasuh 2',
                    'position' => 'Anggota Dewan Pengasuh',
                    'image' => 'https://placehold.co/400x400/3b82f6/ffffff?text=Foto',
                ],
                [
                    'name' => 'Usth. Nama Pengasuh 3',
                    'position' => 'Anggota Dewan Pengasuh',
                    'image' => 'https://placehold.co/400x400/3b82f6/ffffff?text=Foto',
                ],
            ],
            'guru_staff' => [
                [
                    'name' => 'Bpk. Nama Guru',
                    'position' => 'Guru Mata Pelajaran',
                    'image' => 'https://placehold.co/400x400/16a34a/ffffff?text=Foto',
                ],
                [
                    'name' => 'Ibu. Nama Staff',
                    'position' => 'Staff Administrasi',
                    'image' => 'https://placehold.co/400x400/16a34a/ffffff?text=Foto',
                ],
            ],
        ];
    @endphp

    {{-- Hero Section --}}
    <div class="relative h-64 md:h-80 lg:h-96 bg-cover bg-center"
        style="background-image: url('https://placehold.co/1920x400/2d3748/e2e8f0');">
        <div class="absolute inset-0 bg-black opacity-40"></div>

        <div class="relative h-full flex items-center justify-start px-4 sm:px-8 lg:px-20">
            <h1 class="text-4xl md:text-5xl font-bold text-white">Pimpinan Pondok</h1>
        </div>
    </div>

    {{-- Main Content Section with Alpine.js for Tabs --}}
    <div class="px-4 sm:px-8 lg:px-20 py-8" x-data="{ activeTab: 'pimpinan_pondok' }">

        {{-- Tab Navigation --}}
        <div class="border-b border-gray-200 mb-6">
            <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                <a href="#" @click.prevent="activeTab = 'pimpinan_pondok'"
                    :class="{
                        'border-blue-600 text-blue-600': activeTab === 'pimpinan_pondok',
                        'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': activeTab !== 'pimpinan_pondok'
                    }"
                    class="shrink-0 border-b-2 px-1 pb-4 text-sm font-medium">
                    Pimpinan Pondok
                </a>

                <a href="#" @click.prevent="activeTab = 'dewan_pengasuh'"
                    :class="{
                        'border-blue-600 text-blue-600': activeTab === 'dewan_pengasuh',
                        'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': activeTab !== 'dewan_pengasuh'
                    }"
                    class="shrink-0 border-b-2 px-1 pb-4 text-sm font-medium">
                    Dewan Pengasuh
                </a>

                <a href="#" @click.prevent="activeTab = 'guru_staff'"
                    :class="{
                        'border-blue-600 text-blue-600': activeTab === 'guru_staff',
                        'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': activeTab !== 'guru_staff'
                    }"
                    class="shrink-0 border-b-2 px-1 pb-4 text-sm font-medium">
                    Guru & Staff
                </a>
            </nav>
        </div>

        <div>
            {{-- Pimpinan Pondok Content --}}
            <div x-show="activeTab === 'pimpinan_pondok'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($pimpinanData['pimpinan_pondok'] as $pimpinan)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img class="h-64 w-full object-cover" src="{{ $pimpinan['image'] }}"
                            alt="Foto {{ $pimpinan['name'] }}">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $pimpinan['name'] }}</h3>
                            <p class="text-gray-600 mt-1">{{ $pimpinan['position'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Dewan Pengasuh Content --}}
            <div x-show="activeTab === 'dewan_pengasuh'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
                style="display: none;">
                @foreach ($pimpinanData['dewan_pengasuh'] as $pimpinan)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img class="h-64 w-full object-cover" src="{{ $pimpinan['image'] }}"
                            alt="Foto {{ $pimpinan['name'] }}">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $pimpinan['name'] }}</h3>
                            <p class="text-gray-600 mt-1">{{ $pimpinan['position'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Guru & Staff Content --}}
            <div x-show="activeTab === 'guru_staff'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
                style="display: none;">
                @foreach ($pimpinanData['guru_staff'] as $pimpinan)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img class="h-64 w-full object-cover" src="{{ $pimpinan['image'] }}"
                            alt="Foto {{ $pimpinan['name'] }}">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $pimpinan['name'] }}</h3>
                            <p class="text-gray-600 mt-1">{{ $pimpinan['position'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    @include('components.footer')
@endsection
