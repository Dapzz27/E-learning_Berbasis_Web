<x-layouts.guru title="Halaman Kelas">

    <div x-data="{
    showDeleteModal:false,
    deleteUrl:''
}">

        @if(session('success'))
            <div class="mb-6 bg-green-100 text-green-700 px-5 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div class="flex items-center gap-3">
                <h3 class="text-xl font-semibold text-gray-700">Daftar Kelas</h3>
                <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                    {{ $kelas->count() }} kelas
                </span>
            </div>

            <div class="flex gap-3">
                <input type="text" placeholder="Cari kelas..."
                    class="border border-gray-200 rounded-xl px-4 py-3 w-full md:w-72 focus:outline-none focus:border-blue-400">

                @if(session('role') == 1)
                    <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-xl font-medium transition">
                        + Tambah Kelas
                    </button>
                @endif
            </div>

        </div>

        @if($kelas->isEmpty())
            <div class="flex flex-col items-center justify-center py-24 gap-4">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <p class="text-gray-500 text-lg">Belum Ada Kelas</p>
                <p class="text-gray-400 text-sm">Klik "Tambah Kelas" untuk membuat kelas pertama</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($kelas as $item)
                    <div
                        class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                        <div class="h-44 overflow-hidden bg-gray-100">
                            @if($item->cover ?? null)
                                <img src="{{ asset('uploads/kelas/' . $item->cover) }}" alt="Cover Kelas"
                                    class="w-full h-full object-cover transition duration-500 hover:scale-105">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                    <span
                                        class="text-white text-3xl font-bold opacity-80">{{ strtoupper(substr($item->jurusan, 0, 2)) }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-5">
                            <span class="inline-flex px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">
                                {{ $item->jurusan }}
                            </span>

                            <h4 class="mt-4 text-xl font-bold text-gray-800 line-clamp-2 min-h-[56px]">
                                {{ $item->nama_kelas }}
                            </h4>

                            <div class="flex items-center gap-3 mt-4">
                                <div
                                    class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                    {{ strtoupper(substr($item->nama_guru, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Guru</p>
                                    <p class="font-medium text-gray-800">{{ $item->nama_guru }}</p>
                                </div>
                            </div>

                            @if($item->deskripsi)
                                <p class="text-sm text-gray-500 mt-4 line-clamp-2 min-h-[40px]">
                                    {{ $item->deskripsi }}
                                </p>
                            @endif

                            <div class="mt-5 flex gap-2">

                                <a href="/kelas/{{ $item->id }}"
                                    class="flex-1 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition">
                                    Masuk Kelas
                                </a>

                                <button type="button" @click="
                                deleteUrl='{{ route('kelas.destroy', $item->id) }}';
                                showDeleteModal=true
                            " class="px-4 bg-red-600 hover:bg-red-700 text-white rounded-xl transition">

                                    🗑
                                </button>

                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

        <!-- MODAL TAMBAH KELAS -->
        <div id="modal-tambah" class="hidden fixed inset-0 bg-black/40 z-50 items-center justify-center">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-6 max-h-[90vh] overflow-y-auto">

                <h3 class="text-xl font-bold text-gray-800 mb-5">Tambah Kelas Baru</h3>

                <form action="/kelas/store" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Sampul Kelas (opsional)</label>
                        <input type="file" name="cover" accept="image/*"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-400">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Nama Kelas</label>
                        <input type="text" name="nama_kelas" required placeholder="cth: Matematika Kelas 10"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-400">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Nama Guru</label>
                        <input type="text" value="{{ session('name') }}" readonly
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-100">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Jurusan</label>
                        <select name="jurusan"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-400">
                            <option value="RPL">RPL</option>
                            <option value="TKJ">TKJ</option>
                            <option value="DKV">DKV</option>
                            <option value="AKL">AKL</option>
                            <option value="MPLB">MPLB</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Deskripsi Kelas</label>
                        <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat mata pelajaran..."
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-400 resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Password Kelas</label>
                        <input type="password" name="password_kelas" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-400">
                    </div>

                    <div class="flex gap-3 justify-end pt-2">
                        <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden')"
                            class="px-5 py-2.5 text-sm text-gray-600 border border-gray-200 rounded-xl hover:bg-gray-50 transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 text-sm text-white bg-blue-500 hover:bg-blue-600 rounded-xl font-medium transition">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>

        </div>
        <!-- MODAL HAPUS KELAS -->
        <div x-show="showDeleteModal" x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4" style="display:none;">

            <div @click.away="showDeleteModal=false" class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">

                <div class="flex items-center gap-3 mb-4">

                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                        🗑
                    </div>

                    <div>
                        <h2 class="font-bold text-lg text-gray-800">
                            Hapus Kelas
                        </h2>

                        <p class="text-sm text-gray-500">
                            Tindakan ini tidak dapat dibatalkan
                        </p>
                    </div>

                </div>

                <p class="text-gray-600 text-sm">
                    Semua data yang berhubungan dengan kelas ini akan ikut terhapus,
                    termasuk siswa yang tergabung, pertemuan, materi, dan tugas.
                </p>

                <form :action="deleteUrl" method="POST" class="mt-6">

                    @csrf
                    @method('DELETE')

                    <div class="flex justify-end gap-3">

                        <button type="button" @click="showDeleteModal=false"
                            class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 rounded-xl">

                            Batal
                        </button>

                        <button type="submit" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl">

                            Ya, Hapus
                        </button>

                    </div>

                </form>

            </div>

        </div>
</x-layouts.guru>