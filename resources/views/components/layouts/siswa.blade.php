<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - EduLMS</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.12/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-[#f5f7fb]">
    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

        <!-- OVERLAY MOBILE -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/40 z-40 lg:hidden">
        </div>

        <!-- SIDEBAR -->
        <x-siswa.sidebar />

        <!-- MAIN -->
        <main class="flex-1 min-w-0">
            <x-siswa.topbar :title="$title ?? 'Dashboard Siswa'" />
            <section class="p-5 lg:p-6">
                {{ $slot }}
            </section>
        </main>

    </div>
</body>

</html>