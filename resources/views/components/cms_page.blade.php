{{-- page indicator --}}

@props([
    'title' => 'Default Title',
    'breadcrumb1' => 'Default First Breadcrumb',
    'breadcrumb2' => 'Default Breadcrumb',
    'breadcrumb3' => 'Default Sub Breadcrumb',
])

<div class="container mx-auto p-2">
    <div class="flex flex-row justify-between items-end">
        <div class="flex flex-col">
            <h1 class="text-3xl text-gray-900">{{ $title ?? 'Default Title' }}</h1>
            <div class="flex flex-row text-sm mt-2">
                <p class="text-gray-400">{{ $breadcrumb1 ?? 'Default' }} / {{ $breadcrumb2 ?? 'Default Breadcrumb' }} /
                </p>
                <p class="text-blue_primary font-medium">{{ $breadcrumb3 ?? 'Default Sub Breadcrumb' }}</p>
            </div>
        </div>

        {{-- Slot untuk Aksi di Kanan (misalnya, tombol tab) --}}
        @if (isset($actions))
            <div class="mt-4 md:mt-0 md:ml-4">
                {{ $actions }}
            </div>
        @endif


    </div>

    <div class="p-8 mt-4 h-96 rounded-lg shadow-lg bg-white">
        {{ $slot }}
    </div>
</div>
