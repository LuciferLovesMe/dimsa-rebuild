@include('layouts.head')

{{-- Layout utama dengan Flexbox --}}
<div class="flex min-h-screen bg-gray-50">

    {{-- 1. Sidebar --}}
    <aside class="w-1/4 bg-white p-8 border-r border-gray-200 hidden lg:block">
        {{-- Tombol Kembali --}}
        <a href="#"
            class="mt-5 mb-10 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
            Kembali ke beranda
        </a>

        {{-- Menu Navigasi Sidebar --}}
        <nav class="space-y-2">
            <a href="#" class="block px-4 py-2 text-sm font-bold text-blue-600 bg-blue-50 rounded-lg">
                Selayang Pandang
            </a>
            <a href="#"
                class="block px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 rounded-lg">
                Sejarah Pondok
            </a>
            <a href="#"
                class="block px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 rounded-lg">
                Visi & Misi
            </a>
            <a href="#"
                class="block px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 rounded-lg">
                Struktur Organisasi
            </a>
            <a href="#"
                class="block px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 rounded-lg">
                Akreditasi
            </a>
            <a href="#"
                class="block px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 rounded-lg">
                Logo & Brand
            </a>
        </nav>
    </aside>

    {{-- 2. Konten Utama --}}
    <main class="w-full lg:w-3/4 p-8 lg:p-12 overflow-y-auto">
        <section>
            <div class="flex flex-col">

                <div class="flex justify-center mb-8">
                    <img src="https://placehold.co/1200x300/e2e8f0/334155?text=Foto+Mudir"
                        alt="Placeholder Selayang Pandang" class="w-full rounded-lg shadow-md">
                </div>
                <h1 class="text-4xl font-bold text-gray-900">Selayang Pandang</h1>
                <div class="flex flex-col gap-y-5 text-justify mt-5 text-md text-gray-700 leading-relaxed">
                    <p>Pondok Darul Ihsan Muhammadiyah Sragen atau biasa disebut Dimsa, adalah pondok pesantren yang
                        memiliki
                        visi
                        mewujudkan kader persyarikatan dan umat, yang Islami, berprestasi, terampil dan berjiwa
                        leadership serta
                        berwawasan global. Dimsa adalah salah satu wadah Pendidikan yang berada dalam pengawasan Majelis
                        Dikdasmen
                        Pimpinan Daerah Sragen. Dimsa memiliki jenjang Pendidikan Tingkat SMP dan MA, yang mewajibkan
                        semua
                        santrinya
                        berasrama, dengan gedung dan fasilitas yang lengkap dan memadai serta didampingi oleh para
                        asatidz yang
                        loyal
                        dan profesional.</p>
                    <p>Untuk mewujudkan visi besar diatas, maka serangkaian program kegiatan telah dirancang untuk
                        menempa para
                        santri,
                        agar menjadi kader persyarikatan, kader umat dan kader bangsa. Seluruh aktivitas yang ada di
                        pesantren
                        ini
                        adalah Pendidikan, mulai dari ibadahnya, sekolahnya, di asramanya dan organisasinya terprogram,
                        terarah
                        dan
                        terbimbing, sehingga akan menjadikan kader yang berkualitas handal dan tangguh.</p>
                </div>
            </div>
            <hr class="my-10 border-t-2 border-gray-200">
            <div class="flex flex-col items-end">
                <h1 class="text-xl font-bold">Sejarah Pondok</h1>
                <a href="#" class="text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                        class="fa-solid fa-arrow-right ml-2"></i></a>
            </div>
        </section>
    </main>

</div>

@include('components.footer')
