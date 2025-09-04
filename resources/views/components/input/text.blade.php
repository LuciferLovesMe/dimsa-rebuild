@props([
    'name',
    'label',
    'placeholder' => '',
    'required' => false,
])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </label>
    <input type="text" name="{{ $name }}" id="{{ $name }}"
        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        placeholder="{{ $placeholder }}">
</div>
