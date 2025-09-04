@props([
    'detail' => null,
    'edit' => '#',
    'delete' => null,
])

<div class="flex gap-2 justify-center">
    {{-- Tombol Detail dengan styling baru --}}
    <button type="button"
        class="detail-btn-modal detail-btn-table border border-blue-700 bg-blue-50 hover:bg-blue-700 hover:border-blue-800 text-blue-700 hover:text-white py-2 px-3 rounded-lg text-sm shadow-sm transition-all duration-200 transform hover:scale-105 flex items-center justify-center"
        title="Lihat Detail" data-id="{{ $detail }}">
        <i class="text-sm fa-regular fa-eye"></i>
    </button>

    {{-- Tombol Edit dengan styling baru --}}
    <a href="{{ $edit }}"
        class="edit-btn-table border border-yellow-500 bg-yellow-50 hover:bg-yellow-500 hover:border-yellow-500 text-yellow-700 hover:text-white py-2 px-3 rounded-lg text-sm shadow-sm transition-all duration-200 transform hover:scale-105 flex items-center justify-center"
        title="Edit Data">
        <i class="text-sm fa-regular fa-pen-to-square"></i>
    </a>

    {{-- Tombol Hapus dengan styling baru --}}
    <button type="button"
        class="delete-btn-table border border-red-700 bg-red-50 hover:bg-red-700 hover:border-red-800 text-red-700 hover:text-white py-2 px-3 rounded-lg text-sm shadow-sm transition-all duration-200 transform hover:scale-105 flex items-center justify-center"
        title="Hapus Data" data-id="{{ $delete }}">
        <i class="text-sm fa-regular fa-trash-can"></i>
    </button>
</div>
