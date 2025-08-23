@extends('pages.guest.program.layout.program-layout')

@section('title', 'DIMSA - Kelas Cyber')

@php
    View::share('heroImage', asset('images/cyber-bg.webp'));
    View::share('heroTitle', 'Kelas Khusus Cyber');
    View::share(
        'heroDesc',
        'Kelas Khusus Cyber di Pondok Pesantren Darul Ihsan Muhammadiyah Sragen adalah salah satu program inovatif yang dirancang untuk memberikan keterampilan teknologi informasi kepada santri di era digital. Program ini meliputi pengenalan komputer dasar, pemrograman, desain grafis, dan pengembangan web, serta keterampilan digital lain yang relevan dengan kebutuhan industri saat ini.',
    );
    View::share('kelasName', 'Kelas Cyber');
    View::share('videoUrl', 'https://www.youtube.com/embed/I1L_KWsHvDs');
@endphp
