<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus';
    protected $primaryKey = 'buku_id';
    protected $fillable = [
        'kategori_id', 'kode_buku', 'judul', 'penulis', 'penerbit',
        'tahun_terbit', 'stok', 'lokasi_rak', 'status_buku',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_id', 'kategori_id');
    }

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'buku_id', 'buku_id');
    }
}
