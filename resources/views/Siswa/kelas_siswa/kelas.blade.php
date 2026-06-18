<x-layouts.siswa title="Halaman Kelas">

    <div class="p-6">

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="mb-5 bg-green-50 border border-green-200 text-green-700 px-5 py-3 rounded-xl text-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-xl text-sm">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">📚 Kelas Saya</h1>
            <p class="text-gray-500 mt-1">Temukan dan ikuti kelas yang tersedia.</p>

            <div class="relative mt-5 max-w-md">
                <input type="text" id="searchInput" placeholder="Cari kelas..."
                    class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                    oninput="filterKelas()">
                <span class="absolute left-4 top-3.5 text-gray-400">🔍</span>
            </div>
        </div>

        {{-- KELAS DIIKUTI (Riwayat) --}}
        <div class="mb-10">
            <h2 class="text-xl font-bold text-gray-800 mb-5">📖 Kelas Saya</h2>

            @if(isset($riwayat) && count($riwayat) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 kelas-grid">
                    @foreach($riwayat as $item)
                        <div class="kelas-card bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition duration-300"
                             data-nama="{{ strtolower($item->nama_kelas) }} {{ strtolower($item->nama_guru) }}">

                            {{-- COVER --}}
                            <div class="h-36 overflow-hidden bg-gray-100">
                                @if(!empty($item->cover))
                                    <img src="{{ asset('uploads/kelas/' . $item->cover) }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                        <span class="text-white text-3xl font-bold opacity-80">
                                            {{ strtoupper(substr($item->jurusan, 0, 2)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- CONTENT --}}
                            <div class="p-4">
                                <span class="inline-block px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">
                                    {{ $item->jurusan }}
                                </span>
                                <h3 class="mt-2 font-bold text-gray-800 line-clamp-2 min-h-[44px] text-sm">
                                    {{ $item->nama_kelas }}
                                </h3>
                                <p class="text-xs text-gray-500 mt-1">👨‍🏫 {{ $item->nama_guru }}</p>

                                {{-- Sudah bergabung → langsung masuk --}}
                                <a href="/kelas/{{ $item->id }}"
                                    class="mt-4 block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-xl font-semibold text-sm transition">
                                    Masuk Kelas
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-8 text-center border border-dashed border-gray-300">
                    <div class="text-5xl mb-3">📖</div>
                    <h3 class="font-semibold text-gray-700">Belum mengikuti kelas manapun</h3>
                    <p class="text-gray-400 text-sm mt-1">Bergabunglah ke kelas di bawah ini menggunakan password dari guru.</p>
                </div>
            @endif
        </div>

        {{-- KELAS TERSEDIA (Belum diikuti) --}}
        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-1">⭐ Kelas Tersedia</h2>
            <p class="text-gray-400 text-sm mb-5">Klik "Bergabung" dan masukkan password dari guru untuk masuk.</p>

            @if(isset($kelas) && count($kelas) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 kelas-grid">
                    @foreach($kelas as $item)
                        <div class="kelas-card bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition duration-300"
                             data-nama="{{ strtolower($item->nama_kelas) }} {{ strtolower($item->nama_guru) }}">

                            {{-- COVER --}}
                            <div class="h-36 overflow-hidden bg-gray-100">
                                @if(!empty($item->cover))
                                    <img src="{{ asset('uploads/kelas/' . $item->cover) }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-violet-400 to-purple-600 flex items-center justify-center">
                                        <span class="text-white text-3xl font-bold opacity-80">
                                            {{ strtoupper(substr($item->jurusan, 0, 2)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- CONTENT --}}
                            <div class="p-4">
                                <span class="inline-block px-3 py-1 text-xs font-semibold bg-violet-100 text-violet-700 rounded-full">
                                    {{ $item->jurusan }}
                                </span>
                                <h3 class="mt-2 font-bold text-gray-800 line-clamp-2 min-h-[44px] text-sm">
                                    {{ $item->nama_kelas }}
                                </h3>
                                <p class="text-xs text-gray-500 mt-1">👨‍🏫 {{ $item->nama_guru }}</p>

                                {{-- Belum bergabung → buka modal password --}}
                                <button
                                    onclick="bukaModalJoin({{ $item->id }}, '{{ addslashes($item->nama_kelas) }}')"
                                    class="mt-4 w-full text-center bg-violet-600 hover:bg-violet-700 text-white py-2 rounded-xl font-semibold text-sm transition">
                                    🔑 Bergabung
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-8 text-center border border-dashed border-gray-300">
                    <div class="text-5xl mb-3">✅</div>
                    <h3 class="font-semibold text-gray-700">Kamu sudah mengikuti semua kelas yang tersedia</h3>
                </div>
            @endif
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════════════
         MODAL JOIN KELAS (Password)
    ════════════════════════════════════════════════════════ --}}
    <div id="modal-join"
         class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center px-4"
         onclick="tutupModalJika(event)">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 animate-fade-in">

            {{-- Icon --}}
            <div class="flex justify-center mb-4">
                <div class="w-14 h-14 bg-violet-100 rounded-2xl flex items-center justify-center text-3xl">
                    🔑
                </div>
            </div>

            <h3 class="text-center text-lg font-bold text-gray-800 mb-1">Masuk ke Kelas</h3>
            <p id="modal-nama-kelas" class="text-center text-sm text-gray-500 mb-5">—</p>

            <form id="form-join" method="POST" action="">
                @csrf

                {{-- Error password --}}
                @error('password_kelas')
                    <div class="mb-3 bg-red-50 border border-red-200 text-red-600 px-4 py-2 rounded-xl text-sm">
                        {{ $message }}
                    </div>
                @enderror

                <div class="mb-4">
                    <label class="block text-sm text-gray-600 mb-1 font-medium">Password Kelas</label>
                    <div class="relative">
                        <input type="password" name="password_kelas" id="input-password"
                               placeholder="Masukkan password dari guru"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-violet-400 pr-12"
                               required autofocus>
                        <button type="button" onclick="togglePwd()"
                                class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 text-lg">
                            👁
                        </button>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="tutupModal()"
                            class="flex-1 py-2.5 border border-gray-200 text-gray-600 rounded-xl text-sm hover:bg-gray-50 transition font-medium">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 py-2.5 bg-violet-600 hover:bg-violet-700 text-white rounded-xl text-sm font-semibold transition">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // ── Modal join ───────────────────────────────────────────
        function bukaModalJoin(kelasId, namaKelas) {
            document.getElementById('modal-nama-kelas').textContent = namaKelas;
            document.getElementById('form-join').action = '/kelas/' + kelasId + '/join';
            document.getElementById('input-password').value = '';
            document.getElementById('modal-join').classList.remove('hidden');
            setTimeout(() => document.getElementById('input-password').focus(), 100);
        }

        function tutupModal() {
            document.getElementById('modal-join').classList.add('hidden');
        }

        function tutupModalJika(event) {
            if (event.target === document.getElementById('modal-join')) tutupModal();
        }

        function togglePwd() {
            const inp = document.getElementById('input-password');
            inp.type = inp.type === 'password' ? 'text' : 'password';
        }

        // ── Search filter ────────────────────────────────────────
        function filterKelas() {
            const q = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('.kelas-card').forEach(card => {
                const nama = card.getAttribute('data-nama') || '';
                card.style.display = nama.includes(q) ? '' : 'none';
            });
        }

        // ── Auto-buka modal jika ada error password (setelah redirect back) ──
        @if($errors->has('password_kelas'))
            // Ambil kelas_id dari URL sebelumnya
            const prevUrl = document.referrer;
            const match   = prevUrl.match(/\/kelas\/(\d+)\/join/);
            if (match) {
                // Tidak bisa otomatis buka dengan nama, tampilkan notif saja
                document.addEventListener('DOMContentLoaded', () => {
                    const errDiv = document.createElement('div');
                    errDiv.className = 'fixed bottom-5 right-5 bg-red-500 text-white px-5 py-3 rounded-xl shadow-lg text-sm z-50';
                    errDiv.textContent = '❌ Password kelas salah, coba lagi.';
                    document.body.appendChild(errDiv);
                    setTimeout(() => errDiv.remove(), 4000);
                });
            }
        @endif
    </script>

</x-layouts.siswa>