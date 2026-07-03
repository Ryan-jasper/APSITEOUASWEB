<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AnggotaAuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:anggotas,username',
            'email' => 'required|email|max:100|unique:anggotas,email',
            'password' => 'required|string|min:6|confirmed',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
        ]);

        Anggota::create([
            'nama_lengkap' => $data['nama_lengkap'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password_hash' => Hash::make($data['password']),
            'alamat' => $data['alamat'] ?? null,
            'no_telp' => $data['no_telp'] ?? null,
            'status_akun' => 'pending',
            'tanggal_daftar' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan tunggu verifikasi dari Admin sebelum login.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $anggota = Anggota::where('username', $credentials['login'])
            ->orWhere('email', $credentials['login'])
            ->first();

        if (! $anggota || ! Hash::check($credentials['password'], $anggota->password_hash)) {
            return back()->withErrors(['login' => 'Username/email atau password salah.'])->withInput();
        }

        if ($anggota->status_akun !== 'active') {
            return back()->withErrors(['login' => 'Akun kamu belum diverifikasi oleh Admin.'])->withInput();
        }

        Auth::guard('anggota')->login($anggota);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('anggota')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
