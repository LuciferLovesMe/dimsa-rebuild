@include('layouts.head')

<body x-data="{ sidebarOpen: false }">
    <div class="relative flex min-h-screen">

        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"
            x-cloak>
        </div>

        @include('layouts.partials.sidebar')

        <div class="flex flex-1 flex-col">

            <header class="flex items-center justify-between bg-white p-4 lg:hidden shadow">
                <a href="{{ route('admin.dashboard') }}">
                    <img class="h-8 w-auto" src="{{ asset('images/dimsa_blue.png') }}" alt="Logo DIMSA">
                </a>
                <button @click="sidebarOpen = !sidebarOpen"
                    class="rounded-lg p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button>
            </header>

            <main class="flex-1 overflow-y-auto bg-slate-100 p-4 sm:p-8 md:p-14">
                <div class="mb-4">
                    <a href="@yield('backUrl')"
                        class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 transition-colors hover:text-gray-900">
                        <i class="fa fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow-md">
                    <div class="border-b border-gray-200 p-6">
                        <h1 class="text-2xl font-semibold text-gray-900">@yield('pageTitle')</h1>
                    </div>
                    <div class="p-6">
                        @yield('formContent')
                    </div>
                </div>

            </main>

        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('scripts')
</body>

</html>
