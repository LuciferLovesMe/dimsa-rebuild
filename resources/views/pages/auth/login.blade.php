@include('layouts.head')

<body class="font-sans bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('images/login_bg.webp') }}');">

    <div class="flex min-h-screen">

        <div class="hidden lg:flex w-1/2 items-center justify-center bg-cover bg-center p-12">
            <div class="text-center">
                <img src="{{ asset('images/dimsa_white.png') }}" alt="Logo DIMSA" class="mx-auto w-80">
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-6">
            <div class="w-full max-w-md">

                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <img src="{{ asset('images/dimsa_white.png') }}" alt="Logo DIMSA Mobile" class="mx-auto w-40">
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <h2 class="text-2xl font-semibold text-gray-900">Selamat Datang di Darul Ihsan Muhammadiyah Sragen👋
                    </h2>

                    <!-- Login Form -->
                    <form class="mt-8 space-y-6" action="#" method="POST">
                        <!-- Username Input -->
                        <div class="text-sm">
                            <label for="username" class="block text-xs font-medium text-gray-700">Username</label>
                            <div class="mt-1">
                                <input id="username" name="email" type="text" required placeholder="Username"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <!-- Password Input with Toggle -->
                        <div x-data="{ showPassword: false }" class="text-sm">
                            <label for="password" class="block text-xs font-medium text-gray-700">Password</label>
                            <div class="mt-1 relative">
                                <input id="password" name="password" :type="showPassword ? 'text' : 'password'"
                                    required placeholder="Password"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-500">
                                    <svg x-show="!showPassword" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showPassword" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                        style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Login
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
