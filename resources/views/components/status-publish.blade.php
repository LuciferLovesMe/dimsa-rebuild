@props(['status' => null, 'color' => null])

<div class="flex bg-{{ $color }}-100 px-3.5 py-1.5 text-center w-fit rounded-lg items-center justify-center">
    <div class="w-1.5 h-1.5 bg-{{ $color }}-500 rounded-full"></div>
    <p class="ms-2 text-{{ $color }}-800 rounded-md text-xs">{{ ucfirst($status) }}</p>
</div>
