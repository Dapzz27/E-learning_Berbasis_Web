<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    // ── Daftar semua kelas (guru) ───────────────────────────
    public function index()
    {
        $kelas = DB::table('kelas')->get();
        return view('Admin_Guru.kelas_guru.kelas', compact('kelas'));
    }

    // ── Simpan kelas baru ────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'password_kelas' => 'required|min:4',
            'cover' => 'nullable|image|max:2048',
        ]);

        $userId = Auth::id();
        $guru = DB::table('users')->where('id', $userId)->first();

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $namaCover = time() . '_' . $request->cover->extension();
            $request->cover->move(public_path('uploads/kelas'), $namaCover);
            $coverPath = $namaCover;
        }

        DB::table('kelas')->insert([
            'guru_id' => $userId,
            'nama_kelas' => $request->nama_kelas,
            'nama_guru' => $guru->name ?? session('name'),
            'jurusan' => $request->jurusan,
            'deskripsi' => $request->deskripsi,
            'password_kelas' => $request->password_kelas,
            'cover' => $coverPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/kelas-guru')->with('success', 'Kelas berhasil ditambahkan');
    }

    // ── Detail kelas (guru & siswa yang sudah bergabung) ────
    public function show($id)
    {
        $kelas = DB::table('kelas')->where('id', $id)->first();
        if (!$kelas)
            abort(404);

        $userId = Auth::id();
        $user = DB::table('users')->where('id', $userId)->first();

        // Siswa harus sudah terdaftar di kelas ini
        if ($user->role == 0) {
            $sudahGabung = DB::table('kelas_siswa')
                ->where('kelas_id', $id)
                ->where('siswa_id', $userId)
                ->exists();

            if (!$sudahGabung) {
                return redirect('/kelas-siswa')->with('error', 'Kamu belum bergabung ke kelas ini.');
            }
        }

        $pertemuan = DB::table('pertemuan')
            ->where('kelas_id', $id)
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($p) {
                $p->jumlah_materi = DB::table('materi')->where('pertemuan_id', $p->id)->count();
                $p->jumlah_tugas = DB::table('tugas')->where('pertemuan_id', $p->id)->count();
                return $p;
            });

        if ($user->role == 1) {
            return view('Admin_Guru.kelas_guru.detail', compact('kelas', 'pertemuan'));
        }

        return view('Siswa.kelas_siswa.detail', compact('kelas', 'pertemuan'));
    }

    // ── Form edit kelas ──────────────────────────────────────
    public function edit($id)
    {
        $kelas = DB::table('kelas')->where('id', $id)->first();
        if (!$kelas)
            abort(404);
        return view('Admin_Guru.kelas_guru.edit', compact('kelas'));
    }

    // ── Update kelas ─────────────────────────────────────────
    public function update(Request $request, $id)
    {
        $kelas = DB::table('kelas')->where('id', $id)->first();
        if (!$kelas)
            abort(404);

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'nama_guru' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'cover' => 'nullable|image|max:2048',
        ]);

        $coverPath = $kelas->cover;
        if ($request->hasFile('cover')) {
            $namaCover = time() . '_' . $request->cover->extension();
            $request->cover->move(public_path('uploads/kelas'), $namaCover);
            $coverPath = $namaCover;
        }

        $updateData = [
            'nama_kelas' => $request->nama_kelas,
            'nama_guru' => $request->nama_guru,
            'jurusan' => $request->jurusan,
            'deskripsi' => $request->deskripsi,
            'cover' => $coverPath,
            'updated_at' => now(),
        ];

        if ($request->filled('password_kelas')) {
            $updateData['password_kelas'] = $request->password_kelas;
        }

        DB::table('kelas')->where('id', $id)->update($updateData);
        return redirect('/kelas/' . $id)->with('success', 'Kelas berhasil diperbarui');
    }

    // ── Hapus kelas ──────────────────────────────────────────
    public function destroy($id)
    {
        $kelas = DB::table('kelas')
            ->where('id', $id)
            ->first();

        if (!$kelas) {
            return redirect('/kelas-guru')
                ->with('error', 'Kelas tidak ditemukan');
        }

        // hapus file cover
        if (!empty($kelas->cover)) {

            $coverPath = public_path('uploads/kelas/' . $kelas->cover);

            if (file_exists($coverPath)) {
                unlink($coverPath);
            }
        }

        // ambil seluruh pertemuan kelas
        $pertemuanIds = DB::table('pertemuan')
            ->where('kelas_id', $id)
            ->pluck('id');

        if ($pertemuanIds->count()) {

            DB::table('materi')
                ->whereIn('pertemuan_id', $pertemuanIds)
                ->delete();

            DB::table('tugas')
                ->whereIn('pertemuan_id', $pertemuanIds)
                ->delete();

            DB::table('pertemuan')
                ->whereIn('id', $pertemuanIds)
                ->delete();
        }

        // hapus anggota kelas
        DB::table('kelas_siswa')
            ->where('kelas_id', $id)
            ->delete();

        // hapus kelas
        DB::table('kelas')
            ->where('id', $id)
            ->delete();

        return redirect('/kelas-guru')
            ->with('success', 'Kelas berhasil dihapus');
    }

    // ── Daftar kelas siswa (yang sudah bergabung) ────────────
    public function kelasSiswa()
    {
        $userId = Auth::id();

        // Semua kelas yang tersedia (belum & sudah diikuti)
        $semuaKelas = DB::table('kelas')->get();

        // Kelas yang sudah diikuti siswa ini
        $kelasIkuti = DB::table('kelas')
            ->join('kelas_siswa', 'kelas.id', '=', 'kelas_siswa.kelas_id')
            ->where('kelas_siswa.siswa_id', $userId)
            ->select('kelas.*')
            ->get();

        $kelasIkutiIds = $kelasIkuti->pluck('id')->toArray();

        // Kelas yang belum diikuti = rekomendasi
        $rekomendasi = $semuaKelas->whereNotIn('id', $kelasIkutiIds)->values();

        return view('Siswa.kelas_siswa.kelas', [
            'kelas' => $rekomendasi,   // belum diikuti → ditampilkan sebagai rekomendasi
            'riwayat' => $kelasIkuti,    // sudah diikuti
        ]);
    }

    // ── Proses join kelas (POST password) ────────────────────
    public function joinKelas(Request $request, $id)
    {
        $request->validate([
            'password_kelas' => 'required',
        ]);

        $kelas = DB::table('kelas')->where('id', $id)->first();
        if (!$kelas)
            abort(404);

        $userId = Auth::id();

        // Cek sudah gabung
        $sudahGabung = DB::table('kelas_siswa')
            ->where('kelas_id', $id)
            ->where('siswa_id', $userId)
            ->exists();

        if ($sudahGabung) {
            return redirect('/kelas/' . $id);
        }

        // Cek password
        if ($request->password_kelas !== $kelas->password_kelas) {
            return back()->withErrors(['password_kelas' => 'Password kelas salah.'])->withInput();
        }

        // Daftarkan siswa ke kelas
        DB::table('kelas_siswa')->insert([
            'kelas_id' => $id,
            'siswa_id' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/kelas/' . $id)->with('success', 'Berhasil bergabung ke kelas ' . $kelas->nama_kelas . '!');
    }
}