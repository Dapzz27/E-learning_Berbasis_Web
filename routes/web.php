<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PertemuanController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\AbsensiController;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerView']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {

    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/profil', [AuthController::class, 'profil']);
    Route::get('/editprofil', [AuthController::class, 'editprofil']);
    Route::post('/profile/update', [AuthController::class, 'updateProfil']);
    Route::post('/hapus-akun', [AuthController::class, 'hapusAkun'])->name('hapus.akun');

    // Kelas detail (guru & siswa)
    Route::get('/kelas/{id}', [KelasController::class, 'show']);

    // Pertemuan
    Route::post('/kelas/{kelasId}/pertemuan', [PertemuanController::class, 'store']);
    Route::put('/pertemuan/{id}', [PertemuanController::class, 'update']);
    Route::post('/pertemuan/{id}/toggle-buka', [PertemuanController::class, 'toggleBuka']);
    Route::delete('/pertemuan/{id}', [PertemuanController::class, 'destroy']);

    // Materi
    Route::post('/pertemuan/{pertemuanId}/materi', [MateriController::class, 'store']);
    Route::delete('/materi/{id}', [MateriController::class, 'destroy']);

    // Tugas
    Route::post('/pertemuan/{pertemuanId}/tugas', [TugasController::class, 'store']);
    Route::delete('/tugas/{id}', [TugasController::class, 'destroy']);
    Route::post('/tugas/{tugasId}/submit', [TugasController::class, 'submit']);
    Route::post('/tugas-submission/{submissionId}/nilai', [TugasController::class, 'nilai']);

    // Absensi
    Route::post('/pertemuan/{pertemuanId}/absen', [AbsensiController::class, 'absen']);
    Route::get('/pertemuan/{pertemuanId}/rekap-absensi', [AbsensiController::class, 'rekap']);

    // ── GURU role 1 ──────────────────────────────────────────
    Route::middleware('role:1')->group(function () {

        Route::get('/dashboard-guru', fn() => view('Admin_Guru.home'));
        Route::get('/tugas', fn() => view('Admin_Guru.tugas.tugas'));
        Route::get('/monitoringsiswa', fn() => view('Admin_Guru.monitoringsiswa'));
        Route::get('/notifikasi', fn() => view('Admin_Guru.notifikasi.index'));

        Route::get('/kelas-guru', [KelasController::class, 'index']);
        Route::post('/kelas/store', [KelasController::class, 'store']);
        Route::get('/kelas/{id}/edit', [KelasController::class, 'edit']);
        Route::put('/kelas/{id}/update', [KelasController::class, 'update']);

        // FIX: DELETE hanya di group guru, dengan nama kelas.destroy
        Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    });

    // ── SISWA role 0 ──────────────────────────────────────────
    Route::middleware('role:0')->group(function () {

        Route::get('/dashboard-siswa', fn() => view('Siswa.home'));
        Route::get('/pengumuman', fn() => view('Siswa.pengumuman'));
        Route::get('/nilai', fn() => view('Siswa.nilai'));

        Route::get('/kelas-siswa', [KelasController::class, 'kelasSiswa']);
        Route::post('/kelas/{id}/join', [KelasController::class, 'joinKelas']);
    });
});