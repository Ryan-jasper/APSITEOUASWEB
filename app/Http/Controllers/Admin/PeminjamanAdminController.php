<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class PeminjamanAdminController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('anggota', 'detail.buku')
            ->where('status_peminjaman', 'pending')
            ->latest()
            ->get();

        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function setujui($id)
    {
        $peminjaman = Peminjaman::with('detail.buku')->findOrFail($id);
        $admin = Auth::guard('admin')->user();

        foreach ($peminjaman->detail as $detail) {
            if ($detail->buku->stok < $detail->jumlah) {
                return back()->with('error', 'Stok buku "'.$detail->buku->judul.'" tidak mencukupi.');
            }
        }

        foreach ($peminjaman->detail as $detail) {
            $buku = $detail->buku;
            $buku->stok -= $detail->jumlah;
            $buku->status_buku = $buku->stok > 0 ? 'available' : 'unavailable';
            $buku->save();
        }

        $peminjaman->update([
            'admin_id' => $admin->admin_id,
            'tanggal_pinjam' => now(),
            'tanggal_jatuh_tempo' => now()->addDays(14),
            'status_peminjaman' => 'dipinjam',
        ]);

        Notifikasi::create([
            'anggota_id' => $peminjaman->anggota_id,
            'pesan' => 'Pengajuan peminjaman kamu disetujui. Jatuh tempo: '.$peminjaman->tanggal_jatuh_tempo->format('d-m-Y'),
            'status' => 'belum_dibaca',
        ]);

        return back()->with('success', 'Peminjaman berhasil disetujui.');
    }

    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $admin = Auth::guard('admin')->user();

        $peminjaman->update([
            'admin_id' => $admin->admin_id,
            'status_peminjaman' => 'ditolak',
        ]);

        Notifikasi::create([
            'anggota_id' => $peminjaman->anggota_id,
            'pesan' => 'Maaf, pengajuan peminjaman kamu ditolak oleh Admin.',
            'status' => 'belum_dibaca',
        ]);

        return back()->with('success', 'Peminjaman ditolak.');
    }
}
