@extends('layouts.profle-layout')
@section('title', 'Selayang Pandang')
@section('content')
    <div class="flex flex-col">

        <div class="flex justify-center mb-8">
            <img src="{{ asset('images/pimpinan.webp') }}" alt="Placeholder Selayang Pandang"
                class="w-full h-[600px] object-cover rounded-lg shadow-md">
        </div>
        <h1 class="font-bold text-2xl md:text-4xl text-gray-900">Selayang Pandang</h1>
        <div class="flex flex-col gap-y-5 text-justify mt-5 text-sm md:text-base lg:text-lg text-gray-600 leading-relaxed">
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
    <div class="flex flex-row justify-end">
        <div class="flex flex-col cursor-pointer items-end" onclick="location.href='{{ route('sejarah-pondok') }}'">
            <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                    class="fa-solid fa-arrow-right ml-2"></i></p>
            <h1 class="font-bold text-lg md:text-xl">Sejarah Pondok</h1>
        </div>
    </div>
@endsection
