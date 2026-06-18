<x-layouts.guru title="Edit Profil" :user="session('name')" :role="session('role')">

    <div class="max-w-3xl mx-auto" x-data="{ show: false, preview: null }" x-init="setTimeout(() => show = true, 50)">

        <div x-show="show" x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0"
            class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <!-- Header gradient kecil -->
            <div class="relative h-24 bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-600">
                <div class="absolute -bottom-10 left-6">
                    <div class="relative">
                        <template x-if="preview">
                            <img :src="preview" alt="Preview"
                                class="w-20 h-20 rounded-full object-cover ring-4 ring-white shadow-md">
                        </template>
                        <template x-if="!preview">
                            @if(!empty($user->foto ?? null))
                                <img src="{{ asset('uploads/profiles/' . $user->foto) }}" alt="Foto Profil"
                                    class="w-20 h-20 rounded-full object-cover ring-4 ring-white shadow-md">
                            @else
                                <div
                                    class="w-20 h-20 rounded-full ring-4 ring-white shadow-md bg-gray-100 flex items-center justify-center text-2xl font-bold text-blue-600">
                                    {{ strtoupper(substr($user->name ?? session('name') ?? 'U', 0, 1)) }}
                                </div>
                            @endif
                        </template>

                        <!-- Tombol ganti foto -->
                        <label for="foto"
                            class="absolute -bottom-1 -right-1 w-7 h-7 bg-white rounded-full shadow flex items-center justify-center cursor-pointer hover:bg-gray-50 border border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-600" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                                </path>
                                <circle cx="12" cy="13" r="4"></circle>
                            </svg>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="pt-14 px-6 pb-6">

                <h1 class="text-lg font-bold text-gray-800">Edit Profil</h1>
                <p class="text-gray-400 text-xs mt-0.5">Perbarui informasi akun kamu di bawah ini.</p>

                @if(session('success'))
                    <div class="mt-4 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-2.5 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mt-4 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-2.5 rounded-xl">
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/profile/update" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">
                    @csrf

                    <input type="file" id="foto" name="foto" accept="image/*" class="hidden"
                        @change="preview = URL.createObjectURL($event.target.files[0])">

                    <div class="grid sm:grid-cols-2 gap-4">

                        <div>
                            <label class="text-xs font-medium text-gray-500">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name ?? session('name')) }}"
                                required
                                class="mt-1.5 w-full px-3.5 py-2.5 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
                        </div>

                        <div>
                            <label class="text-xs font-medium text-gray-500">
                                {{ (($user->role ?? session('role')) == 1) ? 'NIP' : 'NISN' }}
                            </label>
                            <input type="text" name="nomor_induk"
                                value="{{ old('nomor_induk', $user->nomor_induk ?? session('nomor_induk')) }}" required
                                class="mt-1.5 w-full px-3.5 py-2.5 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
                        </div>

                    </div>

                    <div x-data="{ showPass: false }">
                        <label class="text-xs font-medium text-gray-500">Password Baru (opsional)</label>
                        <div class="relative mt-1.5">
                            <input :type="showPass ? 'text' : 'password'" name="password" placeholder="Kosongkan jika tidak diubah"
                                class="w-full px-3.5 py-2.5 pr-10 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
                            <button type="button" @click="showPass = !showPass"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <svg x-show="!showPass" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg x-show="showPass" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                                    </path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3 pt-2">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 active:scale-[0.98] transition-all shadow-sm shadow-blue-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="/profil"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-600 text-sm font-medium rounded-xl hover:bg-gray-200 active:scale-[0.98] transition-all">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>

</x-layouts.guru>