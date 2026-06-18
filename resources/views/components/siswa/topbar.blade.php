@props(['title' => 'Dashboard Siswa'])

<header class="bg-white border-b border-gray-100 h-20 px-6
               flex items-center justify-between sticky top-0 z-30">

    <!-- LEFT -->
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true" class="lg:hidden bg-gray-100 hover:bg-gray-200 p-2 rounded-lg">
            ☰
        </button>
        <h2 class="text-xl font-bold text-gray-800">{{ $title }}</h2>
    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-4">

        <!-- NOTIFIKASI -->
        <a href="/notifikasi-siswa" class="relative">
            <div class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full
                        flex items-center justify-center transition">
                🔔
            </div>
            <span class="absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1
                         bg-red-500 text-white text-[10px] rounded-full
                         flex items-center justify-center">
                0
            </span>
        </a>

        <!-- PROFILE DROPDOWN -->
        <div x-data="{ open: false }" class="relative">

            <button @click="open = !open"
                class="flex items-center gap-3 hover:bg-gray-50 px-3 py-2 rounded-xl transition">

                @if(session('foto'))
                    <img src="{{ asset('uploads/profiles/' . session('foto')) }}"
                        class="w-11 h-11 rounded-full object-cover border border-gray-200">
                @else
                    <div class="w-11 h-11 bg-green-500 rounded-full flex items-center
                                    justify-center text-white font-semibold">
                        {{ strtoupper(substr(session('name', 'S'), 0, 1)) }}
                    </div>
                @endif

                <div class="hidden md:block text-left">
                    <h3 class="font-semibold text-gray-800 text-sm">{{ session('name') }}</h3>
                    <p class="text-xs text-gray-500">Siswa</p>
                </div>

            </button>

            <!-- DROPDOWN -->
            <div x-show="open" @click.outside="open = false" x-transition x-cloak class="absolute right-0 mt-3 w-52 bg-white rounded-xl shadow-lg
                       border border-gray-100 overflow-hidden z-50">

                <a href="/profil" class="block px-4 py-3 hover:bg-gray-50 text-sm text-gray-700">
                    👤 Lihat Profil
                </a>
                <a href="/editprofil" class="block px-4 py-3 hover:bg-gray-50 text-sm text-gray-700">
                    ✏️ Edit Profil
                </a>
                <hr>
                <a href="/logout" class="block px-4 py-3 hover:bg-red-50 text-sm text-red-500">
                    🚪 Logout
                </a>

            </div>
        </div>

    </div>
</header>