@props(['name', 'label', 'required' => false, 'value' => ''])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </label>
    <input type="date" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    {{-- Container untuk pesan error dari AJAX --}}
    <p id="error-{{ $name }}" class="mt-1 text-xs text-red-600"></p>
</div>

