@props(['status' => null, 'color' => null])

<div
    class="flex {{ $status == 'Publish' ? 'bg-green-100' : 'bg-yellow-100' }} px-4 py-2 text-center w-fit rounded-lg items-center justify-center">
    <div class="w-1.5 h-1.5 {{ $status == 'Publish' ? 'bg-green-500' : 'bg-yellow-500' }} rounded-full"></div>
    <p class="ms-2 {{ $status == 'Publish' ? 'text-green-800' : 'text-yellow-800' }} rounded-md text-xs">
        {{ ucfirst($status) }}
    </p>
</div>
