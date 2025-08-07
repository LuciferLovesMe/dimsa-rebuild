{{-- page indicator --}}

@props([
    'title' => 'Default Title',
    'breadcrumb' => 'Default Breadcrumb',
    'sub_breadcrumb' => 'Default Sub Breadcrumb',
])

<div class="container mx-auto p-2">
    <!-- Title Dinamis -->
    <h1 class="text-3xl text-gray-900">{{ $title ?? 'Default Title' }}</h1>

    <!-- Breadcrumb Dinamis -->
    <div class="flex flex-row text-sm mt-2">
        <p class="text-gray-400">Sekolah / {{ $breadcrumb ?? 'Default Breadcrumb' }} /</p>
        <p class="text-blue_primary font-medium">{{ $sub_breadcrumb ?? 'Default Sub Breadcrumb' }}</p>
    </div>

    <!-- Konten Utama -->
    <div class="p-8 mt-4 h-96 rounded-lg shadow-lg bg-white">
        {{ $slot }} <!-- Konten utama akan dimasukkan di sini -->
    </div>
</div>
