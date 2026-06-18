<x-layouts.guru title="Profil" :user="session('name')" :role="session('role')">
    @if(session('success'))
        <div class="max-w-3xl mx-auto mb-4">
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-3xl mx-auto mb-4">
            <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="max-w-3xl mx-auto" x-data="{
        show:false,
        showDeleteModal:false
    }" x-init="setTimeout(() => show = true, 50)">

        <!-- Card utama -->
        <div x-show="show" x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0"
            class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <!-- Header gradient kecil -->
            <div class="relative h-24 bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-600">
                <div class="absolute -bottom-10 left-6">
                    <div class="relative">
                        @if(!empty($user->foto ?? null))
                            <img src="{{ asset('uploads/profiles/' . $user->foto) }}" alt="Foto Profil"
                                class="w-20 h-20 rounded-full object-cover ring-4 ring-white shadow-md">
                        @else
                            <div
                                class="w-20 h-20 rounded-full ring-4 ring-white shadow-md bg-gray-100 flex items-center justify-center text-2xl font-bold text-blue-600">
                                {{ strtoupper(substr($user->name ?? session('name') ?? 'U', 0, 1)) }}
                            </div>
                        @endif
                        <span
                            class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 rounded-full ring-2 ring-white"></span>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="pt-14 px-6 pb-6">

                <div class="flex flex-wrap items-start justify-between gap-3">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">{{ $user->name ?? session('name') }}</h1>
                        <p class="text-gray-400 text-sm mt-0.5">
                            {{ ($user->role ?? session('role')) == 1 ? 'Guru' : 'Siswa' }}
                        </p>
                    </div>
                    <span
                        class="inline-flex items-center gap-1.5 bg-green-50 text-green-600 text-xs font-semibold px-3 py-1.5 rounded-full border border-green-100">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                        Aktif
                    </span>
                </div>

                <!-- Info grid -->
                <div class="grid sm:grid-cols-2 gap-3 mt-6">

                    <div
                        class="bg-gray-50 rounded-xl p-3.5 border border-gray-100 hover:border-blue-200 hover:bg-blue-50/40 transition-colors">
                        <p class="text-[11px] uppercase tracking-wide text-gray-400 font-medium">Nama Lengkap</p>
                        <p class="text-sm font-semibold text-gray-700 mt-1">{{ $user->name ?? session('name') }}</p>
                    </div>

                    <div
                        class="bg-gray-50 rounded-xl p-3.5 border border-gray-100 hover:border-blue-200 hover:bg-blue-50/40 transition-colors">
                        <p class="text-[11px] uppercase tracking-wide text-gray-400 font-medium">
                            {{ ($user->role ?? session('role')) == 1 ? 'NIP' : 'NISN' }}
                        </p>
                        <p class="text-sm font-semibold text-gray-700 mt-1">
                            {{ $user->nomor_induk ?? session('nomor_induk') }}
                        </p>
                    </div>

                    <div
                        class="bg-gray-50 rounded-xl p-3.5 border border-gray-100 hover:border-blue-200 hover:bg-blue-50/40 transition-colors">
                        <p class="text-[11px] uppercase tracking-wide text-gray-400 font-medium">Role</p>
                        <p class="text-sm font-semibold text-gray-700 mt-1">
                            {{ ($user->role ?? session('role')) == 1 ? 'Guru' : 'Siswa' }}
                        </p>
                    </div>

                    <div
                        class="bg-gray-50 rounded-xl p-3.5 border border-gray-100 hover:border-blue-200 hover:bg-blue-50/40 transition-colors">
                        <p class="text-[11px] uppercase tracking-wide text-gray-400 font-medium">Status Akun</p>
                        <p class="text-sm font-semibold text-green-600 mt-1">Aktif</p>
                    </div>

                </div>

                <!-- Actions -->
                <div class="mt-6 flex flex-wrap gap-3">

                    <a href="/editprofil"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 active:scale-[0.98] transition-all shadow-sm shadow-blue-200">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">

                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>

                        </svg>

                        Edit Profil
                    </a>

                    <a href="{{ (session('role') == 1) ? '/dashboard-guru' : '/dashboard-siswa' }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-600 text-sm font-medium rounded-xl hover:bg-gray-200 active:scale-[0.98] transition-all">

                        Kembali
                    </a>

                    <button type="button" @click="showDeleteModal = true"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white text-sm font-medium rounded-xl hover:bg-red-700 transition-all">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7L18.132 19.142A2 2 0 0116.138 21H7.862A2 2 0 015.868 19.142L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
                        </svg>

                        Hapus Akun
                    </button>

                </div>
                <div x-show="showDeleteModal" x-transition
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4" style="display:none;">

                    <div @click.away="showDeleteModal = false"
                        class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">

                        <h2 class="text-lg font-bold text-gray-800">
                            Hapus Akun
                        </h2>

                        <p class="text-sm text-gray-500 mt-2">
                            Akun yang dihapus tidak dapat dikembalikan lagi.
                            Masukkan password untuk melanjutkan.
                        </p>

                        <form action="{{ route('hapus.akun') }}" method="POST" class="mt-5">

                            @csrf

                            <label class="block text-sm font-medium text-gray-700">
                                Password
                            </label>

                            <input type="password" name="password" required placeholder="Masukkan password"
                                class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500">

                            <div class="flex justify-end gap-2 mt-5">

                                <button type="button" @click="showDeleteModal = false"
                                    class="px-4 py-2 bg-gray-100 rounded-xl hover:bg-gray-200">

                                    Batal
                                </button>

                                <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700">

                                    Ya, Hapus Akun
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>

</x-layouts.guru>