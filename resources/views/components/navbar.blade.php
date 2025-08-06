 <nav class="bg-gray-800 text-white shadow-lg px-6 py-3">
     <div class="container mx-auto flex justify-between items-center p-4">
         <!-- Logo & Nama -->
         <div class="flex items-center">
             <img src="{{ asset('images/dimsa_white.png') }}" alt="Logo DIMSA" class="w-16 md:w-20 mr-4">
             {{-- <span class="text-lg font-bold">DIMSA</span> --}}
         </div>

         <!-- Menu Utama (Desktop) -->
         <ul class="hidden md:flex items-center space-x-6">
             <!-- Menu Item: Profil -->
             <li x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                 <a href="#"
                     class="relative py-4 hover:text-gray-300 transition-colors duration-200 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Profil</a>
                 <div x-show="open" x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="absolute left-0 mt-5 w-56 bg-white text-gray-800 rounded-md shadow-xl z-20">
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Selayang Pandang</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Sejarah</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Visi & Misi</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Struktur
                         Organisasi</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Akreditasi</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Logo & Brand</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Pimpinan & Dewan
                         Guru</a>
                 </div>
             </li>

             <!-- Menu Item: Akademik -->
             <li x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                 <a href="#"
                     class="relative py-2 hover:text-gray-300 transition-colors duration-200 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Akademik</a>
                 <div x-show="open" x-transition
                     class="absolute left-0 mt-5 w-48 bg-white text-gray-800 rounded-md shadow-xl z-20">
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">SMP</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">MA</a>
                 </div>
             </li>

             <!-- Menu Item: Program -->
             <li x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                 <a href="#"
                     class="relative py-2 hover:text-gray-300 transition-colors duration-200 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Program</a>
                 <div x-show="open" x-transition
                     class="absolute left-0 mt-5 w-56 bg-white text-gray-800 rounded-md shadow-xl z-20">
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Kelas Khusus
                         Cyber</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Kelas Khusus
                         Tahfidz</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Kurikulum Pondok</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Ekstrakurikuler</a>
                 </div>
             </li>

             <!-- Menu Item: Fasilitas -->
             <li x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                 <a href="#"
                     class="relative py-2 hover:text-gray-300 transition-colors duration-200 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Fasilitas</a>
                 <div x-show="open" x-transition
                     class="absolute left-0 mt-5 w-56 bg-white text-gray-800 rounded-md shadow-xl z-20">
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Sarana Prasarana</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Panduan Tata
                         Tertib</a>
                 </div>
             </li>

             <!-- Menu Item: Berita -->
             <li x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                 <a href="#"
                     class="relative py-2 hover:text-gray-300 transition-colors duration-200 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-white after:transition-all after:duration-300 hover:after:w-full">Berita</a>
                 <div x-show="open" x-transition
                     class="absolute right-0 mt-5 w-56 bg-white text-gray-800 rounded-md shadow-xl z-20">
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Dimsa dalam
                         Berita</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Karya Ilmiah</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Majalah</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Galeri</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Pengumuman</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">QnA</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Jejaring Alumni</a>
                     <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-md">Lowongan Kerja</a>
                 </div>
             </li>
         </ul>

         <!-- Tombol PSB Online -->
         <div class="hidden md:block">
             <a href="#"
                 class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors duration-200">PSB
                 Online</a>
         </div>

         <!-- Tombol Menu Mobile -->
         <div class="md:hidden">
             <button class="text-white focus:outline-none">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M4 6h16M4 12h16m-7 6h7"></path>
                 </svg>
             </button>
         </div>
     </div>
 </nav>
