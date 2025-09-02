@props([
    'detail' => '#',
    'edit' => '#',
    'delete' => '#',
])
<div class="flex gap-2 justify-center">
    <a href="{{ $detail }}" class="detail-btn-table"><i class="text-sm fa-regular fa-eye"></i></a>
    <a href="{{ $edit }}" class="edit-btn-table"><i
            class="text-sm fa-regular fa-pen-to-square"></i></a>
    <a href="{{ $delete }}" class="delete-btn-table"><i
            class="text-sm fa-regular fa-trash-can"></i></a>
</div>