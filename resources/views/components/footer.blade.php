<!-- Footer -->
<footer class="bg-[#080E1E] text-white font-sans">
    {{-- Padding horizontal diubah agar responsif. Lebih kecil di mobile, lebih besar di desktop. --}}
    <div class="container mx-auto px-6 py-8 md:px-12 lg:px-16">
        <div class="pt-4">
            {{-- Grid utama diubah menjadi 1 kolom di mobile/tablet, dan 12 kolom di layar besar --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Kolom Kiri: Brand dan Info Kontak -->
                {{-- Di layar besar, kolom ini mengambil 8/12 bagian --}}
                <div class="lg:col-span-8">
                    <img src="{{ asset('images/dimsa_white.png') }}" alt="Logo DIMSA" class="py-3 mb-4 w-20">
                    {{-- Grid untuk info kontak dibuat 1 kolom di mobile, dan 2 kolom di layar kecil ke atas --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <!-- Informasi Kontak -->
                        <div>
                            <h5 class="font-bold text-lg mb-3">Informasi kontak</h5>
                            <p class="flex items-center text-gray-400 mb-2 text-sm">
                                <i class="fa-solid fa-phone mr-3 w-4 text-center"></i>
                                0822 9822 2200 (Call Center)
                            </p>
                            <p class="flex items-center text-gray-400 text-sm">
                                <i class="fa-solid fa-envelope mr-3 w-4 text-center"></i>
                                pondokdarulihsan@gmail.com
                            </p>
                        </div>
                        <!-- Alamat -->
                        <div>
                            <h5 class="font-bold text-lg mb-3">Alamat</h5>
                            <p class="flex items-start text-gray-400 text-sm">
                                <i class="fa-solid fa-location-dot mr-3 w-4 text-center mt-1"></i>
                                <span>Karang Tengah, Kabupaten Sragen, Jawa Tengah</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Sosial Media dan Kontak -->
                {{-- Di layar besar, kolom ini mengambil 4/12 bagian --}}
                <div class="lg:col-span-4">
                    <h5 class="font-bold text-lg pt-3 mb-4">Sosial media</h5>
                    <!-- Ikon Sosial Media -->
                    <div class="flex gap-4 my-4 mb-5">
                        <a href="https://www.facebook.com/profile.php?id=100006142277425" target="_blank"
                            class="w-10 h-10 border border-white rounded-full flex items-center justify-center shadow-md hover:bg-white/10 transition-colors">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/" target="_blank"
                            class="w-10 h-10 border border-white rounded-full flex items-center justify-center shadow-md hover:bg-white/10 transition-colors">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/" target="_blank"
                            class="w-10 h-10 border border-white rounded-full flex items-center justify-center shadow-md hover:bg-white/10 transition-colors">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="https://www.tiktok.com/@dimsatv" target="_blank"
                            class="w-10 h-10 border border-white rounded-full flex items-center justify-center shadow-md hover:bg-white/10 transition-colors">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                        <a href="https://www.x.com/" target="_blank"
                            class="w-10 h-10 border border-white rounded-full flex items-center justify-center shadow-md hover:bg-white/10 transition-colors">
                            <i class="fa-brands fa-twitter"></i>
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
        <div class="text-gray-500 font-medium text-center border-t border-gray-700 mt-8 pt-6">
            <p class="mb-0 text-sm">Copyright &copy; {{ date('Y') }} | Ponpes Darul Ihsan Muhammadiyah Sragen</p>
        </div>
    </div>
</footer>
