<!-- Footer -->
<footer class="bg-[#080E1E] px-20 text-white font-sans ">
    <div class="container px-4 lg:px-8">
        <div class="pt-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">

                <!-- Kolom Kiri: Brand dan Info Kontak -->
                <div class="md:col-span-8 lg:col-span-9">
                    <img src="{{ asset('images/dimsa_white.png') }}" alt="Logo DIMSA" class="py-3 mb-4 w-20">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Informasi Kontak -->
                        <div>
                            <h5 class="font-bold text-lg mb-2">Informasi kontak</h5>
                            <p class="flex items-center text-gray-400 mb-2">
                                <i class="fa-solid fa-phone mr-2"></i>
                                0822 9822 2200 (Call Center)
                            </p>
                            <p class="flex items-center text-gray-400">
                                <i class="fa-solid fa-envelope mr-2"></i>
                                pondokdarulihsan@gmail.com
                            </p>
                        </div>
                        <!-- Alamat -->
                        <div>
                            <h5 class="font-bold text-lg mb-2">Alamat</h5>
                            <p class="flex items-start text-gray-400">
                                <i class="fa-solid fa-location-dot mr-2"></i>
                                Karang Tengah, Kabupaten Sragen, Jawa Tengah
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Sosial Media dan Kontak -->
                <div class="md:col-span-4 lg:col-span-3">
                    <h5 class="font-bold text-lg pt-3 mb-4">Sosial media</h5>
                    <!-- Ikon Sosial Media -->
                    <div class="flex gap-4 my-4 mb-5">
                        <a href="https://www.facebook.com/profile.php?id=100006142277425" target="_blank"
                            class="p-2 border border-white rounded-full flex items-center justify-center shadow-md hover:bg-white/10 transition-colors">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/" target="_blank"
                            class="p-2 border border-white rounded-full flex items-center justify-center shadow-md hover:bg-white/10 transition-colors">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/" target="_blank"
                            class="p-2 border border-white rounded-full flex items-center justify-center shadow-md hover:bg-white/10 transition-colors">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="https://www.tiktok.com/@dimsatv" target="_blank"
                            class="p-2 border border-white rounded-full flex items-center justify-center shadow-md hover:bg-white/10 transition-colors">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                        <a href="https://www.x.com/" target="_blank"
                            class="p-2 border border-white rounded-full flex items-center justify-center shadow-md hover:bg-white/10 transition-colors">
                            <i class="fa-brands fa-x"></i>
                        </a>
                    </div>
                    <!-- Tombol Kontak -->
                    <a href="https://wa.me/6282298222200" target="_blank"
                        class="w-full bg-white text-gray-900 font-bold py-3 px-4 rounded-lg flex items-center justify-center hover:bg-gray-200 transition-colors">
                        <i class="fa-brands fa-whatsapp mr-2"></i>
                        Kontak Kami
                    </a>
                </div>

            </div>
        </div>

        <!-- Copyright -->
        <div class="text-gray-500 font-medium text-center border-t border-gray-700 mt-4 py-3">
            <p class="mb-0">Copyright &copy; {{ date('Y') }} | Ponpes Darul Ihsan Muhammadiyah Sragen</p>
        </div>
    </div>
</footer>
