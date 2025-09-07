@props([
    'name',
    'label',
    'placeholder' => '',
    'required' => false,
    'value' => '',
])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </label>
    <div class="relative mt-1 rounded-md shadow-sm">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
            <i class="fa fa-link text-gray-400"></i>
        </div>
        <input type="url" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
            class="block w-full rounded-md border border-gray-300 py-2 pl-10 pr-3 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            placeholder="{{ $placeholder }}">
    </div>
    <p id="error-{{ $name }}" class="mt-1 text-xs text-red-600"></p>
</div>

