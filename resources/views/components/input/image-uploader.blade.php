@props([
    'name' => 'image',
    'src' => null,
])


<div x-data="{
    photoPreview: '{{ $src }}' || null,
    handlePhotoChange(event) {
        const file = event.target.files[0];
        if (file) {
            this.photoPreview = URL.createObjectURL(file);
        }
    }
}" class="rounded-lg border border-gray-300 p-6 text-center h-fit">

    <input id="file-upload-{{ $name }}" name="{{ $name }}" type="file" class="sr-only"
        @change="handlePhotoChange($event)" accept="image/png, image/jpeg">

    <template x-if="photoPreview">
        <div class="space-y-4">
            <img :src="photoPreview" alt="Pratinjau Gambar"
                class="mx-auto h-32 max-h-32 w-auto object-contain rounded">
            <label for="file-upload-{{ $name }}"
                class="cursor-pointer font-semibold text-blue-600 hover:text-blue-700 text-sm">
                Ganti gambar
            </label>
        </div>
    </template>

    <template x-if="!photoPreview">
        <div class="space-y-1">
            <i class="fa-regular fa-image text-4xl text-gray-400"></i>
            <p class="mt-4 text-sm font-medium text-gray-900">
                Unggah sampul, atau
                <label for="file-upload-{{ $name }}"
                    class="cursor-pointer font-semibold text-blue-600 hover:text-blue-700">
                    telusuri
                </label>
            </p>
            <p class="mt-2 text-xs text-gray-500">
                Ukuran 1920x1080px<br>
                diperlukan dalam format PNG atau JPG saja.
            </p>
        </div>
    </template>
</div>
