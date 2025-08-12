@props(['tabs', 'activeTab'])

<div class="relative flex w-fit items-center rounded-lg bg-gray-200 p-1 shadow-inner">

    @foreach ($tabs as $tab)
        @php
            $isActive = $tab['id'] === $activeTab;
            $buttonClasses = $isActive ? 'bg-blue_primary text-white shadow-sm' : 'text-gray-500 hover:text-gray-900';
        @endphp

        <a href="{{ $tab['route'] }}"
            class="toggle-btn z-10 w-full rounded-md px-6 py-1.5 text-sm font-semibold transition-all duration-300 {{ $buttonClasses }}">
            {{ $tab['text'] }}
        </a>
    @endforeach

</div>
