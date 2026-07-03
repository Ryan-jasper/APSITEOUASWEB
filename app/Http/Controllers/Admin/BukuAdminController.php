<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class BukuAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategori');
        if ($request->filled('keyword')) {
            $query->where('judul', 'like', '%'.$request->keyword.'%');
        }
        $bukus = $query->latest()->paginate(10)->withQueryString();
        return view('admin.buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris = KategoriBuku::all();
        return view('admin.buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => 'required|exists:kategori_bukus,kategori_id',
            'kode_buku' => 'required|string|max:30|unique:bukus,kode_buku',
            'judul' => 'required|string|max:150',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'nullable|digits:4',
            'stok' => 'required|integer|min:0',
            'lokasi_rak' => 'nullable|string|max:50',
        ]);

        $data['status_buku'] = $data['stok'] > 0 ? 'available' : 'unavailable';
        Buku::create($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = KategoriBuku::all();
        return view('admin.buku.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $data = $request->validate([
            'kategori_id' => 'required|exists:kategori_bukus,kategori_id',
            'kode_buku' => 'required|string|max:30|unique:bukus,kode_buku,'.$buku->buku_id.',buku_id',
            'judul' => 'required|string|max:150',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'nullable|digits:4',
            'stok' => 'required|integer|min:0',
            'lokasi_rak' => 'nullable|string|max:50',
        ]);

        $data['status_buku'] = $data['stok'] > 0 ? 'available' : 'unavailable';
        $buku->update($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        $masihDipinjam = $buku->detailPeminjaman()
            ->whereHas('peminjaman', function ($q) {
                $q->where('status_peminjaman', 'dipinjam');
            })->exists();

        if ($masihDipinjam) {
            return back()->with('error', 'Buku tidak dapat dihapus karena masih dipinjam.');
        }

        $buku->delete();
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function show($id)
    {
        return redirect()->route('admin.buku.edit', $id);
    }
}
