<aside
    class="fixed inset-y-0 left-0 z-50 flex h-full w-fit flex-col bg-gray-900 text-gray-300 transition-transform duration-300 lg:relative lg:translate-x-0"
    :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }">

    <!-- Logo -->
    <div class="flex h-20 shrink-0 items-center px-8 py-4">
        <img class="h-8 w-auto" src="{{ asset('images/dimsa_white.png') }}" alt="Logo DIMSA">
    </div>

    <!-- Navigation Links -->
    <nav class="flex-grow space-y-3 overflow-y-auto px-8 scrollbar-hide">
        <a href="{{ route('dashboard') }}"
            class="sidebar-subitem
                {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fa fa-pie-chart"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('slideshow') }}"
            class="sidebar-subitem
                {{ request()->routeIs('slideshow') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fa-regular fa-window-maximize"></i>
            <span>Slideshow</span>
        </a>

        <div x-data="{ open: localStorage.getItem('tentangSekolahOpen') === 'true' }" x-init="$watch('open', value => localStorage.setItem('tentangSekolahOpen', value))" class="mb-2">
            <button @click="open = !open"
                class="flex w-full items-center justify-between gap-3 rounded-lg px-3 py-2.5 text-sm font-medium hover:bg-gray-800 hover:text-white">
                <span class="flex items-center gap-3">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Tentang Sekolah</span>
                </span>
                <svg class="h-4 w-4 shrink-0 transition-transform" :class="{ 'rotate-90': open }" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <ul x-show="open" x-transition class="mt-2 space-y-1 pl-5">
                <li><a href="{{ route('dewan') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('dewan') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-users"></i>
                        <span>Dewan Yayasan</span>
                    </a></li>
                <li><a href="{{ route('staff') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('staff') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-graduation-cap"></i>
                        <span>Guru & Staff</span>
                    </a></li>
                <li><a href="{{ route('partner') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('partner') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-handshake"></i>
                        <span>Partner Lembaga</span>
                    </a></li>
                <li><a href="{{ route('program') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('program') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-trophy"></i>
                        <span>Program Unggulan</span>
                    </a></li>
                <li><a href="{{ route('tatib') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('tatib') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-warning"></i>
                        <span>Tata Tertib</span>
                    </a></li>
            </ul>
        </div>

        <div x-data="{ open: localStorage.getItem('informasiOpen') === 'true' }" x-init="$watch('open', value => localStorage.setItem('informasiOpen', value))" class="mb-2">
            <button @click="open = !open"
                class="flex w-full items-center justify-between gap-3 rounded-lg px-3 py-2.5 text-sm font-medium hover:bg-gray-800 hover:text-white">
                <span class="flex items-center gap-3">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span>Informasi</span>
                </span>
                <svg class="h-4 w-4 shrink-0 transition-transform" :class="{ 'rotate-90': open }" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <ul x-show="open" x-transition class="mt-2 space-y-1 pl-5">
                <li><a href="{{ route('berita') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('berita') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fa fa-newspaper"></i>
                        <span>Berita</span>
                    </a></li>
                <li><a href="{{ route('karya-ilmiah') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('karya-ilmiah') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fa fa-book"></i>
                        <span>Karya Ilmiah</span>
                    </a></li>
                <li><a href="{{ route('karya-ilmiah') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('karya-ilmiah') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fa fa-journal-whills"></i>
                        <span>Majalah</span>
                    </a></li>
                <li><a href="{{ route('karya-ilmiah') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('karya-ilmiah') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fa fa-image"></i>
                        <span>Galeri</span>
                    </a></li>
                <li><a href="{{ route('karya-ilmiah') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('karya-ilmiah') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fa fa-bullhorn"></i>
                        <span>Pengumuman</span>
                    </a></li>
                <li><a href="{{ route('karya-ilmiah') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('karya-ilmiah') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fa fa-question-circle"></i>
                        <span>QnA</span>
                    </a></li>
                <li><a href="{{ route('karya-ilmiah') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('karya-ilmiah') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fa fa-address-book"></i>
                        <span>Alumni</span>
                    </a></li>
                <li><a href="{{ route('karya-ilmiah') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('karya-ilmiah') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fa fa-briefcase"></i>
                        <span>Lowongan Kerja</span>
                    </a></li>
                <li><a href="{{ route('karya-ilmiah') }}"
                        class="sidebar-subitem
                            {{ request()->routeIs('karya-ilmiah') ? 'bg-gray-800 text-gray-500' : '' }}">
                        <i class="fa fa-image"></i>
                        <span>Testimoni</span>
                    </a></li>
            </ul>
        </div>
        <a href="{{ route('ekstrakurikuler') }}"
            class="sidebar-subitem
                {{ request()->routeIs('ekstrakurikuler') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fa fa-star"></i>
            <span>Ekstrakurikuler</span>
        </a>
        <a href="{{ route('fasilitas') }}"
            class="sidebar-subitem
                {{ request()->routeIs('fasilitas') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fa fa-building"></i>
            <span>Fasilitas</span>
        </a>
    </nav>

    <!-- User Profile -->
    <div class="mt-auto p-4">
        <a href="#" class="flex items-center gap-4 rounded-lg p-2 hover:bg-gray-800">
            <img class="h-10 w-10 rounded-full object-cover" src="https://placehold.co/40x40/e2e8f0/334155?text=A"
                alt="Admin Avatar">
            <div class="text-left">
                <p class="text-sm font-semibold text-white">Admin</p>
                <p class="text-xs text-gray-400">Administrator</p>
            </div>
            <svg class="ml-auto h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                </path>
            </svg>
        </a>
    </div>
</aside>
