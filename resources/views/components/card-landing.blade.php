<section class="py-16 sm:py-20 md:py-24">
    <div class="container mx-auto px-4 sm:px-8 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-8">
            <!-- Kartu Penerimaan Santri Baru -->
            <a href="#"
                class="group relative w-full h-[550px] bg-green-800 hover:bg-green-900 rounded-2xl p-8 text-white flex flex-col justify-end overflow-hidden cursor-pointer transition-colors duration-300">
                <div class="absolute top-8 -left-16 group-hover:left-4 transition-all duration-500 ease-in-out">
                    <div class="flex items-center gap-3">
                        <p class="bg-white text-blue-900 font-semibold p-3 rounded-lg whitespace-nowrap">SMP Darul
                            Ihsan</p>
                        <div class="bg-blue-900 w-12 h-12 rounded-lg flex items-center justify-center">
                            <i class="fas fa-building text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute top-24 -right-16 group-hover:right-4 transition-all duration-500 ease-in-out">
                    <div class="flex items-center gap-3">
                        <div class="bg-white w-12 h-12 rounded-lg flex items-center justify-center">
                            <i class="fas fa-city text-blue-900 text-2xl"></i>
                        </div>
                        <p class="bg-white text-blue-900 font-semibold p-3 rounded-lg whitespace-nowrap">MA Darul Ihsan
                        </p>
                    </div>
                </div>
                <div class="relative z-10">
                    <p class="text-xl">Penerimaan</p>
                    <h5 class="text-3xl font-bold">Santri Baru</h5>
                </div>
            </a>
            <!-- Kartu Ruang Literasi -->
            <a href="#"
                class="group relative w-full h-[550px] bg-gray-100 hover:bg-blue-50 rounded-2xl p-8 flex flex-col justify-start overflow-hidden cursor-pointer transition-colors duration-300">
                <div class="text-gray-800">
                    <h5 class="text-3xl font-bold">Ruang Literasi</h5>
                    <p class="text-xl text-gray-600">Darul Ihsan Muhammadiyah</p>
                </div>
                <img src="{{ asset('images/whitebook.svg') }}" alt="Buku Putih"
                    class="absolute w-[350px] bottom-[-150px] left-[-30px] group-hover:bottom-[-140px] group-hover:left-[-40px] transition-all duration-500 ease-in-out z-10">
                <img src="{{ asset('images/pinkbook.svg') }}" alt="Buku Pink"
                    class="absolute w-[500px] bottom-[-60px] right-[-25px] group-hover:bottom-[-40px] group-hover:right-0 transition-all duration-500 ease-in-out z-20">
                <img src="{{ asset('images/bluebook.svg') }}" alt="Buku Biru"
                    class="absolute w-[480px] bottom-[-160px] right-[-130px] group-hover:bottom-[-140px] group-hover:right-[-120px] transition-all duration-500 ease-in-out z-30">
            </a>
            <!-- Kartu Donasi -->
            <div class="lg:col-span-2">
                <div
                    class="flex flex-col md:flex-row items-center bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl shadow-lg w-full overflow-hidden">
                    <div class="p-8 md:p-12 text-left w-full md:w-7/12">
                        <img src="{{ asset('images/lazismu.svg') }}" alt="Logo Lazismu" class="w-12 mb-4">
                        <h2 class="text-2xl md:text-3xl font-bold text-black">Salurkan Harta Terbaikmu,<br>Raih
                            Berkah
                            Ilahi.</h2>
                        <button
                            class="mt-6 bg-black text-white font-semibold py-3 px-8 rounded-lg hover:bg-gray-800 transition-colors">Donasi
                            Sekarang</button>
                    </div>
                    <div class="hidden md:block w-full md:w-5/12 h-64 md:h-auto">
                        <img src="{{ asset('images/donasi.svg') }}" alt="Kotak Donasi"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
