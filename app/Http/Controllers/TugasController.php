<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TugasController extends Controller
{
    // ── Guru: simpan tugas baru ───────────────────────────────
    public function store(Request $request, $pertemuanId)
    {
        $pertemuan = DB::table('pertemuan')->where('id', $pertemuanId)->first();

        if (!$pertemuan) {
            abort(404);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        DB::table('tugas')->insert([
            'pertemuan_id' => $pertemuanId,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/kelas/' . $pertemuan->kelas_id)->with('success', 'Tugas berhasil ditambahkan');
    }

    // ── Guru: hapus tugas ──────────────────────────────────────
    public function destroy($id)
    {
        $tugas = DB::table('tugas')->where('id', $id)->first();

        if (!$tugas) {
            abort(404);
        }

        $pertemuan = DB::table('pertemuan')->where('id', $tugas->pertemuan_id)->first();

        DB::table('tugas')->where('id', $id)->delete();

        return redirect('/kelas/' . $pertemuan->kelas_id)->with('success', 'Tugas berhasil dihapus');
    }

    // ── Siswa: submit / upload jawaban tugas ────────────────────
    public function submit(Request $request, $tugasId)
    {
        $tugas = DB::table('tugas')->where('id', $tugasId)->first();

        if (!$tugas) {
            abort(404);
        }

        $request->validate([
            'file' => 'required|file|max:10240', // max 10MB
        ]);

        $siswaId = Auth::id();
        $namaFile = time() . '_' . $request->file->getClientOriginalName();
        $request->file->move(public_path('uploads/tugas'), $namaFile);

        // Cek apakah siswa sudah pernah submit tugas ini sebelumnya
        $existing = DB::table('tugas_submission')
            ->where('tugas_id', $tugasId)
            ->where('siswa_id', $siswaId)
            ->first();

        if ($existing) {
            DB::table('tugas_submission')->where('id', $existing->id)->update([
                'file' => $namaFile,
                'waktu_submit' => now(),
                'updated_at' => now(),
            ]);
        } else {
            DB::table('tugas_submission')->insert([
                'tugas_id' => $tugasId,
                'siswa_id' => $siswaId,
                'file' => $namaFile,
                'waktu_submit' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Tugas berhasil dikumpulkan');
    }

    // ── Guru: beri nilai submission siswa ───────────────────────
    public function nilai(Request $request, $submissionId)
    {
        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        DB::table('tugas_submission')->where('id', $submissionId)->update([
            'nilai' => $request->nilai,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Nilai berhasil disimpan');
    }
}