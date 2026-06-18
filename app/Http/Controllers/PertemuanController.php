<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PertemuanController extends Controller
{
    // ── Simpan pertemuan baru ────────────────────────────────
    public function store(Request $request, $kelasId)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
        ]);

        DB::table('pertemuan')->insert([
            'kelas_id' => $kelasId,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'status_buka' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/kelas/' . $kelasId)->with('success', 'Pertemuan berhasil ditambahkan');
    }

    // ── Update judul/tanggal pertemuan ───────────────────────
    public function update(Request $request, $id)
    {
        $pertemuan = DB::table('pertemuan')->where('id', $id)->first();

        if (!$pertemuan) {
            abort(404);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
        ]);

        DB::table('pertemuan')->where('id', $id)->update([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'updated_at' => now(),
        ]);

        return redirect('/kelas/' . $pertemuan->kelas_id)->with('success', 'Pertemuan berhasil diperbarui');
    }

    // ── Buka/Tutup pertemuan supaya siswa bisa absen ─────────
    public function toggleBuka($id)
    {
        $pertemuan = DB::table('pertemuan')->where('id', $id)->first();

        if (!$pertemuan) {
            abort(404);
        }

        DB::table('pertemuan')->where('id', $id)->update([
            'status_buka' => $pertemuan->status_buka ? 0 : 1,
            'updated_at' => now(),
        ]);

        return back()->with('success', $pertemuan->status_buka
            ? 'Pertemuan ditutup, siswa tidak bisa absen lagi'
            : 'Pertemuan dibuka, siswa bisa melakukan absen sekarang');
    }

    // ── Hapus pertemuan ───────────────────────────────────────
    public function destroy($id)
    {
        $pertemuan = DB::table('pertemuan')->where('id', $id)->first();

        if (!$pertemuan) {
            abort(404);
        }

        DB::table('pertemuan')->where('id', $id)->delete();

        return redirect('/kelas/' . $pertemuan->kelas_id)->with('success', 'Pertemuan berhasil dihapus');
    }
}