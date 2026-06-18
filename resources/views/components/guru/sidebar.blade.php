<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed top-0 left-0 z-50 w-64 h-screen bg-[#172554] text-white
           transition-all duration-300 lg:translate-x-0 shadow-xl overflow-y-auto">
    <!-- LOGO -->
    <div class="px-6 py-5 border-b border-blue-800/50">
        <h1 class="text-2xl font-bold tracking-tight">EduLMS</h1>
        <p class="text-xs text-blue-200 mt-1">Learning Management System</p>
    </div>

    <!-- MENU -->
    <nav class="mt-6 px-4 space-y-2">
        @php
            $active = 'bg-blue-500 text-white shadow-md';
            $normal = 'text-blue-100 hover:bg-blue-800/60 hover:text-white transition';
        @endphp

        <a href="/dashboard-guru" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   {{ request()->is('dashboard-guru') ? $active : $normal }}">
            🏠 Dashboard
        </a>

        <a href="/kelas-guru" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   {{ request()->is('kelas-guru') ? $active : $normal }}">
            👨‍🏫 Kelas
        </a>

        <a href="/tugas" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   {{ request()->is('tugas') ? $active : $normal }}">
            📝 Tugas
        </a>

        <a href="/monitoringsiswa" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   {{ request()->is('monitoringsiswa') ? $active : $normal }}">
            📊 Monitoring Siswa
        </a>
    </nav>
</aside>