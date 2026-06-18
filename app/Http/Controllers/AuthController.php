<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ── Views ────────────────────────────────────────────────
    public function loginView()
    {
        return view('Auth_Login.login');
    }

    public function registerView()
    {
        return view('Auth_Login.register');
    }

    // ── Register ─────────────────────────────────────────────
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_induk' => 'required|unique:users,nomor_induk',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'nomor_induk' => $request->nomor_induk,
            'password' => Hash::make($request->password), // ← hash password
            'role' => $request->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/login')->with('success', 'Register berhasil, silakan login.');
    }

    // ── Login ─────────────────────────────────────────────────
    public function login(Request $request)
    {
        $request->validate([
            'nomor_induk' => 'required',
            'password' => 'required',
        ]);

        // Cari user berdasarkan nomor_induk dulu
        /** @var object{id:int,name:string,nomor_induk:string,password:string,role:int,foto:?string}|null $user */
        $user = DB::table('users')
            ->where('nomor_induk', $request->nomor_induk)
            ->first();

        // Cek password dengan Hash::check karena password disimpan hashed
        if ($user && Hash::check($request->password, $user->password)) {

            // Gunakan Auth::loginUsingId agar middleware 'auth' mengenali
            Auth::loginUsingId($user->id);

            // Simpan info dasar ke session supaya bisa dipakai di view (profil, dsb)
            session([
                'user_id' => $user->id,
                'name' => $user->name,
                'nomor_induk' => $user->nomor_induk,
                'role' => $user->role,
                'foto' => $user->foto,
            ]);

            if ($user->role == 1) {
                return redirect('/dashboard-guru');
            }

            return redirect('/dashboard-siswa');
        }

        return back()->with('error', 'Nomor Induk atau Password salah');
    }

    // ── Lihat Profil ─────────────────────────────────────────
    public function profil()
    {
        $userId = Auth::id();
        $user = DB::table('users')->where('id', $userId)->first();

        // Siswa role 0, Guru role 1
        if ($user->role == 0) {
            return view('Siswa.profil', ['user' => $user]);
        }

        return view('Admin_Guru.profil', ['user' => $user]);
    }

    public function editprofil()
    {
        $userId = Auth::id();
        $user = DB::table('users')->where('id', $userId)->first();

        if ($user->role == 0) {
            return view('Siswa.editprofil', ['user' => $user]);
        }

        return view('Admin_Guru.editprofil', ['user' => $user]);
    }

    public function updateProfil(Request $request)
    {
        $userId = Auth::id();

        /** @var object{id:int,name:string,nomor_induk:string,role:int,foto:?string}|null $user */
        $user = DB::table('users')->where('id', $userId)->first();

        $foto = $user->foto;

        if ($request->hasFile('foto')) {
            $namaFoto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/profiles'), $namaFoto);
            $foto = $namaFoto;
        }

        $updateData = [
            'name' => $request->name,
            'nomor_induk' => $request->nomor_induk,
            'foto' => $foto,
            'updated_at' => now(),
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $userId)->update($updateData);

        // Sinkronkan session supaya navbar/sidebar & halaman profil langsung up-to-date
        session([
            'name' => $updateData['name'],
            'nomor_induk' => $updateData['nomor_induk'],
            'foto' => $foto,
        ]);

        return redirect('/profil')->with('success', 'Profil berhasil diperbarui');
    }

    public function hapusAkun(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $userId = Auth::id();

        $user = DB::table('users')
            ->where('id', $userId)
            ->first();

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah');
        }

        if (!empty($user->foto)) {

            $fotoPath = public_path('uploads/profiles/' . $user->foto);

            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        DB::table('users')
            ->where('id', $userId)
            ->delete();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Akun berhasil dihapus');
    }
    // ── Logout ────────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}