<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class AnggotaAdminController extends Controller
{
    public function index(Request $request)
    {
        // Sesuai Use Case Scenario 5.4.14: defaultnya menampilkan "daftar registrasi
        // yang menunggu verifikasi" (status pending). Filter status lain tersedia
        // sebagai tab tambahan untuk kebutuhan manajemen anggota secara umum.
        $filter = $request->get('status', 'pending');

        $query = Anggota::latest();
        if (in_array($filter, ['pending', 'active', 'inactive'])) {
            $query->where('status_akun', $filter);
        }

        $anggotas = $query->paginate(10)->withQueryString();
        $jumlahPending = Anggota::where('status_akun', 'pending')->count();

        return view('admin.anggota.index', compact('anggotas', 'filter', 'jumlahPending'));
    }

    public function verifikasi($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->update(['status_akun' => 'active']);

        Notifikasi::create([
            'anggota_id' => $anggota->anggota_id,
            'pesan' => 'Akun kamu telah diverifikasi. Selamat datang di Perpustakaan!',
            'status' => 'belum_dibaca',
        ]);

        return back()->with('success', 'Anggota berhasil diverifikasi.');
    }

    public function tolak($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->update(['status_akun' => 'inactive']);

        Notifikasi::create([
            'anggota_id' => $anggota->anggota_id,
            'pesan' => 'Maaf, pendaftaran akun kamu ditolak oleh Admin.',
            'status' => 'belum_dibaca',
        ]);

        return back()->with('success', 'Pendaftaran anggota ditolak.');
    }
}
