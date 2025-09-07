{{-- File 2: resources/views/layouts/partials/sidebar-guest.blade.php --}}
{{-- Ganti isi file sidebar Anda dengan kode ini --}}

<!-- Background overlay untuk mobile, muncul saat sidebar terbuka -->
<div x-show="sidebarOpen" class="lg:hidden fixed inset-0 bg-gray-900/50 z-30" @click="sidebarOpen = false"
    x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

<!-- Sidebar -->
<aside
    class="fixed inset-y-0 left-0 z-40 w-64 lg:w-1/4 bg-white p-8 border-r border-gray-200 transform transition-transform duration-300 ease-in-out lg:static lg:inset-auto lg:translate-x-0"
    :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }">

    {{-- Logo di bagian paling atas, disembunyikan di mobile --}}
    <div class="hidden lg:block mb-8">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/dimsa_blue.png') }}" alt="Logo Pondok" class="h-10 mx-auto lg:mx-0">
        </a>
    </div>

    {{-- Header Sidebar dengan Tombol Close untuk Mobile --}}
    <div class="flex flex-col-reverse gap-y-4 lg:flex-row lg:items-center lg:justify-between mb-10">
        <a href="{{ route('landing-page') }}"
            class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
            Kembali ke beranda
        </a>
        {{-- Tombol Close hanya muncul di mobile dan diposisikan di kanan atas --}}
        <button @click="sidebarOpen = false" class="lg:hidden self-end text-gray-500 hover:text-gray-600">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    {{-- Menu Navigasi Sidebar --}}
    <nav class="space-y-2">
        <a href="{{ route('guest.selayang-pandang') }}"
            class="block px-4 py-2 text-sm font-medium rounded-lg
                {{ request()->routeIs('guest.selayang-pandang') ? 'text-blue-600 bg-blue-50 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Selayang Pandang
        </a>
        <a href="{{ route('guest.sejarah-pondok') }}"
            class="block px-4 py-2 text-sm font-medium rounded-lg
                {{ request()->routeIs('guest.sejarah-pondok') ? 'text-blue-600 bg-blue-50 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Sejarah Pondok
        </a>
        <a href="{{ route('guest.visi-misi') }}"
            class="block px-4 py-2 text-sm font-medium rounded-lg
                {{ request()->routeIs('guest.visi-misi') ? 'text-blue-600 bg-blue-50 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Visi & Misi
        </a>
        <a href="{{ route('guest.struktur-organisasi') }}"
            class="block px-4 py-2 text-sm font-medium rounded-lg
                {{ request()->routeIs('guest.struktur-organisasi') ? 'text-blue-600 bg-blue-50 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Struktur Organisasi
        </a>
        <a href="{{ route('guest.akreditasi') }}"
            class="block px-4 py-2 text-sm font-medium rounded-lg
                {{ request()->routeIs('guest.akreditasi') ? 'text-blue-600 bg-blue-50 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Akreditasi
        </a>
        <a href="{{ route('guest.logo') }}"
            class="block px-4 py-2 text-sm font-medium rounded-lg
                {{ request()->routeIs('guest.logo') ? 'text-blue-600 bg-blue-50 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Logo & Brand
        </a>
    </nav>
</aside>
