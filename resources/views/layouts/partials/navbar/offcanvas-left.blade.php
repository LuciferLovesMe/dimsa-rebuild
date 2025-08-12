<!-- Kolom Kiri (Menu Utama) -->
<div class="w-full lg:w-1/4 bg-[#02060D] text-white p-8 lg:p-16 flex flex-col justify-center">

    <img src="{{ asset('images/dimsa_white.png') }}" alt="Logo Dimsa" class="h-auto w-20">
    <div class="space-y-4 mt-20">
        <button @click="activeTab = 'profil'"
            :class="{ 'font-bold text-white': activeTab === 'profil', 'text-gray-400 hover:text-white': activeTab !== 'profil' }"
            class="text-xl transition-colors">Profil</button>
        <button @click="activeTab = 'akademik'"
            :class="{ 'font-bold text-white': activeTab === 'akademik', 'text-gray-400 hover:text-white': activeTab !== 'akademik' }"
            class="block text-xl transition-colors">Akademik</button>
        <button @click="activeTab = 'program'"
            :class="{ 'font-bold text-white': activeTab === 'program', 'text-gray-400 hover:text-white': activeTab !== 'program' }"
            class="block text-xl transition-colors">Program</button>
        <button @click="activeTab = 'fasilitas'"
            :class="{ 'font-bold text-white': activeTab === 'fasilitas', 'text-gray-400 hover:text-white': activeTab !== 'fasilitas' }"
            class="block text-xl transition-colors">Fasilitas</button>
        <button @click="activeTab = 'berita'"
            :class="{ 'font-bold text-white': activeTab === 'berita', 'text-gray-400 hover:text-white': activeTab !== 'berita' }"
            class="block text-xl transition-colors">Berita</button>
    </div>
    <!-- Social Media & PSB Mobile -->
    <div class="mt-auto pt-8">
        <a href="https://bit.ly/PSB-SMP-MA-DIMSA-25-26" target="_blank"
            class="block w-full text-center sm:hidden bg-blue-600 text-white font-semibold py-3 px-5 rounded-lg text-base hover:bg-blue-700 transition-colors mb-6">
            PSB Online
        </a>
        <div class="flex items-center space-x-5">
            <a href="#" class="p-2 border border-gray-600 rounded-full hover:bg-gray-700">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="#" class="p-2 border border-gray-600 rounded-full hover:bg-gray-700">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="#" class="p-2 border border-gray-600 rounded-full hover:bg-gray-700">
                <i class="fa-brands fa-youtube"></i>
            </a>
        </div>
    </div>
</div>
