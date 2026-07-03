<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $anggota = Auth::guard('anggota')->user();
        $wishlists = Wishlist::with('buku')->where('anggota_id', $anggota->anggota_id)->get();
        return view('anggota.wishlist.index', compact('wishlists'));
    }

    public function store($buku_id)
    {
        $anggota = Auth::guard('anggota')->user();

        Wishlist::firstOrCreate([
            'anggota_id' => $anggota->anggota_id,
            'buku_id' => $buku_id,
        ]);

        return back()->with('success', 'Buku ditambahkan ke wishlist.');
    }

    public function destroy($id)
    {
        Wishlist::where('id', $id)->delete();
        return back()->with('success', 'Buku dihapus dari wishlist.');
    }
}
