<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    @vite('resources/css/app.css')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="bg-gradient-to-br from-[#0f172a] to-[#1e3a8a] min-h-screen flex items-center justify-center p-5">

    <div class="w-full max-w-md bg-[#1e293b] rounded-3xl p-8 shadow-2xl border border-slate-700">

        <!-- LOGO -->
        <div class="text-center mb-8">

            <img src="{{ asset('build/assets/LogoSMK.png') }}" class="w-24 mx-auto mb-4">

            <h1 class="text-4xl font-bold text-white">
                Portal Register
            </h1>

            <p class="text-slate-400 mt-2">
                Buat akun LMS
            </p>

        </div>

        <!-- FORM -->
        <form action="/register" method="POST" class="space-y-5">

            @csrf

            <!-- NAMA -->
            <div>

                <label class="text-slate-300 block mb-2">
                    Nama Lengkap
                </label>

                <input type="text" name="name" placeholder="Masukkan Nama lengkap" required
                    class="w-full bg-slate-800 border border-slate-600 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-blue-500">

            </div>

            <!-- USERNAME -->
            <div>

                <label class="text-slate-300 block mb-2">
                    NIS / NIP
                </label>

                <input type="number" name="nomor_induk" placeholder="NIS / NIP" required
                    class="w-full bg-slate-800 border border-slate-600 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-blue-500">

            </div>

            <!-- PASSWORD -->
            <div>

                <label class="text-slate-300 block mb-2">
                    Password
                </label>

                <input type="password" name="password" placeholder="Masukkan password" required
                    class="w-full bg-slate-800 border border-slate-600 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-blue-500">

            </div>

            <!-- ROLE -->
            <div>

                <label class="text-slate-300 block mb-2">
                    Role
                </label>

                <select name="role"
                    class="w-full bg-slate-800 border border-slate-600 rounded-2xl px-5 py-4 text-white">

                    <option value="0">
                        Siswa
                    </option>

                    <option value="1">
                        Guru
                    </option>

                </select>

            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 transition rounded-2xl py-4 text-white font-bold text-lg">

                Register

            </button>

        </form>

        <!-- LOGIN -->
        <div class="text-center mt-6">

            <a href="/login" class="text-blue-400 hover:text-blue-300">

                Sudah punya akun? Login

            </a>

        </div>

    </div>

</body>

</html>