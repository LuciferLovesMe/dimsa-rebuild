{{-- 1. Sidebar --}}
<aside class="w-1/4 bg-white p-8 border-r border-gray-200 hidden lg:block">
    {{-- Tombol Kembali --}}
    <a href="#" class="mt-5 mb-10 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                clip-rule="evenodd" />
        </svg>
        Kembali ke beranda
    </a>

    {{-- Menu Navigasi Sidebar --}}
    <nav class="space-y-2">
        <a href="{{ route('selayang-pandang') }}"
            class="block px-4 py-2 text-sm font-medium rounded-lg
                {{ Route::currentRouteName() == 'selayang-pandang' ? 'text-blue-600 bg-blue-50 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Selayang Pandang
        </a>
        <a href="{{ route('sejarah-pondok') }}"
            class="block px-4 py-2 text-sm font-medium rounded-lg
                {{ Route::currentRouteName() == 'sejarah-pondok' ? 'text-blue-600 bg-blue-50 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Sejarah Pondok
        </a>
        <a href="{{ route('visi-misi') }}"
            class="block px-4 py-2 text-sm font-medium rounded-lg
                {{ Route::currentRouteName() == 'visi-misi' ? 'text-blue-600 bg-blue-50 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Visi & Misi
        </a>
        <a href="{{ route('struktur-organisasi') }}"
            class="block px-4 py-2 text-sm font-medium rounded-lg
                {{ Route::currentRouteName() == 'struktur-organisasi' ? 'text-blue-600 bg-blue-50 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Struktur Organisasi
        </a>
        <a href="{{ route('akreditasi') }}"
            class="block px-4 py-2 text-sm font-medium rounded-lg
                {{ Route::currentRouteName() == 'akreditasi' ? 'text-blue-600 bg-blue-50 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Akreditasi
        </a>
        <a href="{{ route('logo') }}"
            class="block px-4 py-2 text-sm font-medium rounded-lg
                {{ Route::currentRouteName() == 'logo' ? 'text-blue-600 bg-blue-50 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            Logo & Brand
        </a>
    </nav>
</aside>
