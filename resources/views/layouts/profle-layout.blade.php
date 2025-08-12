{{-- File 1: resources/views/layouts/profile-layout.blade.php --}}
{{-- Ganti isi file layout utama Anda dengan kode ini --}}

@include('layouts.head')

{{-- Inisialisasi Alpine.js di body atau di div pembungkus utama --}}

<body x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen bg-gray-50">
        {{-- Panggil sidebar partial Anda --}}
        @include('layouts.partials.sidebar-guest')

        <main class="w-full lg:w-3/4 p-8 lg:p-20 overflow-y-auto">
            {{-- Tombol Hamburger untuk membuka sidebar di mobile --}}
            <div class="lg:hidden mb-6">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <section>
                @yield('content')
            </section>
        </main>
    </div>
    @include('components.footer')
</body>
