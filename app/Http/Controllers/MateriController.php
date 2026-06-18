<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriController extends Controller
{
    // ── Simpan materi baru ────────────────────────────────────
    public function store(Request $request, $pertemuanId)
    {
        $pertemuan = DB::table('pertemuan')->where('id', $pertemuanId)->first();

        if (!$pertemuan) {
            abort(404);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // max 10MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $namaFile = time() . '_' . $request->file->getClientOriginalName();
            $request->file->move(public_path('uploads/materi'), $namaFile);
            $filePath = $namaFile;
        }

        DB::table('materi')->insert([
            'pertemuan_id' => $pertemuanId,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'file' => $filePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/kelas/' . $pertemuan->kelas_id)->with('success', 'Materi berhasil ditambahkan');
    }

    // ── Hapus materi ────────────────────────────────────────
    public function destroy($id)
    {
        $materi = DB::table('materi')->where('id', $id)->first();

        if (!$materi) {
            abort(404);
        }

        $pertemuan = DB::table('pertemuan')->where('id', $materi->pertemuan_id)->first();

        DB::table('materi')->where('id', $id)->delete();

        return redirect('/kelas/' . $pertemuan->kelas_id)->with('success', 'Materi berhasil dihapus');
    }
}