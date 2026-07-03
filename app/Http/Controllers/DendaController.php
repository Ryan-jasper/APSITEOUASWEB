<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use Illuminate\Support\Facades\Auth;

class DendaController extends Controller
{
    public function index()
    {
        $anggota = Auth::guard('anggota')->user();

        $dendas = Denda::whereHas('pengembalian.peminjaman', function ($q) use ($anggota) {
            $q->where('anggota_id', $anggota->anggota_id);
        })->with('pengembalian.peminjaman.detail.buku')->latest()->get();

        return view('anggota.denda.index', compact('dendas'));
    }
}
