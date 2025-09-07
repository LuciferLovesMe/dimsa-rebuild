@extends('layouts.profle-layout')
@section('title', 'Visi Misi')
@section('content')
    <div x-data="{ activeTab: 'smp' }">
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold"
            x-text="activeTab === 'smp' ? 'Visi & Misi SMP' : 'Visi & Misi MA'"></h1>
        <div class="flex border-b border-gray-200 mt-6">
            <button @click="activeTab = 'smp'"
                :class="{ 'border-blue-600 text-blue-600 font-semibold': activeTab === 'smp', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'smp' }"
                class="px-4 py-3 -mb-px border-b-2 text-xs md:text-sm transition-colors duration-200 focus:outline-none">
                SMP
            </button>
            <button @click="activeTab = 'ma'"
                :class="{ 'border-blue-600 text-blue-600 font-semibold': activeTab === 'ma', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'ma' }"
                class="px-4 py-3 -mb-px border-b-2 text-xs md:text-sm transition-colors duration-200 focus:outline-none">
                MA
            </button>
        </div>

        <div x-show="activeTab === 'smp'" x-transition:enter.duration.300ms class="pt-8">
            <div class="flex flex-col gap-y-2">
                <h2 class="text-lg md:text-xl lg:text-2xl font-semibold">Visi Sekolah</h2>
                <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Terbentuknya kader
                    Muhammadiyah yang Islami, Berprestasi,
                    dan Terampil</p>
            </div>

            <div class="flex flex-col gap-y-4 mt-8">
                <h2 class="text-lg md:text-xl lg:text-2xl font-semibold">Misi Sekolah</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 md:grid-rows-2 gap-x-8 gap-y-6 mt-2">
                    <div class="flex items-start gap-x-4">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">01</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Membudayakan dan
                            membiasakan hidup Islami kepada
                            Warga Sekolah.</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:row-start-2">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">02</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Mewujudkan
                            pembelajaran yang aktif, inovatif,
                            kreatif, edukatif, menyenangkan serta integratif.</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:col-start-2 md:row-start-1">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">03</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Membina dan
                            memperdalam bidang akademik dan
                            keagamaan sehingga berilmu pengetahuan luas dan berprestasi unggul.</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:col-start-2 md:row-start-2">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">04</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Mengembangkan
                            ketrampilan dalam Teknologi
                            Informasi, Komputer, Seni Baca Al-Qur’an, Seni berpidato dan Berorganisasi.</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-y-4 mt-8">
                <h2 class="text-lg md:text-xl lg:text-2xl font-semibold">Tujuan Sekolah</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 md:grid-rows-3 gap-x-8 gap-y-6 mt-2">
                    <div class="flex items-start gap-x-4">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">01</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Menghasilkan
                            santri yang berakidah lurus,
                            berakhlakul karimah, serta beribadah yang benar berdasarkan Al-Qur’an dan As-Sunnah.</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:row-start-2">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">02</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Menyiapkan santri
                            yang memiliki kepribadian Islam
                            yang mantap, dan mampu menjadi kader dakwah Muhammadiyah.</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:row-start-3">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">03</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Terwujudnya
                            proses pembelajaran yang aktif,
                            inovatif, kreatif, edukatif, menyenangkan dan integratif.</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:col-start-2 md:row-start-1">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">04</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Menghasilkan
                            santri yang berilmu pengetahuan
                            luas, berprestasi dan mampu bersaing untuk melanjutkan ke jenjang pendidikan yang lebih tinggi.
                        </p>
                    </div>
                    <div class="flex items-start gap-x-4 md:col-start-2 md:row-start-2">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">05</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Menyiapkan santri
                            yang mampu menjadi pelopor
                            pelangsung dan penyempurna nilai-nilai Islam khususnya melalui pengalaman berorganisasi di ortom
                            Muhammadiyah.</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:col-start-2 md:row-start-3">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">06</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Membekali santri
                            dengan berbagai keterampilan
                            seperti bahasa, komputer, seni baca Al-Qur’an dan jurnalistik</p>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="activeTab === 'ma'" x-transition:enter.duration.300ms class="pt-8">
            <div class="flex flex-col gap-y-2">
                <h2 class="text-lg md:text-xl lg:text-2xl font-semibold">Visi Sekolah</h2>
                <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Mencetak kader Ulama
                    Muhammadiyah yang Bertaqwa, Berjiwa
                    Leadership dan Berwawasan Global.</p>
            </div>

            <div class="flex flex-col gap-y-4 mt-8">
                <h2 class="text-lg md:text-xl lg:text-2xl font-semibold">Misi Sekolah</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 md:grid-rows-3 gap-x-8 gap-y-6 mt-2">
                    <div class="flex items-start gap-x-4">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">01</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Membentuk
                            karakter siswa yang sesuai dengan al
                            Qur’an dan as Sunnah</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:row-start-2">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">02</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Membentuk kader
                            persyarikatan yang siap menjadi
                            pemimpin</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:row-start-3">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">03</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Mengembangkan
                            potensi akademik dan non akademik
                            siswa</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:col-start-2 md:row-start-1">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">04</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Menjamin tenaga
                            pendidik yang profesional dan
                            inovatif</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:col-start-2 md:row-start-2">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">05</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Memfasilitasi
                            sarana dan prasarana pendidikan
                            yang berkualitas dan nyaman</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:col-start-2 md:row-start-3">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">06</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Mewujudkan
                            pembelajaran yang menggembirakan dan
                            berkemajuan</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-y-4 mt-8">
                <h2 class="text-lg md:text-xl lg:text-2xl font-semibold">Tujuan Sekolah</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 md:grid-rows-3 gap-x-8 gap-y-6 mt-2">
                    <div class="flex items-start gap-x-4">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">01</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Menghasilkan
                            Generasi yang berkualitas untuk
                            memperoleh prestasi akademik maupun non akademik.</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:row-start-2">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">02</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Menghasilkan
                            generasi yang disiplin dalam belajar
                            sehingga memperoleh prestasi yang optimal.</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:row-start-3">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">03</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Menghasilkan
                            generasi muda yang memiliki life
                            skill sebagai bekal hidup mandiri.</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:col-start-2 md:row-start-1">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">04</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Menghasilkan
                            generasi muda yang berperilaku
                            islami dan berakhlak mulia baik di lingkungan madrasah maupun lingkungan masyarakat.</p>
                    </div>
                    <div class="flex items-start gap-x-4 md:col-start-2 md:row-start-2">
                        <span class="text-xl md:text-2xl font-bold text-blue-600/80">05</span>
                        <p class="text-left md:text-justify text-gray-700 text-sm md:text-base lg:text-lg">Menghasilkan
                            budaya Himmatu at Ta’allum,
                            Leadership dan Uswah Hasnah di lingkungan Madrasah</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-10 border-t-2 border-gray-200">
    <div class="flex flex-row justify-between md:flex-row lg:justify-between">
        <div class="flex flex-col cursor-pointer md:w-1/2 lg:w-auto lg:mr-10"
            onclick="location.href='{{ route('guest.sejarah-pondok') }}'">
            <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800"><i
                    class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
            <h1 class="font-bold text-sm md:text-base lg:text-lg">Sejarah Pondok</h1>
        </div>
        <div class="flex flex-col items-end cursor-pointer md:w-1/2 lg:w-auto lg:ml-10"
            onclick="location.href='{{ route('guest.struktur-organisasi') }}'">
            <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                    class="fa-solid fa-arrow-right ml-2"></i></p>
            <h1 class="font-bold text-sm md:text-base lg:text-lg">Struktur Organisasi</h1>
        </div>
    </div>
@endsection
