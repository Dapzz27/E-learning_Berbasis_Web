<x-layouts.siswa title="Edit Profil">
    <div class="max-w-xl mx-auto bg-white rounded-2xl shadow p-8 mt-6">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Edit Profil</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded-xl mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="/profile/update" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('POST')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border border-gray-200 rounded-xl px-4 py-2
                              text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Induk</label>
                <input type="text" name="nomor_induk" value="{{ $user->nomor_induk }}" class="w-full border border-gray-200 rounded-xl px-4 py-2
                              text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password Baru <span class="text-gray-400">(kosongkan jika tidak diubah)</span>
                </label>
                <input type="password" name="password" class="w-full border border-gray-200 rounded-xl px-4 py-2
                              text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Profil</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-500">
            </div>

            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white
                           py-2 rounded-xl font-medium transition">
                Simpan Perubahan
            </button>
        </form>
    </div>
</x-layouts.siswa>