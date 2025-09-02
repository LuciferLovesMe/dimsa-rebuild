@props(['status' => null, 'color' => null])

<div
    class="flex {{ $status == 'SMP Darun Ihsan' ? 'bg-green-100' : 'bg-blue-100' }} px-4 py-2 text-center w-fit rounded-lg items-center justify-center">
    <p class="ms-2 {{ $status == 'SMP Darun Ihsan' ? 'text-green-800' : 'text-blue-800' }} rounded-md text-xs">
        {{ ucfirst($status) }}
    </p>
</div>
