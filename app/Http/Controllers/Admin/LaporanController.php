<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Denda;
use App\Models\DetailPeminjaman;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $totalPeminjaman = Peminjaman::count();
        $totalSelesai = Peminjaman::where('status_peminjaman', 'selesai')->count();
        $totalAktif = Peminjaman::where('status_peminjaman', 'dipinjam')->count();
        $totalTerlambat = Peminjaman::whereHas('pengembalian', function ($q) {
            $q->where('status_pengembalian', 'terlambat');
        })->count();

        $bukuSeringDipinjam = DetailPeminjaman::select('buku_id', DB::raw('SUM(jumlah) as total'))
            ->groupBy('buku_id')
            ->orderByDesc('total')
            ->take(5)
            ->with('buku')
            ->get();

        $anggotaAktif = Anggota::where('status_akun', 'active')->count();
        $totalDenda = Denda::sum('total_denda');
        $dendaBelumBayar = Denda::where('status_bayar', 'belum_bayar')->sum('total_denda');

        // Sesuai Use Case Scenario 5.4.17 (skenario alternatif): jika belum ada
        // data peminjaman sama sekali, laporan menampilkan info "belum tersedia".
        $laporanTersedia = $totalPeminjaman > 0;

        return view('admin.laporan.index', compact(
            'totalPeminjaman', 'totalSelesai', 'totalAktif', 'totalTerlambat',
            'bukuSeringDipinjam', 'anggotaAktif', 'totalDenda', 'dendaBelumBayar', 'laporanTersedia'
        ));
    }
}
