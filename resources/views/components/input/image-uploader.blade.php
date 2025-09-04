@props([
    'name' => 'image',
])
<div class="rounded-lg border border-gray-300 p-6 text-center h-fit">
    <i class="fa-regular fa-image text-4xl text-gray-400"></i>
    <p class="mt-4 text-sm font-medium text-gray-900">
        Unggah sampul, atau
        <label for="file-upload" class="cursor-pointer font-semibold text-blue-600 hover:text-blue-700">
            telusuri
            <input id="file-upload" name="{{ $name }}" type="file" class="sr-only">
        </label>
    </p>
    <p class="mt-2 text-xs text-gray-500">
        Ukuran 1920x1080px<br>
        diperlukan dalam format PNG atau JPG saja.
    </p>
</div>
