@props(['name', 'label', 'placeholder' => '', 'required' => false, 'rows' => 3, 'value' => ''])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </label>
    <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}"
        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        placeholder="{{ $placeholder }}">{{ old($name, $value) }}</textarea>
    <p id="error-{{ $name }}" class="mt-1 text-xs text-red-600"></p>
</div>
