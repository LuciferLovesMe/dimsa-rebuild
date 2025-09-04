@props([
    'name' => 'status',
    'label' => '*Centang box disamping untuk publish data ke website!',
])

<div class="relative flex items-start">
    <div class="flex h-5 items-center">
        <input id="{{ $name }}" name="{{ $name }}" type="checkbox" value="1"
            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
    </div>
    <div class="ml-3 text-sm">
        <label for="{{ $name }}" class="font-medium text-gray-700">{{ $label }}</label>
    </div>
</div>
