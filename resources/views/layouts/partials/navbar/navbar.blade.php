<div x-data="{
    offcanvasOpen: false,
    activeTab: 'profil'
}" class="relative">

    <!-- Navbar Utama -->
    <nav class="absolute top-0 left-0 right-0 w-full bg-transparent px-4 sm:px-8 lg:px-20 py-6 z-40">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('landing-page') }}" class="flex-shrink-0">
                <img src="{{ asset('images/dimsa_white.png') }}" alt="Logo DIMSA" class="h-10 sm:h-12 w-auto">
            </a>

            <!-- Tombol Aksi di Kanan -->
            <div class="flex items-center gap-2 sm:gap-4">
                <a href="https://bit.ly/PSB-SMP-MA-DIMSA-25-26" target="_blank"
                    class="hidden sm:inline-block bg-blue-600 text-white font-semibold py-2 px-5 rounded-lg text-sm hover:bg-blue-700 transition-colors">
                    PSB Online
                </a>
                <button @click="offcanvasOpen = true" type="button"
                    class="bg-gray-800 bg-opacity-50 backdrop-blur-sm text-white font-semibold py-2 px-5 rounded-lg text-sm hover:bg-opacity-75 transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="hidden sm:inline">Menu</span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Off-Canvas Menu -->
    <div x-show="offcanvasOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-50" style="display: none;">

        <!-- Konten Off-Canvas -->
        <div @click.away="offcanvasOpen = false" x-show="offcanvasOpen"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="transform -translate-y-full"
            x-transition:enter-end="transform translate-x-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="transform translate-x-0" x-transition:leave-end="transform -translate-y-full"
            class="fixed top-0 right-0 h-full w-full bg-white shadow-lg flex flex-col lg:flex-row">

            <!-- Tombol Close (Pojok Kanan Atas) -->
            <button @click="offcanvasOpen = false"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- Memanggil Partial untuk Kolom Kiri --}}
            @include('layouts.partials.navbar.offcanvas-left')

            {{-- Memanggil Partial untuk Kolom Kanan --}}
            @include('layouts.partials.navbar.offcanvas-right')

        </div>
    </div>
</div>
