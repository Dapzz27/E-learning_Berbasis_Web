<x-layouts.siswa title="Profil Saya">

    <div x-data="{
            showDeleteModal:false
        }">

        @if(session('success'))
            <div class="max-w-xl mx-auto mb-4">
                <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-xl mx-auto mb-4">
                <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div class="max-w-xl mx-auto bg-white rounded-2xl shadow p-8 mt-6">

            <div class="flex flex-col items-center gap-4">

                @if($user->foto)
                    <img src="{{ asset('uploads/profiles/' . $user->foto) }}"
                        class="w-24 h-24 rounded-full object-cover border-4 border-green-400">
                @else
                    <div
                        class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center text-white text-3xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <h2 class="text-xl font-bold text-gray-800">
                    {{ $user->name }}
                </h2>

                <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                    Siswa
                </span>

            </div>

            <div class="mt-6 space-y-3 text-sm text-gray-700">

                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium">Nomor Induk</span>
                    <span>{{ $user->nomor_induk }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium">Status Akun</span>
                    <span class="text-green-600 font-semibold">Aktif</span>
                </div>

            </div>

            <div class="mt-8 flex flex-wrap justify-center gap-3">

                <a href="/editprofil"
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-xl text-sm font-medium transition">
                    ✏️ Edit Profil
                </a>

                <a href="/dashboard-siswa"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-xl text-sm font-medium transition">
                    ← Kembali
                </a>

                <button type="button" @click="showDeleteModal = true"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-xl text-sm font-medium transition">
                    🗑 Hapus Akun
                </button>

            </div>

        </div>

        <!-- MODAL HAPUS AKUN -->
        <div x-show="showDeleteModal" x-transition
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-4" style="display:none;">

            <div @click.away="showDeleteModal = false" class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-md">

                <h2 class="text-lg font-bold text-gray-800">
                    Hapus Akun
                </h2>

                <p class="text-sm text-gray-500 mt-2">
                    Akun yang sudah dihapus tidak dapat dikembalikan lagi.
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

                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700">
                            Ya, Hapus Akun
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-layouts.siswa>