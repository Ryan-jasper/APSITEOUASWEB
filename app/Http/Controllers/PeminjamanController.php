<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function ajukan($buku_id)
    {
        $anggota = Auth::guard('anggota')->user();
        $buku = Buku::findOrFail($buku_id);

        if ($anggota->status_akun !== 'active') {
            return back()->with('error', 'Akun kamu belum aktif, tidak bisa mengajukan peminjaman.');
        }

        if ($buku->stok < 1 || $buku->status_buku !== 'available') {
            return back()->with('error', 'Stok buku tidak tersedia.');
        }

        $sedangPinjamBukuIni = Peminjaman::where('anggota_id', $anggota->anggota_id)
            ->whereIn('status_peminjaman', ['pending', 'dipinjam'])
            ->whereHas('detail', function ($q) use ($buku_id) {
                $q->where('buku_id', $buku_id);
            })->exists();

        if ($sedangPinjamBukuIni) {
            return back()->with('error', 'Kamu masih memiliki proses peminjaman aktif untuk buku ini.');
        }

        $peminjaman = Peminjaman::create([
            'anggota_id' => $anggota->anggota_id,
            'status_peminjaman' => 'pending',
        ]);

        DetailPeminjaman::create([
            'peminjaman_id' => $peminjaman->peminjaman_id,
            'buku_id' => $buku->buku_id,
            'jumlah' => 1,
        ]);

        return back()->with('success', 'Pengajuan peminjaman berhasil dikirim, menunggu validasi Admin.');
    }

    public function status()
    {
        // Sesuai Use Case Scenario 5.4.6: menampilkan SEMUA status peminjaman
        // milik anggota (menunggu validasi, dipinjam, selesai, ditolak) - tidak difilter.
        $anggota = Auth::guard('anggota')->user();
        $peminjamans = Peminjaman::with('detail.buku')
            ->where('anggota_id', $anggota->anggota_id)
            ->latest()
            ->get();

        return view('anggota.peminjaman.status', compact('peminjamans'));
    }

    public function riwayat()
    {
        $anggota = Auth::guard('anggota')->user();
        $peminjamans = Peminjaman::with('detail.buku', 'pengembalian.denda')
            ->where('anggota_id', $anggota->anggota_id)
            ->latest()
            ->get();

        return view('anggota.peminjaman.riwayat', compact('peminjamans'));
    }
}
