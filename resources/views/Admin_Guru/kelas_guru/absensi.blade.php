<x-layouts.guru title="Rekap Absensi">

    <div class="mb-5">
        <a href="/kelas/{{ $pertemuan->kelas_id }}" class="text-sm text-blue-600 font-medium hover:underline">← Kembali
            ke Kelas</a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-1">Rekap Absensi</h2>
        <p class="text-sm text-gray-400 mb-5">{{ $pertemuan->judul }}</p>

        @if($absensi->isEmpty())
            <div class="py-10 flex flex-col items-center text-center">
                <div class="text-3xl mb-2">📋</div>
                <p class="text-gray-500 text-sm">Belum ada siswa yang absen pada pertemuan ini</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-400 text-xs uppercase border-b border-gray-100">
                            <th class="py-2 pr-4">Nama Siswa</th>
                            <th class="py-2 pr-4">NISN</th>
                            <th class="py-2 pr-4">Status</th>
                            <th class="py-2 pr-4">Waktu Absen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absensi as $a)
                            <tr class="border-b border-gray-50">
                                <td class="py-3 pr-4 font-medium text-gray-700">{{ $a->nama_siswa }}</td>
                                <td class="py-3 pr-4 text-gray-500">{{ $a->nomor_induk }}</td>
                                <td class="py-3 pr-4">
                                    <span
                                        class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $a->status == 'hadir' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $a->status == 'hadir' ? 'Hadir' : 'Tidak Hadir' }}
                                    </span>
                                </td>
                                <td class="py-3 pr-4 text-gray-500">{{ \Carbon\Carbon::parse($a->waktu_absen)->translatedFormat('d M Y, H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</x-layouts.guru>