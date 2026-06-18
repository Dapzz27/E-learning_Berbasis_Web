<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed lg:static z-50 w-60 bg-[#172554] text-white
           min-h-screen transition-all duration-300
           lg:translate-x-0 shadow-xl">
    <!-- LOGO -->
    <div class="px-6 py-5 border-b border-blue-800/50">
        <h1 class="text-3xl font-bold tracking-tight">EduLMS</h1>
        <p class="text-xs text-blue-200 mt-1">Learning Management System</p>
    </div>

    <!-- MENU -->
    <nav class="mt-6 px-4 space-y-2">
        @php
            $active = 'bg-blue-500 text-white shadow-md';
            $normal = 'text-blue-100 hover:bg-blue-800/60 hover:text-white transition';
        @endphp

        <a href="/dashboard-siswa" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   {{ request()->is('dashboard-siswa') ? $active : $normal }}">
            🏠 Dashboard
        </a>

        <a href="/kelas-siswa" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   {{ request()->is('kelas-siswa') ? $active : $normal }}">
            📚 Kelas
        </a>

        <a href="/pengumuman" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   {{ request()->is('pengumuman') ? $active : $normal }}">
            📢 Pengumuman
        </a>

        <a href="/nilai" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   {{ request()->is('nilai') ? $active : $normal }}">
            📊 Nilai
        </a>
    </nav>
</aside>