@props(['title', 'description', 'items' => []])

<div>
    <h3 class="text-2xl font-bold text-gray-900">{{ $title }}</h3>
    <p class="text-gray-600 mt-2">{{ $description }}</p>

    <ul class="mt-6 space-y-4 text-gray-700">
        @foreach ($items as $item)
            <li>
                <a href="{{ $item['url'] }}" class="hover:text-blue-600 font-semibold">
                    {{ $item['text'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
