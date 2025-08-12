@include('layouts.head')

<div class="flex min-h-screen bg-gray-50">
    @include('layouts.partials.sidebar-guest')

    <main class="w-full lg:w-3/4 p-8 lg:p-20 overflow-y-auto">
        <section>
            @yield('content')
        </section>
    </main>

</div>
@include('components.footer')
