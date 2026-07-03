<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Denda;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    const TARIF_PER_HARI = 5000;

    public function index()
    {
        $peminjamans = Peminjaman::with('anggota', 'detail.buku')
            ->where('status_peminjaman', 'dipinjam')
            ->latest()
            ->get();

        return view('admin.pengembalian.index', compact('peminjamans'));
    }

    public function store(Request $request, $peminjaman_id)
    {
        $request->validate([
            'tanggal_pengembalian' => 'required|date',
        ]);

        $peminjaman = Peminjaman::with('detail.buku')->findOrFail($peminjaman_id);
        $admin = Auth::guard('admin')->user();

        $tglKembali = Carbon::parse($request->tanggal_pengembalian);
        $tglJatuhTempo = Carbon::parse($peminjaman->tanggal_jatuh_tempo);

        $telat = $tglKembali->gt($tglJatuhTempo) ? $tglJatuhTempo->diffInDays($tglKembali) : 0;

        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $peminjaman->peminjaman_id,
            'admin_id' => $admin->admin_id,
            'tanggal_pengembalian' => $tglKembali,
            'status_pengembalian' => $telat > 0 ? 'terlambat' : 'tepat_waktu',
            'total_terlambat' => $telat,
        ]);

        if ($telat > 0) {
            $totalDenda = $telat * self::TARIF_PER_HARI;
            Denda::create([
                'pengembalian_id' => $pengembalian->pengembalian_id,
                'jumlah_hari_terlambat' => $telat,
                'tarif_per_hari' => self::TARIF_PER_HARI,
                'total_denda' => $totalDenda,
                'status_bayar' => 'belum_bayar',
            ]);
        }

        foreach ($peminjaman->detail as $detail) {
            $buku = $detail->buku;
            $buku->stok += $detail->jumlah;
            $buku->status_buku = 'available';
            $buku->save();
        }

        $peminjaman->update(['status_peminjaman' => 'selesai']);

        $pesan = $telat > 0
            ? 'Pengembalian tercatat, kamu terlambat '.$telat.' hari dengan denda Rp'.number_format($telat * self::TARIF_PER_HARI, 0, ',', '.').'.'
            : 'Pengembalian tercatat tepat waktu. Terima kasih!';

        Notifikasi::create([
            'anggota_id' => $peminjaman->anggota_id,
            'pesan' => $pesan,
            'status' => 'belum_dibaca',
        ]);

        return back()->with('success', 'Pengembalian berhasil dicatat.');
    }
}
