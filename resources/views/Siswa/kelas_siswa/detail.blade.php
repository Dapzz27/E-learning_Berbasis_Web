<x-layouts.siswa title="Detail Kelas">

    @if(session('success'))
        <div class="mb-5 bg-green-100 text-green-700 px-5 py-3 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-5 bg-red-100 text-red-700 px-5 py-3 rounded-xl text-sm">
            {{ session('error') }}
        </div>
    @endif

    <div
        x-data="{ openPertemuan: null, modalPertemuan: false, modalMateri: null, modalTugas: null, modalSetting: false }">

        <!-- HEADER KELAS -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
            <div class="h-36 bg-gray-100 relative">
                @if($kelas->cover ?? null)
                    <img src="{{ asset('uploads/kelas/' . $kelas->cover) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                @endif

                <a href="/kelas-siswa"
                    class="absolute top-4 left-4 w-9 h-9 bg-white/90 rounded-full flex items-center justify-center hover:bg-white transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-700" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>

                <button @click="modalSetting = true"
                    class="absolute top-4 right-4 flex items-center gap-2 bg-white/90 hover:bg-white px-4 py-2 rounded-xl text-sm font-medium text-gray-700 transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Pengaturan
                </button>
            </div>

            <div class="p-6">
                <span class="inline-flex px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">
                    {{ $kelas->jurusan }}
                </span>
                <h1 class="text-2xl font-bold text-gray-800 mt-3">{{ $kelas->nama_kelas }}</h1>

                <div class="flex items-center gap-3 mt-4">
                    <div
                        class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">
                        {{ strtoupper(substr($kelas->nama_guru, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Guru</p>
                        <p class="font-medium text-gray-800 text-sm">{{ $kelas->nama_guru }}</p>
                    </div>
                </div>

                @if($kelas->deskripsi)
                    <p class="text-sm text-gray-600 mt-4 leading-relaxed">{{ $kelas->deskripsi }}</p>
                @endif
            </div>
        </div>

        <!-- DAFTAR PERTEMUAN -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-gray-800">Pertemuan</h2>
            @if(session('role') == 1)
                <button @click="modalPertemuan = true"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    + Tambah Pertemuan
                </button>
            @endif
        </div>

        @if($pertemuan->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-10 flex flex-col items-center text-center">
                <div class="text-3xl mb-2">🗓️</div>
                <p class="text-gray-600 font-medium">Belum Ada Pertemuan</p>
                <p class="text-gray-400 text-sm mt-1">Tambahkan pertemuan pertama untuk mulai mengisi materi dan tugas</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($pertemuan as $p)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                        <!-- HEADER PERTEMUAN -->
                        <button type="button"
                            @click="openPertemuan === {{ $p->id }} ? openPertemuan = null : openPertemuan = {{ $p->id }}"
                            class="w-full flex items-center justify-between px-5 py-4 hover:bg-gray-50 transition text-left">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs">
                                    {{ $loop->iteration }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 text-sm">{{ $p->judul }}</p>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        @if($p->tanggal)
                                            <span
                                                class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d M Y') }}</span>
                                        @endif
                                        <span class="text-xs text-gray-300">•</span>
                                        <span class="text-xs text-gray-400">{{ $p->jumlah_materi }} materi,
                                            {{ $p->jumlah_tugas }} tugas</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                @if(session('role') == 1)
                                    <span @click.stop="document.getElementById('toggle-{{ $p->id }}').submit()"
                                        class="text-xs font-semibold px-3 py-1.5 rounded-full cursor-pointer transition
                                                    {{ $p->status_buka ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                        {{ $p->status_buka ? '● Absen Dibuka' : 'Absen Ditutup' }}
                                    </span>
                                @endif
                                <svg :class="openPertemuan === {{ $p->id }} ? 'rotate-180' : ''"
                                    class="w-4 h-4 text-gray-400 transition-transform" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>

                        <!-- form tersembunyi untuk toggle buka/tutup absensi -->
                        @if(session('role') == 1)
                            <form id="toggle-{{ $p->id }}" action="/pertemuan/{{ $p->id }}/toggle-buka" method="POST"
                                class="hidden">
                                @csrf
                            </form>
                        @endif

                        <!-- ISI PERTEMUAN (expand) -->
                        <div x-show="openPertemuan === {{ $p->id }}" x-cloak
                            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" class="border-t border-gray-100 px-5 py-4 space-y-4">

                            @if(session('role') == 0)
                                <form action="/pertemuan/{{ $p->id }}/absen" method="POST">
                                    @csrf
                                    <button type="submit" {{ !$p->status_buka ? 'disabled' : '' }}
                                        class="text-sm font-medium px-4 py-2 rounded-xl transition
                                                    {{ $p->status_buka ? 'bg-green-600 text-white hover:bg-green-700' : 'bg-gray-100 text-gray-400 cursor-not-allowed' }}">
                                        {{ $p->status_buka ? 'Absen Sekarang' : 'Absen Belum Dibuka' }}
                                    </button>
                                </form>
                            @endif

                            <!-- MATERI -->
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Materi</p>
                                    @if(session('role') == 1)
                                        <button @click="modalMateri = {{ $p->id }}"
                                            class="text-xs text-blue-600 font-medium hover:underline">
                                            + Tambah Materi
                                        </button>
                                    @endif
                                </div>

                                @php $materiList = \Illuminate\Support\Facades\DB::table('materi')->where('pertemuan_id', $p->id)->get(); @endphp

                                @if($materiList->isEmpty())
                                    <p class="text-xs text-gray-400 italic">Belum ada materi</p>
                                @else
                                    <div class="space-y-2">
                                        @foreach($materiList as $m)
                                            <div class="bg-gray-50 rounded-xl px-4 py-3 flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-700">{{ $m->judul }}</p>
                                                    @if($m->isi)
                                                        <p class="text-xs text-gray-500 mt-0.5 line-clamp-1">{{ $m->isi }}</p>
                                                    @endif
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    @if($m->file)
                                                        <a href="{{ asset('uploads/materi/' . $m->file) }}" target="_blank"
                                                            class="text-xs text-blue-600 font-medium hover:underline">Unduh</a>
                                                    @endif
                                                    @if(session('role') == 1)
                                                        <form action="/materi/{{ $m->id }}" method="POST"
                                                            onsubmit="return confirm('Hapus materi ini?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                class="text-xs text-red-500 hover:underline">Hapus</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- TUGAS -->
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Tugas</p>
                                    @if(session('role') == 1)
                                        <button @click="modalTugas = {{ $p->id }}"
                                            class="text-xs text-blue-600 font-medium hover:underline">
                                            + Tambah Tugas
                                        </button>
                                    @endif
                                </div>

                                @php $tugasList = \Illuminate\Support\Facades\DB::table('tugas')->where('pertemuan_id', $p->id)->get(); @endphp

                                @if($tugasList->isEmpty())
                                    <p class="text-xs text-gray-400 italic">Belum ada tugas</p>
                                @else
                                    <div class="space-y-2">
                                        @foreach($tugasList as $t)
                                            <div class="bg-gray-50 rounded-xl px-4 py-3">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-sm font-medium text-gray-700">{{ $t->judul }}</p>
                                                    @if(session('role') == 1)
                                                        <form action="/tugas/{{ $t->id }}" method="POST"
                                                            onsubmit="return confirm('Hapus tugas ini?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                class="text-xs text-red-500 hover:underline">Hapus</button>
                                                        </form>
                                                    @endif
                                                </div>
                                                @if($t->deskripsi)
                                                    <p class="text-xs text-gray-500 mt-1">{{ $t->deskripsi }}</p>
                                                @endif
                                                @if($t->deadline)
                                                    <p class="text-xs text-orange-500 mt-1">Deadline:
                                                        {{ \Carbon\Carbon::parse($t->deadline)->translatedFormat('d M Y, H:i') }}</p>
                                                @endif

                                                @if(session('role') == 0)
                                                    <form action="/tugas/{{ $t->id }}/submit" method="POST" enctype="multipart/form-data"
                                                        class="mt-2 flex items-center gap-2">
                                                        @csrf
                                                        <input type="file" name="file" required class="text-xs">
                                                        <button type="submit"
                                                            class="text-xs bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700">Kumpulkan</button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- MODAL: TAMBAH PERTEMUAN -->
        <div x-show="modalPertemuan" x-cloak
            class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-4">
            <div @click.outside="modalPertemuan = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Pertemuan</h3>
                <form action="/kelas/{{ $kelas->id }}/pertemuan" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Judul Pertemuan</label>
                        <input type="text" name="judul" required placeholder="cth: Pertemuan 1"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-400">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Tanggal (opsional)</label>
                        <input type="date" name="tanggal"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-400">
                    </div>
                    <div class="flex gap-3 justify-end pt-2">
                        <button type="button" @click="modalPertemuan = false"
                            class="px-4 py-2 text-sm text-gray-600 border border-gray-200 rounded-xl hover:bg-gray-50">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-blue-600 rounded-xl hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL: TAMBAH MATERI (per pertemuan) -->
        @foreach($pertemuan as $p)
            <div x-show="modalMateri === {{ $p->id }}" x-cloak
                class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-4">
                <div @click.outside="modalMateri = null" class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Materi — {{ $p->judul }}</h3>
                    <form action="/pertemuan/{{ $p->id }}/materi" method="POST" enctype="multipart/form-data"
                        class="space-y-3">
                        @csrf
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Judul Materi</label>
                            <input type="text" name="judul" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-400">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Isi / Catatan</label>
                            <textarea name="isi" rows="3"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-400 resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">File (opsional)</label>
                            <input type="file" name="file" class="w-full text-sm">
                        </div>
                        <div class="flex gap-3 justify-end pt-2">
                            <button type="button" @click="modalMateri = null"
                                class="px-4 py-2 text-sm text-gray-600 border border-gray-200 rounded-xl hover:bg-gray-50">Batal</button>
                            <button type="submit"
                                class="px-4 py-2 text-sm text-white bg-blue-600 rounded-xl hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        <!-- MODAL: TAMBAH TUGAS (per pertemuan) -->
        @foreach($pertemuan as $p)
            <div x-show="modalTugas === {{ $p->id }}" x-cloak
                class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-4">
                <div @click.outside="modalTugas = null" class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Tugas — {{ $p->judul }}</h3>
                    <form action="/pertemuan/{{ $p->id }}/tugas" method="POST" class="space-y-3">
                        @csrf
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Judul Tugas</label>
                            <input type="text" name="judul" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-400">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Deskripsi</label>
                            <textarea name="deskripsi" rows="3"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-400 resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Deadline (opsional)</label>
                            <input type="datetime-local" name="deadline"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-400">
                        </div>
                        <div class="flex gap-3 justify-end pt-2">
                            <button type="button" @click="modalTugas = null"
                                class="px-4 py-2 text-sm text-gray-600 border border-gray-200 rounded-xl hover:bg-gray-50">Batal</button>
                            <button type="submit"
                                class="px-4 py-2 text-sm text-white bg-blue-600 rounded-xl hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        <!-- MODAL: PENGATURAN KELAS -->
        <div x-show="modalSetting" x-cloak class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-4">
            <div @click.outside="modalSetting = false"
                class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Pengaturan Kelas</h3>

                <!-- Info kelas -->
                <div class="bg-gray-50 rounded-xl p-4 mb-5 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Nama Kelas</span>
                        <span class="font-medium text-gray-700">{{ $kelas->nama_kelas }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Nama Guru</span>
                        <span class="font-medium text-gray-700">{{ $kelas->nama_guru }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Jurusan</span>
                        <span class="font-medium text-gray-700">{{ $kelas->jurusan }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Dibuat</span>
                        <span
                            class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($kelas->created_at)->translatedFormat('d M Y') }}</span>
                    </div>
                </div>

                @if(session('role') == 1)
                    <form action="/kelas/{{ $kelas->id }}/update" method="POST" enctype="multipart/form-data"
                        class="space-y-3">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Sampul Kelas</label>
                            <input type="file" name="cover" accept="image/*" class="w-full text-sm">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Nama Kelas</label>
                            <input type="text" name="nama_kelas" value="{{ $kelas->nama_kelas }}" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-400">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Nama Guru</label>
                            <input type="text" name="nama_guru" value="{{ $kelas->nama_guru }}" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-400">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Jurusan</label>
                            <select name="jurusan"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-400">
                                @foreach(['RPL', 'TKJ', 'DKV', 'AKL', 'MPLB'] as $j)
                                    <option value="{{ $j }}" {{ $kelas->jurusan == $j ? 'selected' : '' }}>{{ $j }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Deskripsi</label>
                            <textarea name="deskripsi" rows="3"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-400 resize-none">{{ $kelas->deskripsi }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Password Kelas (kosongkan jika tidak
                                diubah)</label>
                            <input type="password" name="password_kelas"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-blue-400">
                        </div>

                        <div class="flex gap-3 justify-end pt-2">
                            <button type="button" @click="modalSetting = false"
                                class="px-4 py-2 text-sm text-gray-600 border border-gray-200 rounded-xl hover:bg-gray-50">Tutup</button>
                            <button type="submit"
                                class="px-4 py-2 text-sm text-white bg-blue-600 rounded-xl hover:bg-blue-700">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                @endif

            </div>
        </div>

    </div>

</x-layouts.siswa>