@props(['name', 'label', 'type' => 'text', 'placeholder' => '', 'value' => '', 'required' => false])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}">
    <p id="error-{{ $name }}" class="mt-1 text-xs text-red-600"></p>
</div>
