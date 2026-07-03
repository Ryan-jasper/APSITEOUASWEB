<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Denda;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalAnggota = Anggota::where('status_akun', 'active')->count();
        $anggotaPending = Anggota::where('status_akun', 'pending')->count();
        $peminjamanPending = Peminjaman::where('status_peminjaman', 'pending')->count();
        $peminjamanAktif = Peminjaman::where('status_peminjaman', 'dipinjam')->count();
        $dendaBelumBayar = Denda::where('status_bayar', 'belum_bayar')->sum('total_denda');

        return view('admin.dashboard', compact(
            'totalBuku', 'totalAnggota', 'anggotaPending',
            'peminjamanPending', 'peminjamanAktif', 'dendaBelumBayar'
        ));
    }
}
