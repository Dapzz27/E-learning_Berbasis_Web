@props(['title' => 'Dashboard Guru'])

<header class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-gray-100
               h-16 px-6 flex items-center justify-between">

    <!-- LEFT -->
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true" class="lg:hidden bg-gray-100 hover:bg-gray-200 p-2 rounded-lg">
            ☰
        </button>
        <h2 class="text-xl font-bold text-gray-800">{{ $title }}</h2>
    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-4">

        <!-- NOTIF -->
        <a href="/notifikasi" class="relative">
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
                class="flex items-center gap-3 hover:bg-gray-100 px-3 py-2 rounded-xl transition">

                @if(session('foto'))
                    <img src="{{ asset('uploads/profiles/' . session('foto')) }}"
                        class="w-10 h-10 rounded-full object-cover border border-gray-200">
                @else
                    <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center
                                    justify-center text-white text-sm font-semibold">
                        {{ strtoupper(substr(session('name', 'G'), 0, 1)) }}
                    </div>
                @endif

                <div class="text-left hidden md:block">
                    <h3 class="font-semibold text-sm text-gray-800">{{ session('name') }}</h3>
                    <p class="text-xs text-gray-500">Guru</p>
                </div>
            </button>

            <!-- DROPDOWN -->
            <div x-show="open" @click.outside="open = false" x-transition x-cloak class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl
                       border border-gray-100 overflow-hidden z-50">
                <a href="/profil" class="block px-5 py-4 hover:bg-gray-50 text-gray-700 transition">
                    👤 Lihat Profil
                </a>
                <a href="/editprofil" class="block px-5 py-4 hover:bg-gray-50 text-gray-700 transition">
                    ✏️ Edit Profil
                </a>
                <hr>
                <a href="/logout" class="block px-5 py-4 hover:bg-red-50 text-red-500 transition">
                    🚪 Logout
                </a>
            </div>
        </div>

    </div>
</header>