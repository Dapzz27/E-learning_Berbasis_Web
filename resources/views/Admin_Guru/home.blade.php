<x-layouts.guru title="Dashboard Guru">

    <div class="space-y-5">

        <!-- SUMMARY -->
        <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-4">

            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Kelas Aktif</p>
                        <h2 class="text-3xl font-bold text-blue-900">-</h2>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-lg">🏫</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Siswa</p>
                        <h2 class="text-3xl font-bold text-green-500">-</h2>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center text-lg">🧑‍🎓</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Tugas Aktif</p>
                        <h2 class="text-3xl font-bold text-orange-500">-</h2>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-lg">📝</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Terlambat</p>
                        <h2 class="text-3xl font-bold text-red-500">-</h2>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-lg">⏰</div>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

            <!-- LEFT -->
            <div class="xl:col-span-2 space-y-5">

                <!-- AKTIVITAS TUGAS -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-base font-bold text-gray-800">Aktivitas Tugas</h2>
                        <button class="text-blue-600 text-xs font-medium hover:underline">Lihat Semua</button>
                    </div>
                    <div class="py-8 flex flex-col items-center justify-center text-center">
                        <div class="text-3xl mb-2">📂</div>
                        <h3 class="text-sm font-semibold text-gray-700">Belum Ada Aktivitas Tugas</h3>
                        <p class="text-gray-400 text-xs mt-1">Data akan muncul setelah siswa mengumpulkan tugas</p>
                    </div>
                </div>

                <!-- AKTIVITAS TERBARU -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-base font-bold text-gray-800">Aktivitas Terbaru</h2>
                        <button class="text-blue-600 text-xs font-medium hover:underline">Lihat Semua</button>
                    </div>
                    <div class="py-6 flex flex-col items-center justify-center text-center">
                        <div class="text-3xl mb-2">📝</div>
                        <h3 class="text-sm font-semibold text-gray-700">Belum Ada Aktivitas</h3>
                        <p class="text-gray-400 text-xs mt-1">Aktivitas siswa akan tampil disini</p>
                    </div>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="space-y-5">

                <!-- KALENDER -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                    <h2 class="text-base font-bold mb-4">Kalender</h2>
                    <div class="grid grid-cols-7 gap-1 text-center text-xs">
                        <template x-for="day in ['S','S','R','K','J','S','M']">
                            <div class="font-semibold text-gray-400 pb-1" x-text="day"></div>
                        </template>
                        <template x-for="date in 31">
                            <div class="aspect-square flex items-center justify-center rounded-lg hover:bg-blue-100 cursor-pointer transition text-gray-600">
                                <span x-text="date"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- MY COURSE -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-base font-bold">My Course</h2>
                        <button class="text-blue-600 text-xs font-medium hover:underline">Lihat Semua</button>
                    </div>
                    <div class="py-8 flex flex-col items-center justify-center text-center">
                        <div class="text-3xl mb-2">📚</div>
                        <h3 class="text-sm font-semibold text-gray-700">Belum Ada Course</h3>
                        <p class="text-gray-400 text-xs mt-1">Course akan muncul setelah admin membuat kelas</p>
                    </div>
                </div>

            </div>

        </div>

    </div>

</x-layouts.guru>