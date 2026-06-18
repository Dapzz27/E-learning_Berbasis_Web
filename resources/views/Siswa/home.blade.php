<x-layouts.siswa title="Dashboard Siswa">

    <!-- SUMMARY -->
    <div class="grid grid-cols-2 xl:grid-cols-4 gap-3">

        <div class="bg-white rounded-xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs text-gray-500">Kelas Diikuti</p>
                    <h2 class="text-2xl font-bold text-blue-600 mt-1">3</h2>
                </div>
                <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center">📚</div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs text-gray-500">Tugas Aktif</p>
                    <h2 class="text-2xl font-bold text-orange-500 mt-1">5</h2>
                </div>
                <div class="w-9 h-9 rounded-lg bg-orange-50 flex items-center justify-center">📝</div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs text-gray-500">Tugas Selesai</p>
                    <h2 class="text-2xl font-bold text-green-500 mt-1">12</h2>
                </div>
                <div class="w-9 h-9 rounded-lg bg-green-50 flex items-center justify-center">✅</div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs text-gray-500">Deadline Dekat</p>
                    <h2 class="text-2xl font-bold text-red-500 mt-1">2</h2>
                </div>
                <div class="w-9 h-9 rounded-lg bg-red-50 flex items-center justify-center">⏰</div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 mt-5">

        <!-- LEFT -->
        <div class="xl:col-span-2 space-y-5">

            <!-- KELAS -->
            <div class="grid md:grid-cols-3 gap-3">
                <div
                    class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-lg transition duration-300">
                    <div class="text-3xl mb-3">💻</div>
                    <span class="text-xs font-medium text-blue-500">Mata Kuliah</span>
                    <h4 class="font-semibold text-gray-800 mt-1">Pemrograman Web</h4>
                    <p class="text-sm text-gray-500 mt-1">Pak Budi Santoso</p>
                </div>
                <div
                    class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-lg transition duration-300">
                    <div class="text-3xl mb-3">🗄️</div>
                    <span class="text-xs font-medium text-purple-500">Mata Kuliah</span>
                    <h4 class="font-semibold text-gray-800 mt-1">Basis Data</h4>
                    <p class="text-sm text-gray-500 mt-1">Pak Bayu Setiawan</p>
                </div>
                <div
                    class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-lg transition duration-300">
                    <div class="text-3xl mb-3">🎨</div>
                    <span class="text-xs font-medium text-pink-500">Mata Kuliah</span>
                    <h4 class="font-semibold text-gray-800 mt-1">UI / UX Design</h4>
                    <p class="text-sm text-gray-500 mt-1">Bu Santi Maharani</p>
                </div>
            </div>

            <!-- DEADLINE -->
            <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-5">
                    <h2 class="text-xl font-bold">Deadline Terdekat</h2>
                    <a href="#" class="text-blue-600 text-sm font-medium">Lihat Semua</a>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between border-b border-gray-100 pb-3">
                        <div>
                            <h3 class="font-medium">Membuat ERD Database</h3>
                            <p class="text-sm text-gray-500">Basis Data</p>
                        </div>
                        <span class="text-red-500 font-medium">2 Hari Lagi</span>
                    </div>
                    <div class="flex justify-between pb-1">
                        <div>
                            <h3 class="font-medium">CRUD Laravel</h3>
                            <p class="text-sm text-gray-500">Pemrograman Web</p>
                        </div>
                        <span class="text-orange-500 font-medium">5 Hari Lagi</span>
                    </div>
                </div>
            </div>

            <!-- PENGUMUMAN -->
            <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Pengumuman</h2>
                    <span class="text-xs px-3 py-1 bg-gray-100 rounded-full text-gray-500">Belum Ada</span>
                </div>
                <div
                    class="border-2 border-dashed border-gray-200 rounded-xl py-10 flex flex-col items-center justify-center">
                    <div class="text-4xl mb-3">📢</div>
                    <h3 class="font-medium text-gray-600">Belum ada pengumuman</h3>
                    <p class="text-sm text-gray-400 mt-1">Pengumuman dari guru akan tampil di sini.</p>
                </div>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="space-y-5">

            <!-- KALENDER -->
            <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold mb-4">Kalender</h2>
                <div class="grid grid-cols-7 gap-2 text-center text-sm">
                    <template x-for="day in ['S','S','R','K','J','S','M']">
                        <div class="font-medium text-gray-400" x-text="day"></div>
                    </template>
                    <template x-for="date in 31">
                        <div
                            class="h-8 flex items-center justify-center hover:bg-blue-50 rounded-lg cursor-pointer transition">
                            <span x-text="date"></span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- PROGRESS -->
            <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold mb-5">Progress Belajar</h2>
                <div class="flex flex-col items-center">
                    <div class="w-28 h-28 rounded-full border-[10px] border-green-500 flex items-center justify-center">
                        <span class="text-2xl font-bold">68%</span>
                    </div>
                    <p class="mt-4 text-center text-gray-600">
                        Kamu telah menyelesaikan <b>17 dari 25 tugas</b>
                    </p>
                    <div class="w-full mt-5">
                        <div class="w-full bg-gray-100 h-2 rounded-full">
                            <div class="bg-green-500 h-2 rounded-full w-[68%]"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</x-layouts.siswa>