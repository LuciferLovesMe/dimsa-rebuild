@extends('layouts.app')

@section('title', 'DIMSA - ' . $program['heroTitle'])

@section('content')
    {{-- Hero Section --}}
    <div class="relative h-screen bg-cover bg-center" style="background-image: url('{{ $program['heroImage'] }}');">
        <div class="absolute inset-0 bg-black opacity-75"></div>
        <div class="relative h-full flex items-center justify-start p-4 sm:p-8 lg:p-20">
            <div class="w-full max-w-md md:max-w-xl lg:max-w-2xl">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">
                    {{ $program['heroTitle'] }}
                </h1>
                <p class="mt-5 text-base md:text-lg text-white leading-relaxed text-justify">
                    {{ $program['heroDesc'] }}
                </p>
            </div>
        </div>
    </div>

    {{-- YouTube Video Section --}}
    <div class="bg-gray-100 py-12 md:py-20 px-4 sm:p-8 lg:p-20">
        <div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center mb-8">{{ $program['videoTitle'] }}
            </h2>
            <div class="relative rounded-lg overflow-hidden shadow-xl" style="padding-top: 56.25%;">
                @if ($program['videoUrl'])
                    <iframe src="{{ $program['videoUrl'] }}" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen class="absolute top-0 left-0 w-full h-full">
                    </iframe>
                @else
                    <div class="absolute top-0 left-0 w-full h-full bg-gray-300 flex items-center justify-center">
                        <div class="text-center text-gray-500">
                            <svg class="mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a 9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-2 text-sm font-medium">Video Belum Tersedia</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('components.footer')
@endsection
