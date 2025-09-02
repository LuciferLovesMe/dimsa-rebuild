<aside
    class="fixed inset-y-0 left-0 z-50 flex h-full w-fit flex-col bg-gray-900 text-gray-300 transition-transform duration-300 lg:relative lg:translate-x-0"
    :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }">

    <!-- Logo -->
    <div class="flex h-20 shrink-0 items-center px-8 py-4">
        <img class="h-8 w-auto" src="{{ asset('images/dimsa_white.png') }}" alt="Logo DIMSA">
    </div>

    <!-- Navigation Links -->
    <nav class="flex-grow space-y-3 overflow-y-auto px-8 scrollbar-hide">
        {{-- Tautan tunggal --}}
        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-subitem
                {{ request()->is('admin/dashboard*') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fa fa-pie-chart"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.slideshow.index') }}"
            class="sidebar-subitem
                {{ request()->is('admin/slideshow*') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fa-regular fa-window-maximize"></i>
            <span>Slideshow</span>
        </a>

        {{-- Dropdown Tentang Sekolah --}}
        <div x-data="{ open: {{ request()->is(['admin/dewan*', 'admin/staff*', 'admin/partner*', 'admin/program*', 'admin/tata-tertib*']) ? 'true' : 'false' }} || localStorage.getItem('tentangSekolahOpen') === 'true' }" x-init="$watch('open', value => localStorage.setItem('tentangSekolahOpen', value))" class="mb-2">
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
                <li><a href="{{ route('admin.dewan.pimpinan') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/dewan*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-users"></i>
                        <span>Dewan Yayasan</span>
                    </a></li>
                <li><a href="{{ route('admin.staff.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/staff*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-graduation-cap"></i>
                        <span>Guru & Staff</span>
                    </a></li>
                <li><a href="{{ route('admin.partner.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/partner*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-handshake"></i>
                        <span>Partner Lembaga</span>
                    </a></li>
                <li><a href="{{ route('admin.program.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/program*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-trophy"></i>
                        <span>Program Unggulan</span>
                    </a></li>
                <li><a href="{{ route('admin.tata-tertib.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/tata-tertib*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-warning"></i>
                        <span>Tata Tertib</span>
                    </a></li>
            </ul>
        </div>

        {{-- Dropdown Informasi --}}
        <div x-data="{ open: {{ request()->is(['admin/berita*', 'admin/karya-ilmiah*', 'admin/majalah*', 'admin/galeri*', 'admin/pengumuman*', 'admin/qna*', 'admin/alumni*', 'admin/lowongan-kerja*', 'admin/testimoni*']) ? 'true' : 'false' }} || localStorage.getItem('informasiOpen') === 'true' }" x-init="$watch('open', value => localStorage.setItem('informasiOpen', value))" class="mb-2">
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
                <li><a href="{{ route('admin.agenda.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/agenda*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-calendar"></i>
                        <span>Agenda</span>
                    </a></li>
                <li><a href="{{ route('admin.berita.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/berita*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-newspaper"></i>
                        <span>Berita</span>
                    </a></li>
                <li><a href="{{ route('admin.karya-ilmiah.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/karya-ilmiah*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-book"></i>
                        <span>Karya Ilmiah</span>
                    </a></li>
                <li><a href="{{ route('admin.majalah.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/majalah*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-journal-whills"></i>
                        <span>Majalah</span>
                    </a></li>
                <li><a href="{{ route('admin.galeri.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/galeri*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-image"></i>
                        <span>Galeri</span>
                    </a></li>
                <li><a href="{{ route('admin.pengumuman.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/pengumuman*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-bullhorn"></i>
                        <span>Pengumuman</span>
                    </a></li>
                <li><a href="{{ route('admin.qna.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/qna*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-question-circle"></i>
                        <span>QnA</span>
                    </a></li>
                <li><a href="{{ route('admin.alumni.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/alumni*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-address-book"></i>
                        <span>Alumni</span>
                    </a></li>
                <li><a href="{{ route('admin.lowongan-kerja.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/lowongan-kerja*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-briefcase"></i>
                        <span>Lowongan Kerja</span>
                    </a></li>
                <li><a href="{{ route('admin.testimoni.index') }}"
                        class="sidebar-subitem
                            {{ request()->is('admin/testimoni*') ? 'bg-blue-600 text-white' : '' }}">
                        <i class="fa fa-image"></i>
                        <span>Testimoni</span>
                    </a></li>
            </ul>
        </div>

        <a href="{{ route('admin.ekstrakurikuler.index') }}"
            class="sidebar-subitem
                {{ request()->is('admin/ekstrakurikuler*') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fa fa-star"></i>
            <span>Ekstrakurikuler</span>
        </a>
        <a href="{{ route('admin.fasilitas.index') }}"
            class="sidebar-subitem
                {{ request()->is('admin/fasilitas*') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fa fa-building"></i>
            <span>Fasilitas</span>
        </a>
    </nav>

    <!-- User Profile -->
    <div class="mt-auto p-4" x-data="{ user: { name: 'Memuat...', email: '...' } }" x-init="$.ajax({
        url: '/api/admin/profile/show',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success' && response.data) {
                user.name = response.data.name;
                user.email = response.data.email;
            } else {
                user.name = 'Gagal Memuat';
            }
        },
        error: function(error) {
            console.error('Error fetching user profile:', error);
            user.name = 'Error';
            user.email = 'Tidak dapat memuat data';
        }
    })">
        <a href="#" class="flex items-center gap-4 rounded-lg p-2 hover:bg-gray-800">
            <img class="h-10 w-10 rounded-full object-cover"
                :src="'https://placehold.co/40x40/e2e8f0/334155?text=' + (user.name.charAt(0).toUpperCase() || 'A')"
                :alt="user.name + ' Avatar'">
            <div class="text-left">
                {{-- Nama dan email pengguna akan ditampilkan di sini --}}
                <p x-text="user.name" class="text-sm font-semibold text-white"></p>
                <p x-text="user.email" class="text-xs text-gray-400"></p>
            </div>
            <svg class="ml-auto h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                </path>
            </svg>
        </a>
    </div>
</aside>
