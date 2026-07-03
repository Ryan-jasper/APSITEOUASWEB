<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $anggota = Auth::guard('anggota')->user();
        $notifikasis = Notifikasi::where('anggota_id', $anggota->anggota_id)->latest()->get();

        Notifikasi::where('anggota_id', $anggota->anggota_id)
            ->where('status', 'belum_dibaca')
            ->update(['status' => 'sudah_dibaca']);

        return view('anggota.notifikasi.index', compact('notifikasis'));
    }
}
