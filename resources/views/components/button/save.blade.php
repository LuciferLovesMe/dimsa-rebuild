@props([
    'text' => 'Simpan Data',
])

<button type="button"
    id="btnSimpan" class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-5 rounded-lg text-sm shadow-md transition-all duration-200">
    <span class="font-semibold">{{ $text }}</span>
</button>
