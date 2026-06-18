<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'guru_id',
        'nama_kelas',
        'nama_guru',
        'jurusan',
        'deskripsi',
        'password_kelas',
        'cover',
    ];

    // Relasi ke tabel users (guru)
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    // Relasi ke tabel kelas_siswa (pivot)
    public function siswa()
    {
        return $this->belongsToMany(User::class, 'kelas_siswa', 'kelas_id', 'siswa_id');
    }

    // Relasi ke pertemuan
    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class, 'kelas_id');
    }
}