<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portal Login</title>

    @vite('resources/css/app.css')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="min-h-screen bg-[#071739] overflow-hidden flex items-center justify-center">

    <!-- BACKGROUND -->
    <div class="absolute inset-0">

        <div class="absolute top-0 left-0 w-[400px] h-[400px] bg-blue-500/20 blur-3xl rounded-full">
        </div>

        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-indigo-500/20 blur-3xl rounded-full">
        </div>

    </div>

    <!-- LOGIN CARD -->
    <div x-data="{ showPassword:false }" class="relative z-10 w-full max-w-md mx-5">

        <div class="bg-[#13254b]/90 backdrop-blur-xl border border-white/10 rounded-[35px] shadow-2xl p-10">

            <!-- LOGO -->
            <div class="flex justify-center mb-6">

                <div <div class="flex items-center justify-center">
                    <img src="{{ asset('build/assets/LogoSMK.png') }}" class="w-24 mx-auto mb-4">

                </div>

            </div>

            <!-- TITLE -->
            <div class="text-center mb-10">

                <h1 class="text-5xl font-bold text-white mb-3">
                    Portal Login
                </h1>

                <p class="text-blue-100 text-lg">
                    Sistem Monitoring Tugas Siswa
                </p>

            </div>
            <form action="/login" method="POST" class="space-y-7">

                @csrf

                <!-- LOGIN -->
                <div>

                    <label class="block text-blue-100 mb-3 text-sm">
                        NIS / NIP
                    </label>

                    <input type="number" name="nomor_induk" placeholder="NIS / NIP Anda" required
                        class="w-full h-16 px-5 rounded-2xl bg-white/5 border border-white/10 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

                </div>

                <!-- PASSWORD -->
                <div>

                    <label class="block text-blue-100 mb-3 text-sm">
                        Password
                    </label>

                    <div class="relative">

                        <input :type="showPassword ? 'text' : 'password'" name="password"
                            placeholder="Masukkan password"
                            class="w-full h-16 px-5 pr-16 rounded-2xl bg-white/5 border border-white/10 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

                        <!-- BUTTON -->
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition">

                            <span x-show="!showPassword">
                                👁️
                            </span>

                            <span x-show="showPassword">
                                🙈
                            </span>

                        </button>

                    </div>

                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full h-16 rounded-2xl bg-blue-600 hover:bg-blue-700 transition text-white text-lg font-semibold shadow-lg shadow-blue-900/40">

                    Masuk Ke Portal

                </button>

                <div class="text-center mt-6">

                    <a href="/register" class="text-blue-400 hover:text-blue-300">

                        Belum punya akun? Register

                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>