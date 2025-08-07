@include('layouts.head')

<body class="flex">

    @include('components.sidebar')

    <div class="flex flex-1 flex-col">

        <!-- Mobile Header -->
        <header class="flex items-center justify-between bg-white p-4 lg:hidden">
            <a href="#">
                <img class="h-8 w-auto" src="https://placehold.co/150x50/1f2937/ffffff?text=DIMSA" alt="Logo DIMSA">
            </a>
            <button @click="sidebarOpen = !sidebarOpen"
                class="rounded-lg p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </header>

        <main class="flex-1 overflow-y-auto bg-slate-100 p-8">
            <div class="container flex-col">
                <div class="flex flex-row justify-between text-gray-400 text-xl mb-10">
                    <i class="fa fa-bars"></i>
                    <i class="fa fa-bell"></i>
                </div>

                <!-- Main Content -->
                <!-- Judul Dinamis -->
                <h1 class="text-3xl text-gray-900">{{ $title ?? 'Default Title' }}</h1>

                <!-- Breadcrumb Dinamis -->
                <div class="flex flex-row text-sm mt-2">
                    <p class="text-gray-400">Sekolah / {{ $breadcrumb ?? 'Default Breadcrumb' }} /</p>
                    <p class="text-blue_primary font-medium">{{ $sub_breadcrumb ?? 'Default Sub Breadcrumb' }}</p>
                </div>

                <div class="p-8 mt-4 h-96 rounded-lg shadow-lg bg-white">
                    {{-- Isi konten di sini --}}
                    @yield('content')
                </div>
            </div>
        </main>

    </div>
</body>
