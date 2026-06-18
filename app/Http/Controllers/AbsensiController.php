<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    // ── Siswa: absen sendiri pada pertemuan yang sedang dibuka ──
    public function absen($pertemuanId)
    {
        $pertemuan = DB::table('pertemuan')->where('id', $pertemuanId)->first();

        if (!$pertemuan) {
            abort(404);
        }

        if (!$pertemuan->status_buka) {
            return back()->with('error', 'Pertemuan belum dibuka oleh guru, absen belum bisa dilakukan');
        }

        $siswaId = Auth::id();

        $sudahAbsen = DB::table('absensi')
            ->where('pertemuan_id', $pertemuanId)
            ->where('siswa_id', $siswaId)
            ->first();

        if ($sudahAbsen) {
            return back()->with('error', 'Kamu sudah melakukan absen pada pertemuan ini');
        }

        DB::table('absensi')->insert([
            'pertemuan_id' => $pertemuanId,
            'siswa_id' => $siswaId,
            'status' => 'hadir',
            'waktu_absen' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Absen berhasil dicatat');
    }

    // ── Guru: lihat rekap absensi per pertemuan ──────────────────
    public function rekap($pertemuanId)
    {
        $pertemuan = DB::table('pertemuan')->where('id', $pertemuanId)->first();

        if (!$pertemuan) {
            abort(404);
        }

        $absensi = DB::table('absensi')
            ->join('users', 'absensi.siswa_id', '=', 'users.id')
            ->where('absensi.pertemuan_id', $pertemuanId)
            ->select('absensi.*', 'users.name as nama_siswa', 'users.nomor_induk')
            ->get();

        return view('Admin_Guru.kelas_guru.absensi', compact('pertemuan', 'absensi'));
    }
}